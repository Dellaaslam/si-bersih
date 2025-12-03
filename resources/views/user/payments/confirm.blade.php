<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow-xl rounded-2xl border">

        <!-- HEADER -->
        <div class="flex items-center gap-3 mb-6">
             <!-- Tombol Kembali -->
            <a href="{{ route('user.payments.index') }}"
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full 
                        bg-green-700 hover:bg-green-800 transition">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                </a>
            <h2 class="text-2xl font-bold text-gray-800">
                Upload Bukti Pembayaran
            </h2>
        </div>

        <form action="{{ route('user.payments.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <input type="hidden" name="payment_method" value="{{ $method }}">

            <!-- METODE PEMBAYARAN -->
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Metode Pembayaran</label>
                <input
                    type="text"
                    class="w-full border p-3 rounded-lg bg-gray-100 text-gray-700 font-medium shadow-sm"
                    value="{{ ucfirst(str_replace('_',' ', $method)) }}"
                    readonly
                >
            </div>

            <!-- NOMOR TUJUAN -->
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Rekening / Tujuan Pembayaran</label>
                <div class="border p-3 rounded-lg bg-gray-100 text-gray-800 font-medium shadow-sm">
                    {{ $account_number }}
                </div>
            </div>

            <!-- BULAN -->
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Bulan Pembayaran</label>
                <select name="month"
                        class="w-full border p-3 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                    @foreach ($months as $num => $name)
                        <option value="{{ $num }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- TAHUN -->
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Tahun Pembayaran</label>
                <input
                    type="number"
                    name="year"
                    value="{{ $year }}"
                    class="w-full border p-3 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
                >
            </div>

            <!-- UPLOAD FILE -->
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Upload Bukti Pembayaran</label>
                <input
                    type="file"
                    name="proof"
                    class="w-full border p-3 rounded-lg shadow-sm bg-gray-50 focus:ring-2 focus:ring-blue-400 transition"
                >
                @error('proof')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- BUTTON SUBMIT -->
            <button
                class="w-full bg-blue-600 text-white py-3 rounded-lg shadow-md hover:bg-blue-700 active:scale-95 transition font-semibold">
                Kirim Pembayaran
            </button>
        </form>

    </div>
</x-app-layout>
