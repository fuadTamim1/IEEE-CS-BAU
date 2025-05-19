<x-guest-layout>
    @section('title', 'Welcome Back!')
    @section('description')
        Do not have account yet? <a href="{{ route('register') }}" class="guest-link">Sign Up</a>.
    @endsection

    <form class="guest-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <input type="email" name="email" placeholder="Email" class="guest-input w-100">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <input type="password" name="password" placeholder="Password" class="guest-input w-100"
                    :value="old('email')" required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('password')" class="mt-2 guest-error" />
            </div>
        </div>
        <div class="row col-12">
            <label class="guest-checkbox-label">
                <input checked="checked" class="guest-checkbox" name="remember" type="checkbox">
                <div class="checkmark"></div>
                Remember Me
            </label>
        </div>
        <div class="row">
            <div class="col-12">
                <Button type="submit" class="guest-form-submit-button w-100">
                    Login
                </Button>
            </div>
            <p class="guest-form-note mt-1">
                If you have forgotten your password do not worry you can <a href="mail:baucs@ieee.org">contact
                    us</a> or meet us in the IEEE office.
            </p>
        </div>



    </form>
</x-guest-layout>
