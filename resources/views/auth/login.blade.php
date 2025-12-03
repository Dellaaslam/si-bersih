<x-guest-layout>
 
    <h2 class="text-3xl font-bold text-white mb-6">Login</h2>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Social Login Buttons (Mock) -->
    <div class="flex gap-3 mb-6">
        <button class="flex items-center gap-2 bg-white px-4 py-2 rounded-lg shadow w-1/2">
            <img src="google.png" class="w-5">
            <span class="text-sm font-semibold">Sign in with Google</span>
        </button>
        <button class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg shadow w-1/2">
            <img src="{{ asset('facebook.jpeg') }}" class="w-5">
            <span class="text-sm font-semibold">Sign in with Facebook</span>
        </button>
    </div>

    <div class="flex items-center my-4">
        <div class="flex-grow border-t border-gray-400"></div>
        <span class="mx-4 text-gray-200">or</span>
        <div class="flex-grow border-t border-gray-400"></div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" value="Email" class="text-white" />
            <x-text-input id="email" type="email"
                class="mt-1 block w-full bg-white"
                name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" value="Password" class="text-white" />
            <x-text-input id="password" type="password"
                class="mt-1 block w-full bg-white"
                name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
        </div>

        <!-- Remember Me -->
        <label class="flex items-center mb-4 text-gray-200">
            <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                name="remember">
            <span class="ml-2 text-sm">Remember me</span>
        </label>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <div class="text-right mb-3">
                    <a href="{{ route('password.request') }}"
                    class="text-sm text-gray-300 hover:text-white underline">
                        Forgot your password?
                    </a>
                </div>
            @endif

            <!-- Tombol Login Full Width -->
            <button
                class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold 
                    py-3 rounded-xl shadow-lg transition transform hover:-translate-y-1 
                    hover:shadow-2xl">
                Login
            </button>
        </div>

    </form>

</x-guest-layout>
