<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10 px-4">

        <!-- HEADER -->
        <div class="flex items-center gap-4 mb-8">

        <!-- Tombol Kembali -->
       <a href="{{ route('user.payments.index') }}"
            class="inline-flex items-center justify-center w-10 h-10 rounded-full 
                bg-green-700 hover:bg-green-800 transition">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6"/>
            </svg>
        </a>

            <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                Riwayat Pembayaran
            </h2>
        </div>

        <!-- CONTENT CARD -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">

            @if($payments->isEmpty())

                <div class="py-10 text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076507.png"
                         class="w-32 mx-auto mb-4 opacity-70">
                    <p class="text-gray-600 text-lg font-medium">
                        Belum ada riwayat pembayaran.
                    </p>
                </div>

            @else

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse rounded-lg overflow-hidden">

                        <thead>
                            <tr class="bg-gray-100 text-gray-700 font-semibold">
                                <th class="p-4 text-left">Bulan</th>
                                <th class="p-4 text-left">Tahun</th>
                                <th class="p-4 text-left">Status</th>
                                <th class="p-4 text-left">Bukti</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-800">
                            @foreach ($payments as $p)
                                <tr class="border-b hover:bg-gray-50 transition">

                                    <td class="p-4">
                                        {{ DateTime::createFromFormat('!m', $p->month)->format('F') }}
                                    </td>

                                    <td class="p-4">
                                        {{ $p->year }}
                                    </td>

                                    <!-- STATUS BADGE -->
                                    <td class="p-4">
                                        @if($p->status === 'pending')
                                            <span class="px-3 py-1 bg-yellow-200 text-yellow-800 rounded-full text-xs font-semibold">
                                                Pending
                                            </span>

                                        @elseif($p->status === 'confirmed')
                                            <span class="px-3 py-1 bg-green-200 text-green-800 rounded-full text-xs font-semibold">
                                                Approved
                                            </span>

                                        @else($p->status === 'Rejected')
                                            <span class="px-3 py-1 bg-red-200 text-red-800 rounded-full text-xs font-semibold">
                                                Rejected
                                            </span>
                                        @endif
                                    </td>

                                    <!-- LINK BUKTI -->
                                    <td class="p-4">
                                        <a href="{{ asset('storage/' . $p->proof) }}" 
                                           target="_blank"
                                           class="inline-block px-3 py-1 bg-blue-600 text-white rounded-lg text-sm 
                                                  shadow hover:bg-blue-700 transition">
                                            Lihat Bukti
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            @endif

        </div>

    </div>
</x-app-layout>
