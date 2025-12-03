<nav x-data="{ open: false }" class="bg-green-900 text-white shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-16 items-center">

            <!-- Left Section: Logo + Menu -->
            <div class="flex items-center gap-10">

                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <img src="{{ asset('logo.png') }}" class="h-8" alt="Logo">
                    <span class="font-bold text-lg">SI-BERSIH</span>
                </div>

                <!-- Menu (Desktop) -->
                <div class="hidden sm:flex sm:space-x-8 text-sm">

                    <x-nav-link :href="route(name: 'user.dashboard')" :active="request()->routeIs('user.dashboard')" class="text-white hover:underline">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('user.reports.index')" :active="request()->routeIs('user.reports.index')" class="text-white hover:underline">
                        SI-Bersih Report
                    </x-nav-link>

                    <x-nav-link :href="route('user.schedule')" :active="request()->routeIs('user.schedule')" class="text-white hover:underline">
                        SI-Bersih Schedule
                    </x-nav-link>

                    <x-nav-link :href="route('user.payments.index')" :active="request()->routeIs('user.payments.index')" class="text-white hover:underline">
                        SI-Bersih Pay
                    </x-nav-link>

                </div>

            </div>

            <!-- Right Section: User Dropdown -->
            <div class="hidden sm:flex items-center">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-900 hover:bg-green-800">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ms-1 h-4 w-4 fill-white" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <!-- Hamburger (Mobile) -->
            <div class="sm:hidden">
                <button @click="open = !open"
                    class="p-2 rounded-md text-white hover:bg-green-800 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation (Mobile) -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-green-800 px-4">
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')" class="text-white">
                Home
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('user.reports.index')" :active="request()->routeIs('user.reports.index')" class="text-white">
                SI-Bersih Report
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('user.schedule')" :active="request()->routeIs('user.schedule')" class="text-white">
                SI-Bersih Schedule
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('user.payments.index')" :active="request()->routeIs('user.payments.index')" class="text-white">
                SI-Bersih Pay
            </x-responsive-nav-link>

        </div>

        <!-- Mobile User Info -->
        <div class="border-t border-green-700 pt-4 pb-3">

            <div class="px-4">
                <div class="font-medium text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-green-200 text-sm">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();" class="text-white">
                        Logout
                    </x-responsive-nav-link>
                </form>
            </div>

        </div>
    </div>
</nav>
