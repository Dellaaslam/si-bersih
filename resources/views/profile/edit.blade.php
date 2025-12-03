<x-app-layout>

    <div class="py-12 bg-[#F5F5F5] min-h-screen">
        <div class="max-w-5xl mx-auto px-6">

            <!-- CARD BESAR -->
            <div class="bg-white shadow-xl rounded-xl p-10">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                    <!-- LEFT SECTION = PROFILE SUMMARY -->
                    <div class="flex flex-col items-center text-center">
                        <img src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/150' }}" 
                             class="w-40 h-40 rounded-full border shadow mb-4">

                        <h1 class="text-2xl font-semibold">{{ Auth::user()->name }}</h1>

                        <div class="mt-6 space-y-2 text-gray-600">
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Phone:</strong> {{ Auth::user()->phone ?? '-' }}</p>
                        </div>
                    </div>


                    <!-- RIGHT SECTION = FORMS -->
                    <div class="space-y-6">

                        <!-- 1. Update Profile Information -->
                        <div class="p-6 bg-white rounded-lg border shadow">
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <!-- 2. Update Password -->
                        <div class="p-6 bg-white rounded-lg border shadow">
                            @include('profile.partials.update-password-form')
                        </div>

                        <!-- 3. Delete Account -->
                        <div class="p-6 bg-white rounded-lg border shadow">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
