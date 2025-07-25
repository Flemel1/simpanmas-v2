<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectRoute('dashboard');
    }
}; ?>
<div class="flex items-center justify-center min-h-screen bg-indigo-700">
    <div class="w-full max-w-4xl p-8 mx-4 bg-white rounded-lg shadow-xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Left Side: Logo and Title -->
            <div class="text-center">
                <img src="{{ asset('images/logo.png') }}" height="300" alt="Logo Simalungun"
                    class="mx-auto mb-4 w-32 h-32 md:w-40 md:h-40">
                <h1 class="text-xl font-semibold text-gray-700">Inspektorat Kabupaten Simalungun</h1>
            </div>

            <!-- Right Side: Login Form -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center md:text-left">Form Login</h2>
                <form wire:submit.prevent="login">
                    <!-- Email Input -->
                    <div class="mb-4 relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        <input wire:model="form.email" type="email" id="email" placeholder="Email"
                            class="w-full pl-10 pr-4 py-3 bg-gray-100 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    @error('form.email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <!-- Password Input -->
                    <div class="mb-6 relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </span>
                        <input wire:model="form.password" type="password" id="password" placeholder="Password"
                            class="w-full pl-10 pr-4 py-3 bg-gray-100 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    @error('form.password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 text-white font-semibold bg-green-500 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-300">
                        LOGIN
                    </button>
                </form>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Lupa Kata Sandi?') }}
                    </a>
                @endif
                
            </div>
        </div>
    </div>
</div>
