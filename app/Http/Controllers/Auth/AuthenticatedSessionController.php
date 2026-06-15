<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Support\AdminRoles;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        abort_unless((bool) get_setting('enable_login', true), 403, 'Login is currently disabled.');

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): RedirectResponse
    {
        abort_unless((bool) get_setting('enable_login', true), 403, 'Login is currently disabled.');

        $request->authenticate();
        $request->session()->regenerate();

        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Unable to log in. Please try again.',
            ]);
        }

        if (!$user->isApproved()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Your account is pending admin approval.',
            ]);
        }

        $expirationDays = (int) get_setting('password_expiration_days', 90);
        if ($user->passwordExpired($expirationDays)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Your password has expired. Please reset your password to continue.',
            ]);
        }

        if ((bool) get_setting('enable_email_verification', true) && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();

            return redirect()->route('verification.notice');
        }

        if ($user->hasAnyRole(AdminRoles::adminAccessRoles())) {
            return redirect()->route('filament.admin.pages.dashboard');
        }

        return redirect()->intended(route('home'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
