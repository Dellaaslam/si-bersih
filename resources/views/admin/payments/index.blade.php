<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">

        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6">
            Verifikasi Pembayaran User
        </h2>

        <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200">

            <!-- WRAPPER RESPONSIVE -->
            <div class="overflow-x-auto w-full">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-green-600">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs sm:text-sm font-semibold text-white uppercase">User</th>
                            <th class="px-4 py-3 text-left text-xs sm:text-sm font-semibold text-white uppercase">Metode</th>
                            <th class="px-4 py-3 text-left text-xs sm:text-sm font-semibold text-white uppercase">Jumlah</th>
                            <th class="px-4 py-3 text-left text-xs sm:text-sm font-semibold text-white uppercase">Bulan</th>
                            <th class="px-4 py-3 text-left text-xs sm:text-sm font-semibold text-white uppercase">Tahun</th>
                            <th class="px-4 py-3 text-left text-xs sm:text-sm font-semibold text-white uppercase">Bukti</th>
                            <th class="px-4 py-3 text-left text-xs sm:text-sm font-semibold text-white uppercase">Status</th>
                            <th class="px-4 py-3 text-center text-xs sm:text-sm font-semibold text-white uppercase">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($payments as $p)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-3 text-gray-800 text-sm font-medium">
                                {{ $p->user->name }}
                            </td>

                            <td class="px-4 py-3 text-gray-600 text-sm">
                                {{ $p->method }}
                            </td>

                            <td class="px-4 py-3 text-gray-700 font-semibold text-sm">
                                Rp {{ number_format($p->amount) }}
                            </td>

                            <td class="px-4 py-3 text-gray-600 text-sm">
                                {{ $p->month }}
                            </td>

                            <td class="px-4 py-3 text-gray-600 text-sm">
                                {{ $p->year }}
                            </td>

                            <td class="px-4 py-3">
                                @if($p->proof)
                                    <a href="{{ asset('storage/' . $p->proof) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $p->proof) }}"
                                             class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg border shadow">
                                    </a>
                                @else
                                    <span class="text-gray-400 text-sm">Tidak ada bukti</span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                @if($p->status === 'pending')
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>
                                @elseif($p->status === 'confirmed')
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">
                                        Dikonfirmasi
                                    </span>
                                @else($p->status === 'rejected')
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700">
                                        Ditolak
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                <form action="{{ route('admin.payments.update', $p->id) }}"
                                      method="POST" class="space-y-2 w-32 sm:w-full mx-auto">

                                    @csrf
                                    @method('PATCH')

                                    <select name="status"
                                        class="w-full border border-gray-300 rounded-lg p-2 text-sm
                                               focus:ring-green-500 focus:border-green-500
                                               @if($p->status !== 'pending') bg-gray-200 text-gray-500 cursor-not-allowed @endif"
                                        @if($p->status !== 'pending') disabled @endif>

                                        <option value="pending" {{ $p->status=='pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $p->status=='confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="rejected" {{ $p->status=='rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>

                                    @if($p->status === 'pending')
                                    <button
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg shadow text-sm w-full transition">
                                        Update Status
                                    </button>
                                    @else
                                    <button
                                        class="bg-gray-400 text-white px-3 py-2 rounded-lg shadow text-sm w-full cursor-not-allowed"
                                        disabled>
                                        Tidak Bisa Diubah
                                    </button>
                                    @endif

                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <!-- END WRAPPER -->
        </div>

    </div>
</x-app-layout>
