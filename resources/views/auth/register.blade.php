<x-guest-layout>
    @section('title', 'Create an Account')
    @section('description')
        Already have an account? <a href="{{ route('login') }}" class="guest-link">Login</a>.
    @endsection

    <form class="guest-form" method="POST" action="{{ route('register') }}">
        @csrf
        {{-- full name --}}
        <div class="row g-0">
            <div class="col-6">
                <input type="text" placeholder="First Name" name="fname" class="guest-input w-100">
                <x-input-error :messages="$errors->get('fname')" class="mt-2" />
            </div>
            <div class="col-6">
                <input type="text" placeholder="Last Name" lname="lname" class="guest-input w-100">
                <x-input-error :messages="$errors->get('lname')" class="mt-2" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <input type="email" name="email" placeholder="Email" class="guest-input w-100">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <input type="text" name="ieee_membership_number" placeholder="IEEE Membership Number" class="guest-input w-100">
                <x-input-error :messages="$errors->get('ieee_membership_number')" class="mt-2" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <input type="password" name="password" placeholder="Password" class="guest-input w-100">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <Button type="submit" class="guest-form-submit-button w-100">
                    Create Account
                </Button>
            </div>
        </div>

    </form>
</x-guest-layout>
