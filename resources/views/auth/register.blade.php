<x-guest-layout>

    <h2 class="text-3xl font-bold text-white mb-6 text-center">Register</h2>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Social Login Buttons -->
    <div class="flex gap-3 mb-6">
        <button class="flex items-center justify-center gap-2 bg-white px-4 py-2 rounded-lg shadow w-1/2">
            <img src="google.png" class="w-5">
            <span class="text-sm font-semibold">Google</span>
        </button>

        <button class="flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg shadow w-1/2">
            <img src="{{ asset('facebook.jpeg') }}" class="w-5">
            <span class="text-sm font-semibold">Facebook</span>
        </button>
    </div>

    <!-- Divider -->
    <div class="flex items-center my-4">
        <div class="flex-grow border-t border-gray-600"></div>
        <span class="mx-4 text-gray-300">or</span>
        <div class="flex-grow border-t border-gray-600"></div>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" class="text-white" />
            <x-text-input id="name" class="block mt-1 w-full rounded-lg"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- No HP -->
        <div class="mb-4">
            <label class="text-white font-medium">No HP</label>
            <input type="text" name="phone" class="block mt-1 w-full border rounded-lg p-2 bg-white" required>
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label class="text-white font-medium">Alamat</label>
            <textarea name="address" class="block mt-1 w-full border rounded-lg p-2 bg-white" rows="3" required></textarea>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />
            <x-text-input id="password" class="block mt-1 w-full rounded-lg"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Link Login -->
        <div class="flex items-center justify-end mb-4">
            <a class="underline text-sm text-green-300 hover:text-green-500 rounded-md"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>

        <!-- Register Button -->
        <button
            class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold 
                py-3 rounded-xl shadow-lg transition transform hover:-translate-y-1 
                hover:shadow-2xl">
            Register
        </button>

    </form>

</x-guest-layout>
