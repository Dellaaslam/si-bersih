<nav x-data="{ open: false }" class="bg-green-900 text-white shadow">
    <!-- Primary Navigation -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-16 items-center">

            <!-- Left: Logo + Menu -->
            <div class="flex items-center gap-10">

                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <img src="{{ asset('logo.png') }}" class="h-8" alt="Logo">
                    <span class="font-bold text-lg">SI-BERSIH</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:space-x-8 text-sm">

                    <x-nav-link :href="route('admin.dashboard')" 
                                :active="request()->routeIs('admin.dashboard')" 
                                class="text-white hover:underline">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('admin.schedule.index')" 
                                :active="request()->routeIs('admin.schedule.index')"
                                class="text-white hover:underline">
                        Schedule
                    </x-nav-link>

                    <x-nav-link :href="route('admin.payments.index')" 
                                :active="request()->routeIs('admin.payments.index')"
                                class="text-white hover:underline">
                        Payments
                    </x-nav-link>

                    <x-nav-link :href="route('admin.reports')" 
                                :active="request()->routeIs('admin.reports')"
                                class="text-white hover:underline">
                        Reports
                    </x-nav-link>

                    <x-nav-link :href="route('admin.usermanagement')" 
                                :active="request()->routeIs('admin.usermanagement')"
                                class="text-white hover:underline">
                        User Management
                    </x-nav-link>

                </div>

            </div>

            <!-- Right: User Dropdown -->
            <div class="hidden sm:flex items-center">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent 
                                   text-sm font-medium rounded-md text-white 
                                   bg-green-900 hover:bg-green-800">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ms-1 h-4 w-4 fill-white" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 
                                         1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <!-- Mobile Hamburger -->
            <div class="sm:hidden">
                <button @click="open = !open"
                    class="p-2 rounded-md text-white hover:bg-green-800">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-green-800 px-4">

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('admin.dashboard')" 
                                   :active="request()->routeIs('admin.dashboard')" 
                                   class="text-white">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.schedule.index')" 
                                   :active="request()->routeIs('admin.schedule.index')" 
                                   class="text-white">
                Schedule
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.payments.index')" 
                                   :active="request()->routeIs('admin.payments.index')" 
                                   class="text-white">
                Payments
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.reports')" 
                                   :active="request()->routeIs('admin.reports')" 
                                   class="text-white">
                Reports
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.usermanagement')" 
                                   :active="request()->routeIs('admin.usermanagement')" 
                                   class="text-white">
                User Management
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
                        onclick="event.preventDefault(); this.closest('form').submit();" 
                        class="text-white">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>

        </div>
    </div>
</nav>
