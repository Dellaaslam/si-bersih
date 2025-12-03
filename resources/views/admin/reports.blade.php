<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">

        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            Daftar Laporan Sampah Menumpuk
        </h2>

        {{-- Wrapper Responsif --}}
        <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200">

            {{-- Scroll untuk mobile --}}
            <div class="overflow-x-auto w-full">

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-green-600">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">Pelapor</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">Lokasi</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">Foto</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($reports as $report)
                            <tr class="hover:bg-gray-50 transition">

                                {{-- Pelapor --}}
                                <td class="px-4 py-3 text-gray-800 font-medium whitespace-nowrap">
                                    {{ $report->user->name }}
                                </td>

                                {{-- Lokasi --}}
                                <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                    {{ $report->location }}
                                </td>

                                {{-- Foto --}}
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($report->photo)
                                        <img src="{{ asset('storage/' . $report->photo) }}" class="w-20 h-20 object-cover rounded-lg border shadow">
                                    @else
                                        <span class="text-gray-400">Tidak ada foto</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($report->status === 'pending')
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-700">
                                            Pending
                                        </span>
                                    @elseif($report->status === 'confirmed')
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">
                                            Dikonfirmasi
                                        </span>
                                    @elseif($report->status === 'rejected')
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-4 py-3 text-center whitespace-nowrap">

                                    @if($report->status === 'pending')
                                        <div class="flex justify-center gap-3">

                                            {{-- Konfirmasi --}}
                                            <form action="{{ route('admin.reports.confirm', $report->id) }}" method="POST">
                                                @csrf
                                                <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg shadow text-sm">
                                                    Konfirmasi
                                                </button>
                                            </form>

                                            {{-- Tolak --}}
                                            <form action="{{ route('admin.reports.reject', $report->id) }}" method="POST">
                                                @csrf
                                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg shadow text-sm">
                                                    Tolak
                                                </button>
                                            </form>

                                        </div>
                                    @else
                                        <span class="text-gray-500 text-sm italic">
                                            Sudah diproses
                                        </span>
                                    @endif

                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</x-app-layout>
