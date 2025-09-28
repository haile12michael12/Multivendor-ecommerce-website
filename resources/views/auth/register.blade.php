<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4" x-data="{ showPassword: false, showConfirmPassword: false, passwordStrength: 0 }" @submit="validateForm">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <div class="relative">
                <x-text-input id="name" class="block mt-1 w-full pl-10" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none mt-1">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <div class="relative">
                <x-text-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="your@email.com" />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none mt-1">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pl-10" 
                    x-bind:type="showPassword ? 'text' : 'password'"
                    name="password" required autocomplete="new-password" 
                    placeholder="••••••••"
                    x-model="password"
                    @input="calculateStrength" />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none mt-1">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1" @click="showPassword = !showPassword">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" x-show="!showPassword">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" x-show="showPassword" style="display: none;">
                        <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                        <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                    </svg>
                </button>
            </div>
            
            <!-- Password Strength Meter -->
            <div class="mt-2" x-show="password.length > 0">
                <div class="h-1 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full transition-all duration-300" 
                         :class="{
                             'bg-red-500': passwordStrength < 2,
                             'bg-yellow-500': passwordStrength >= 2 && passwordStrength < 4,
                             'bg-green-500': passwordStrength >= 4
                         }" 
                         :style="'width: ' + (passwordStrength * 20) + '%'"></div>
                </div>
                <p class="text-xs mt-1 text-gray-500" x-text="getStrengthText()"></p>
            </div>
            
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pl-10" 
                    x-bind:type="showConfirmPassword ? 'text' : 'password'"
                    name="password_confirmation" required autocomplete="new-password" 
                    placeholder="••••••••" />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none mt-1">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1" @click="showConfirmPassword = !showConfirmPassword">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" x-show="!showConfirmPassword">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" x-show="showConfirmPassword" style="display: none;">
                        <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                        <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms and Conditions -->
        <div class="mt-4">
            <label class="flex items-center">
                <input type="checkbox" name="terms" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                <span class="ml-2 text-sm text-gray-600">
                    I agree to the <a href="#" class="underline text-gray-600 hover:text-gray-900" @click.prevent="showTermsModal = true">Terms of Service</a> and <a href="#" class="underline text-gray-600 hover:text-gray-900" @click.prevent="showPrivacyModal = true">Privacy Policy</a>
                </span>
            </label>
            <x-input-error :messages="$errors->get('terms')" class="mt-2" />
        </div>

        <!-- Social Login -->
        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
                <a href="{{ route('login.google') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.545 10.239v3.821h5.445c-0.712 2.315-2.647 3.972-5.445 3.972-3.332 0-6.033-2.701-6.033-6.032s2.701-6.032 6.033-6.032c1.498 0 2.866 0.549 3.921 1.453l2.814-2.814c-1.784-1.664-4.153-2.675-6.735-2.675-5.522 0-10 4.477-10 10s4.478 10 10 10c8.396 0 10-7.524 10-10 0-0.67-0.069-1.325-0.189-1.961h-9.811z" />
                    </svg>
                </a>
                <a href="{{ route('login.facebook') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4" x-ref="submitButton">
                <span x-show="!isLoading">{{ __('Register') }}</span>
                <span x-show="isLoading" style="display: none;">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                </span>
            </x-primary-button>
        </div>
    </form>

    <!-- Terms Modal -->
    <div x-show="showTermsModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <!-- Modal content -->
    </div>

    <!-- Privacy Modal -->
    <div x-show="showPrivacyModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <!-- Modal content -->
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('registerForm', () => ({
                showPassword: false,
                showConfirmPassword: false,
                passwordStrength: 0,
                password: '',
                isLoading: false,
                showTermsModal: false,
                showPrivacyModal: false,
                
                calculateStrength() {
                    let strength = 0;
                    if (this.password.length > 0) strength += 1;
                    if (this.password.length >= 8) strength += 1;
                    if (/[A-Z]/.test(this.password)) strength += 1;
                    if (/[0-9]/.test(this.password)) strength += 1;
                    if (/[^A-Za-z0-9]/.test(this.password)) strength += 1;
                    
                    this.passwordStrength = strength;
                },
                
                getStrengthText() {
                    const texts = ['Very Weak', 'Weak', 'Medium', 'Strong', 'Very Strong'];
                    return this.password.length > 0 ? texts[this.passwordStrength - 1] || '' : '';
                },
                
                validateForm() {
                    this.isLoading = true;
                    // Additional validation can be added here
                    return true;
                }
            }));
        });
    </script>
</x-guest-layout>