<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8">

        <!-- Header -->
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Edit Laporan Sampah</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">

            <!-- Progress Step -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex-1 h-2 rounded bg-indigo-600"></div>
                <div class="flex-1 h-2 rounded bg-gray-300"></div>
                <div class="flex-1 h-2 rounded bg-gray-300"></div>
            </div>

            <form action="{{ route('user.reports.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Lokasi -->
                <div class="mb-5">
                    <x-input-label value="Lokasi Kejadian" class="font-semibold text-gray-700" />
                    <x-text-input name="location" class="w-full mt-2"
                        value="{{ old('location', $report->location) }}" required />
                    @error('location')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-5">
                    <x-input-label value="Deskripsi Laporan" class="font-semibold text-gray-700" />
                    <textarea name="description"
                        class="w-full border-gray-300 rounded-lg shadow-sm p-3 mt-2 focus:ring-indigo-500">{{ old('description', $report->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto Lama -->
                @if ($report->photo)
                    <div class="mb-5">
                        <x-input-label value="Foto Lama" class="font-semibold text-gray-700" />
                        <img src="{{ asset('storage/' . $report->photo) }}"
                            class="h-48 w-full object-cover rounded-xl border border-gray-300 mt-2 shadow-md">
                    </div>
                @endif

                <!-- Upload Foto Baru -->
                <div class="mb-5">
                    <x-input-label value="Ganti Foto (Opsional)" class="font-semibold text-gray-700" />
                    <input type="file" name="photo" id="photoInput"
                        class="mt-2 block w-full text-sm text-gray-700 file:bg-indigo-600 file:hover:bg-indigo-700 file:text-white file:px-4 file:py-2 file:rounded-lg file:border-none file:cursor-pointer"
                        accept="image/*">

                    @error('photo')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div id="photoPreviewContainer" class="mt-4"></div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-8">

                    <!-- Button Batal -->
                    <a href="{{ route('user.reports.index') }}"
                        class="px-4 py-2 rounded-lg border border-gray-400 text-gray-700 hover:bg-gray-100 transition">
                        Batal
                    </a>

                    <!-- Button Next -->
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-200 flex items-center gap-2">
                        Next
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Preview Foto Baru -->
    <script>
        const photoInput = document.getElementById('photoInput');
        const photoContainer = document.getElementById('photoPreviewContainer');

        photoInput.addEventListener('change', function() {
            photoContainer.innerHTML = '';
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add(
                        'h-48',
                        'w-full',
                        'object-cover',
                        'rounded-xl',
                        'border',
                        'border-gray-300',
                        'shadow-md'
                    );
                    photoContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
