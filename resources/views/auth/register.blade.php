<x-guest-layout>
    {{-- <x-authentication-card> --}}
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row register-container w-100" style="max-width: 900px;">
            <!-- Image Section -->
            <div class="col-md-6 register-image">
                <img src="/img/login.jpeg" alt="Registration Illustration" class="img-fluid" style="max-width: 80%;">
            </div>

            {{-- <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>
             --}}
            <!-- Form Section -->
            <div class="col-md-6 register-form">
                <h2>Create an Account</h2>
                <p class="mb-4">Sign up now and unlock exclusive access!</p>

                <!-- General Error Display -->
                <x-validation-errors class="mb-4" />

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <!-- Name -->
                    <div class="form-group">
                        <x-label for="name" class="form-label"value="{{ __('Name') }}" />
                        <x-input type="text" id="name" name="name" class="form-control block mt-1 w-full"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <x-label for="email" class="form-label" value="{{ __('Email') }}" />
                        <x-input type="email" id="email" name="email" class="form-control block mt-1 w-full"
                            type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>

                    {{-- <div class="form-group"> --}}
                        {{-- <x-label for="select" class="form-label" value="{{ __('Select') }}" /> --}}
                        <select name="unit_id" class="form-control" required>
                            <option value="">Select Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    {{-- </div> --}}


                    <!-- Password -->
                    <div class="form-group">
                        <x-label for="password" class="form-label" value="{{ __('Password') }}" />
                        <x-input type="password" id="password" class="form-control block mt-1 w-full" type="password"
                            name="password" required autocomplete="new-password" />
                    </div>


                    <!-- Password Confirmation -->
                    <div class="form-group">
                        <x-label for="password_confirmation" class="form-label" value="{{ __('Confirm Password') }}" />
                        <x-input type="password" id="password_confirmation" class="form-control block mt-1 w-full"
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' =>
                                                '<a target="_blank" href="' .
                                                route('terms.show') .
                                                '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                __('Terms of Service') .
                                                '</a>',
                                            'privacy_policy' =>
                                                '<a target="_blank" href="' .
                                                route('policy.show') .
                                                '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                __('Privacy Policy') .
                                                '</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="form-group text-center">
                        <x-button>Create Account</x-button>
                    </div>
                </form>
                {{-- </x-authentication-card> --}}
                <div class="text-center">
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="mailto:derricktabiri046@gmail.com" class="help-link">derricktabiri046@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>
</x-guest-layout>
