<!-- <x-app-layout>
    <div class="max-w-xl mx-auto py-6">

        <h1 class="text-2xl font-bold mb-4">Tambah Jadwal Pengangkutan Sampah</h1>

        <form action="{{ route('admin.schedule.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="font-semibold">Judul</label>
                <input type="text" name="title" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="font-semibold">Tanggal Mulai</label>
                <input type="date" name="start" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="font-semibold">Tanggal Selesai</label>
                <input type="date" name="end" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="font-semibold">Deskripsi (opsional)</label>
                <textarea name="description" class="w-full border rounded p-2"></textarea>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Simpan Jadwal
            </button>
        </form>

    </div>
</x-app-layout> -->
