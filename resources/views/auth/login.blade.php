<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row login-container w-100" style="max-width: 900px;">
            <!-- Image Section -->
            <div class="col-md-6 login-image">
                <img src="/img/login.jpeg" alt="Login Illustration" class="img-fluid" style="max-width: 80%;">
            </div>

            <!-- Form Section -->
            <div class="col-md-6 login-form">
                <h2>Sign In</h2>
                <p class="mb-4">Unlock your world.</p>

                <!-- Display General Errors -->
                <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

        
                    <div class="form-group">
                        <x-label for="email" class="form-label" value="{{ __('Email') }}" />
                        <x-input type="email" id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" 
                        <x-input id="password" 
                    </div>
                    <div class="form-group">
                        <x-label for="password" class="form-label" value="{{ __('Password') }}" />
                        <x-input type="password" id="password" class="form-control block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>


                    <div class="form-group d-flex justify-content-between">
                {{-- <div class="flex items-center justify-end mt-4"> --}}
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif             
                   </div>

                    <div class="text-center">
                        <x-button type="submit" class="btn-primary">Sign In</x-button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('register') }}" class="create-account">Create an account</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
