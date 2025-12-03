<x-app-layout>
    <div class="p-6 max-w-3xl mx-auto">

        <!-- Button Riwayat -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('user.payments.history') }}"
               class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                Riwayat Pembayaran
            </a>
        </div>

        

        <!-- Box Section -->
        <div class="bg-gray-100 border border-gray-300 shadow-md rounded-2xl p-8">

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-900">
                Pilih Metode Pembayaran
            </h2>

            <form action="{{ route('user.payments.confirm') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- CARD QRIS -->
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="qris" class="peer hidden" />

                        <div class="bg-white border border-gray-300 rounded-xl p-6 text-center 
                                    shadow-md transition transform
                                    peer-checked:border-green-500 peer-checked:shadow-[0_0_12px_rgba(0,200,0,0.6)]
                                    hover:shadow-[0_0_15px_rgba(0,200,0,0.5)]
                                    hover:-translate-y-1">

                            <img src="{{ asset('qris.png') }}"
                                 alt="QRIS"
                                 class="w-40 md:w-44 mx-auto block mb-4">

                            <h4 class="font-semibold text-lg">QRIS</h4>
                        </div>
                    </label>

                    <!-- CARD TRANSFER BANK -->
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="bank_transfer" class="peer hidden" />

                        <div class="bg-white border border-gray-300 rounded-xl p-6 text-center 
                                    shadow-md transition transform
                                    peer-checked:border-green-500 peer-checked:shadow-[0_0_12px_rgba(0,200,0,0.6)]
                                    hover:shadow-[0_0_15px_rgba(0,200,0,0.5)]
                                    hover:-translate-y-1">

                            <img src="{{ asset('bank.jpeg') }}"
                                 alt="Bank"
                                 class="w-40 md:w-44 mx-auto block mb-4">

                            <h4 class="font-semibold text-lg">Transfer Bank</h4>
                        </div>
                    </label>

                    <!-- CARD E-WALLET -->
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="ewallet" class="peer hidden" />

                        <div class="bg-white border border-gray-300 rounded-xl p-6 text-center 
                                    shadow-md transition transform
                                    peer-checked:border-green-500 peer-checked:shadow-[0_0_12px_rgba(0,200,0,0.6)]
                                    hover:shadow-[0_0_15px_rgba(0,200,0,0.5)]
                                    hover:-translate-y-1">

                            <img src="{{ asset('dana.png') }}"
                                 alt="E-Wallet"
                                 class="w-40 md:w-44 mx-auto block mb-4">

                            <h4 class="font-semibold text-lg">E-Wallet</h4>
                        </div>
                    </label>

                </div>

                <div class="text-center mt-8">
                    <button class="bg-green-600 text-white px-6 py-3 rounded-xl text-lg font-semibold 
                                   hover:bg-green-700 transition">
                        Lanjutkan
                    </button>
                </div>

            </form>
        </div>
        <!-- End Box Section -->

    </div>
</x-app-layout>
