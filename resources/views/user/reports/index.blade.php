<x-app-layout>
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6" x-data="{ status: '{{ request('status') }}', search: '{{ request('search') }}' }">

    <h2 class="text-3xl font-bold text-gray-800 mb-6">Laporan Sampah Saya</h2>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:justify-between mb-6 gap-4">
        <a href="{{ route('user.reports.create') }}" 
            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-300">
                Buat Laporan Baru
        </a>

        {{-- Filter + Search --}}
        <div class="flex gap-2 flex-1 sm:flex-none">
            <select x-model="status" @change="window.location.href='?status='+status+'&search='+search" class="border-gray-300 rounded-lg px-3 py-2 shadow-sm">
                <option value="">Filter Status</option>
                <option value="pending" :selected="status=='pending'">Belum diproses</option>
                <option value="rejected" :selected="status=='rejected'">Proses ditolak</option>
                <option value="confirmed" :selected="status=='confirmed'">Selesai</option>
            </select>

            <input type="text" x-model="search" @keyup.enter="window.location.href='?status='+status+'&search='+search" placeholder="Cari lokasi/deskripsi..." class="border-gray-300 rounded-lg px-3 py-2 shadow-sm flex-1">

            <button @click="window.location.href='?status='+status+'&search='+search" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Cari
            </button>
        </div>
    </div>

    {{-- Grid Laporan --}}
    @if($reports->isEmpty())
        <p class="text-gray-600">Belum ada laporan dibuat.</p>
    @else
        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach($reports as $report)
                <div class="bg-white rounded-xl shadow-lg p-4 border border-gray-200 flex flex-col">
                    @if($report->photo)
                        <img src="{{ asset('storage/' . $report->photo) }}" class="h-64 w-full object-cover rounded mb-4">
                    @endif

                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $report->location }}</h3>

                        {{-- Badge Status Dengan Icon --}}
                       @php
    if ($report->status === 'pending' || $report->status === 'Belum diproses') {
        $color = 'bg-yellow-200 text-yellow-800';
        $icon = '
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>';
        $label = 'Belum Diproses';
    }
    elseif ($report->status === 'confirmed' || $report->status === 'Selesai') {
        $color = 'bg-green-200 text-green-800';
        $icon = '
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 13l4 4L19 7" />
            </svg>';
        $label = 'Selesai';
    }
    else {
        $color = 'bg-red-200 text-red-800';
        $icon = '
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>';
        $label = 'Ditolak';
    }
@endphp




                        <span class="flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold {{ $color }}">
                            {!! $icon !!}
                            {{ $label }}
                        </span>
                    </div>

                    <p class="text-gray-600 mb-4">{{ $report->description ?? '-' }}</p>

                    <div class="mt-auto flex justify-end gap-2">
                        <a href="{{ route('user.reports.edit', $report->id) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Edit</a>
                        <form action="{{ route('user.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
</x-app-layout>
