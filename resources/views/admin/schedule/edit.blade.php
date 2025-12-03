<x-app-layout>
    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto">

            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Edit Jadwal</h1>

                <!-- <a href="{{ route('admin.schedule.index') }}"
                   class="px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white rounded-lg shadow">
                    ← Kembali
                </a> -->
            </div>

            <!-- Card -->
            <div class="bg-white shadow-lg rounded-xl p-6">

                <!-- Error Handling -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-600 px-4 py-3 rounded-lg border border-red-300">
                        <strong class="font-semibold">Terjadi kesalahan:</strong>
                        <ul class="list-disc ml-6 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.schedule.update', $schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Judul -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                        <input type="text" name="title"
                               value="{{ old('title', $schedule->title) }}"
                               class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-green-300 focus:border-green-400">
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Tanggal Mulai</label>
                        <input type="date" name="start"
                               value="{{ old('start', $schedule->start) }}"
                               class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-green-300 focus:border-green-400">
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Tanggal Selesai</label>
                        <input type="date" name="end"
                               value="{{ old('end', $schedule->end) }}"
                               class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-green-300 focus:border-green-400">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-green-300 focus:border-green-400">{{ old('description', $schedule->description) }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.schedule.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                            Batal
                        </a>

                        <button type="submit"
                                class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition">
                            Update Jadwal
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
