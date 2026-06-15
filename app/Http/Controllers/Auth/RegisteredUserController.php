<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\AllowedRegistrationDomain;
use App\Support\AdminRoles;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        abort_unless($this->registrationEnabled(), 403, 'Registration is currently closed.');

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
        abort_unless($this->registrationEnabled(), 403, 'Registration is currently closed.');

        $validated = $request->validate([
            'fname' => ['required', 'string', 'max:120'],
            'lname' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class, new AllowedRegistrationDomain()],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'ieee_membership_number' => ['nullable', 'string', 'max:255'],
        ]);

        $approvalRequired = (bool) get_setting('admin_approval_required', true);
        $approved = !$approvalRequired;
        $defaultRole = $this->resolveDefaultRole();

        $user = User::create([
            'name' => Str::upper($validated['fname']) . ' ' . Str::upper($validated['lname']),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'approval_status' => $approved ? 'approved' : 'pending',
            'approved_at' => $approved ? now() : null,
            'password_changed_at' => now(),
        ]);

        $user->assignRole($defaultRole);

        if ((bool) get_setting('enable_email_verification', true)) {
            event(new Registered($user));
        }

        if ($approvalRequired) {
            return redirect()->route('login')->with('status', 'Registration submitted. Your account is pending admin approval.');
        }

        Auth::login($user);

        if ((bool) get_setting('enable_email_verification', true) && !$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        if ($user->hasAnyRole(AdminRoles::adminAccessRoles())) {
            return redirect()->route('filament.admin.pages.dashboard');
        }

        return redirect()->route('home');
    }

    private function registrationEnabled(): bool
    {
        return (bool) get_setting('enable_registration', true)
            && (bool) get_setting('registration_open', true);
    }

    private function resolveDefaultRole(): string
    {
        $configuredRole = strtolower(trim((string) get_setting('default_role_on_signup', AdminRoles::USER)));

        if ($configuredRole === '') {
            $configuredRole = AdminRoles::USER;
        }

        if (!Role::query()->where('name', $configuredRole)->exists()) {
            $configuredRole = AdminRoles::USER;
            Role::findOrCreate($configuredRole);
        }

        return $configuredRole;
    }
}
