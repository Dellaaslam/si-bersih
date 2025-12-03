<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10">

        <div class="bg-white shadow-md rounded-lg p-6">
            <!-- Header: Tombol Kembali + Judul -->
        <div class="flex items-center gap-4 mb-8">
            
            <!-- Tombol Kembali -->
            <a href="{{ route('admin.schedule.index') }}"
                class="inline-flex items-center justify-center w-10 h-10 rounded-full 
                bg-green-700 hover:bg-green-800 transition shadow">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </a>

            <h1 class="text-3xl font-extrabold text-gray-800 tracking-wide">
                Tambah Jadwal
            </h1>
        </div>

            <form action="{{ route('admin.schedule.store') }}" method="POST">
                @csrf

                <!-- Judul -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-gray-700">Alamat</label>
                    <input type="text" name="title"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan alamat">
                </div>

                <!-- Tanggal Mulai -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="start"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Tanggal Selesai -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-gray-700">Tanggal Selesai (Opsional)</label>
                    <input type="date" name="end"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-gray-700">Deskripsi (Opsional)</label>
                    <textarea name="description" rows="4"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tambahkan deskripsi jika diperlukan"></textarea>
                </div>

                <button
                    class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                    Simpan Jadwal
                </button>

            </form>
        </div>

    </div>
</x-app-layout>
