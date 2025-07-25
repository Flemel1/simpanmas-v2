<?php

use App\Models\User;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $ktp_id = '';
    public string $address = '';
    public string $contact = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'ktp_id' => ['required', 'string', 'numeric', 'digits:16', 'unique:customers,ktp_id'],
            'address' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:15'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Customer::create([
            'ktp_id' => $validated['ktp_id'],
            'name' => $validated['name'],
            'address' => $validated['address'],
            'contact' => $validated['contact'],
            'user_id' => $user->id,
        ]);

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div class="flex items-center justify-center min-h-screen px-4"
    style="background: linear-gradient(to right, #6a11cb, #2575fc);">
    <div class="w-full max-w-5xl p-6 sm:p-8 bg-white rounded-lg shadow-xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Left Side: Logo and Title (Centered) -->
            <div class="flex flex-col items-center justify-center text-center h-full">
                <img src="https://placehold.co/150x150/ffffff/000000?text=LOGO" alt="Logo Simalungun"
                    class="mx-auto mb-4 w-32 h-32 md:w-40 md:h-40">
                <h1 class="text-xl font-semibold text-gray-700">Inspektorat Kabupaten Simalungun</h1>
            </div>

            <!-- Right Side: Registration Form -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center md:text-left">Halaman Pendaftaran</h2>
                <form wire:submit="register" class="space-y-4">

                    {{-- Form Fields --}}
                    <div>
                        <input wire:model="name" type="text" placeholder="Nama"
                            class="w-full px-4 py-3 bg-gray-100 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input wire:model="ktp_id" type="text" placeholder="Nomor KTP"
                            class="w-full px-4 py-3 bg-gray-100 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('ktp_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input wire:model="address" type="text" placeholder="Alamat"
                            class="w-full px-4 py-3 bg-gray-100 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input wire:model="contact" type="text" placeholder="Kontak"
                            class="w-full px-4 py-3 bg-gray-100 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('contact')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input wire:model="email" type="email" placeholder="Email"
                            class="w-full px-4 py-3 bg-gray-100 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input wire:model="password" type="password" placeholder="Password"
                            class="w-full px-4 py-3 bg-gray-100 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input wire:model="password_confirmation" type="password" placeholder="Konfirmasi Password"
                            class="w-full px-4 py-3 bg-gray-100 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 text-white font-semibold bg-green-500 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-300">
                        DAFTAR
                    </button>
                </form>

                <!-- Login Link -->
                <div class="text-left mt-6">
                    <a href="{{ route('login') }}" wire:navigate class="text-sm text-blue-600 hover:underline">
                        &larr; Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
