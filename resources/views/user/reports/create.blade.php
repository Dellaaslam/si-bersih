<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <!-- Tombol Kembali -->
            <a href="{{ route('user.reports.index') }}"
                class="inline-flex items-center justify-center w-10 h-10 rounded-full 
                bg-green-700 hover:bg-green-800 transition">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </a>

            <h2 class="text-3xl font-extrabold text-gray-800">
                Tambah Laporan Sampah
            </h2>
        </div>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Card Form --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
            <form action="{{ route('user.reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Lokasi --}}
                <div class="mb-6">
                    <x-input-label class="text-lg font-semibold" value="Lokasi" />
                    <x-text-input name="location"
                        class="w-full mt-2 border-gray-300 focus:ring-green-500 focus:border-green-500"
                        placeholder="Masukkan lokasi laporan"
                        required />
                    @error('location')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-6">
                    <x-input-label class="text-lg font-semibold" value="Deskripsi" />
                    <textarea name="description"
                        class="w-full border-gray-300 rounded-lg p-3 mt-2 focus:ring-green-500 focus:border-green-500"
                        placeholder="Deskripsi tambahan (opsional)"
                        rows="3"></textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Foto --}}
                <div class="mb-6">
                    <x-input-label class="text-lg font-semibold" value="Foto (opsional, bisa lebih dari satu)" />

                    <!-- Input foto dibuat full width -->
                    <input type="file" name="photo"
                        class="w-full mt-2 border border-gray-300 rounded-lg p-3 focus:ring-green-500 focus:border-green-500"
                        id="photoInput" accept="image/*">


                    @error('photos.*')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Preview Grid -->
                    <div id="photoPreviewContainer"
                        class="mt-4 grid grid-cols-3 gap-3">
                    </div>
                </div>

                <!-- Tombol -->
                <div class="mt-8 flex items-center">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-2.5 rounded-lg shadow-lg transition">
                        Kirim Laporan
                    </button>

                    <a href="{{ route('user.reports.index') }}"
                        class="ml-4 text-gray-500 hover:text-gray-700 font-medium transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>

    </div>

    {{-- Script preview multiple foto --}}
    <script>
        const photoInput = document.getElementById('photoInput');
        const photoContainer = document.getElementById('photoPreviewContainer');

        photoInput.addEventListener('change', function() {
            photoContainer.innerHTML = '';
            const files = this.files;

            if (files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add(
                            'h-32', 'w-full', 'object-cover',
                            'rounded-lg', 'border', 'border-gray-300',
                            'shadow-sm'
                        );
                        photoContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>

</x-app-layout>
