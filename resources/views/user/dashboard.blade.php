<x-app-layout>
    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">
                Selamat Datang, {{ Auth::user()->name ?? Auth::user()->username }} 👋
            </h1>

            <!-- Ringkasan Laporan -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">

            <!-- Total Laporan -->
            <div class="bg-white p-6 shadow-lg rounded-xl border border-gray-200 
                        hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                <div class="flex items-center space-x-4">
                    <div class="p-4 bg-blue-100 text-blue-600 rounded-full shadow-inner">
                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h3m10-12V5a2 2 0 00-2-2h-3m8 14V7m0 10a2 2 0 01-2 2h-3m-6 0h6"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 font-medium">Total Laporan</p>
                        <p class="text-4xl font-bold text-gray-800">{{ $totalLaporan }}</p>
                    </div>
                </div>
            </div>

            <!-- Laporan Menunggu -->
            <div class="bg-white p-6 shadow-lg rounded-xl border border-gray-200 
                        hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                <div class="flex items-center space-x-4">
                    <div class="p-4 bg-yellow-100 text-yellow-600 rounded-full shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 font-medium">Laporan Menunggu</p>
                        <p class="text-4xl font-bold text-yellow-600">{{ $laporanMenunggu }}</p>
                    </div>
                </div>
            </div>

            <!-- Laporan Selesai -->
            <div class="bg-white p-6 shadow-lg rounded-xl border border-gray-200 
                        hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                <div class="flex items-center space-x-4">
                    <div class="p-4 bg-green-100 text-green-600 rounded-full shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 font-medium">Laporan Selesai</p>
                        <p class="text-4xl font-bold text-green-600">{{ $laporanSelesai }}</p>
                    </div>
                </div>
            </div>

        </div>


        <!-- Grid Laporan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
            x-data="{ openModal: false, modalPhoto: '', modalUser: '', modalDate: '', modalDesc: '', modalStatus: '' }">

            @foreach($laporans as $laporan)
                <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden 
                            hover:shadow-2xl hover:-translate-y-1 transition duration-300 cursor-pointer"
                    
                    @click="
                        openModal = true;
                        modalPhoto='{{ asset('storage/'.$laporan->photo) }}';
                        modalUser='{{ $laporan->user->name ?? $laporan->user->username }}';
                        modalDate='{{ $laporan->created_at->format('d-m-Y') }}';
                        modalDesc='{{ $laporan->description }}';
                        modalStatus='{{ $laporan->status }}';
                    ">
                    
                    <!-- Foto -->
                    <div class="w-full h-56 bg-gray-200 overflow-hidden">
                        <img src="{{ asset('storage/'.$laporan->photo) }}"
                            class="w-full h-full object-cover hover:scale-105 transition duration-500">
                    </div>

                    <!-- Info -->
                    <div class="p-5 space-y-4">

                        <!-- Header -->
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-gray-800">
                                    {{ $laporan->user->name ?? $laporan->user->username }}
                                </p>
                                <p class="text-gray-500 text-xs">
                                    {{ $laporan->created_at->format('d-m-Y') }}
                                </p>
                            </div>

                <!-- Status Badge + Icon -->
                <span class="flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold
                    {{ $laporan->status=='confirmed' ? 'bg-green-100 text-green-700' : '' }}
                    {{ $laporan->status=='pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $laporan->status=='rejected' ? 'bg-red-100 text-red-700' : '' }}">

                    @if($laporan->status == 'confirmed')
                        {{-- ICON Checklist --}}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>

                    @elseif($laporan->status == 'pending')
                        {{-- ICON Jam --}}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    @else
                        {{-- ICON X --}}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    @endif

                    {{ $laporan->status }}
                </span>

                        </div>

                        <!-- Deskripsi -->
                        <p class="text-gray-700 text-sm leading-relaxed">
                            {{ Str::limit($laporan->description, 110) }}
                        </p>
                    </div>
                </div>
            @endforeach



                <!-- Modal -->
                <div x-show="openModal"
                    class="fixed inset-0 bg-black/60 flex items-center justify-center z-50"
                    x-cloak>
                    
                    <div class="bg-white rounded-xl shadow-2xl max-w-xl w-full p-6 relative overflow-y-auto max-h-[90vh]">

                        <button class="absolute top-3 right-3 text-gray-600 hover:text-black text-2xl font-bold"
                                @click="openModal=false">&times;</button>

                        <img :src="modalPhoto"
                            class="w-full h-80 object-cover rounded-lg mb-4">

                        <div class="mb-4">
                            <p class="font-semibold text-lg text-gray-800" x-text="modalUser"></p>
                            <p class="text-gray-500 text-sm" x-text="modalDate"></p>
                        </div>

                        <p class="text-gray-700 mb-4 leading-relaxed" x-text="modalDesc"></p>

                        <span class="px-3 py-1 rounded-full text-sm font-semibold"
                            :class="modalStatus == 'confirmed' ? 'bg-green-200 text-green-800' :
                                    modalStatus == 'pending' ? 'bg-yellow-200 text-yellow-800' :
                                    'bg-red-200 text-red-800'">
                
                            <!-- ICON di modal -->
                            <template x-if="modalStatus == 'confirmed'">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </template>

                            <template x-if="modalStatus == 'pending'">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3" />
                                </svg>
                            </template>

                            <template x-if="modalStatus == 'rejected'">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </template>

                            <span x-text="modalStatus"></span>

                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Tombol Tambah -->
    <a href="{{ route('user.reports.create') }}"
        class="fixed bottom-6 right-6 bg-green-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-xl text-3xl hover:bg-green-700 transition">
        +
    </a>
</x-app-layout>
