<x-app-layout>
    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Judul -->
            <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">
                Selamat Datang, {{ Auth::user()->name ?? Auth::user()->username }} 👋
            </h1>

            <!-- Ringkasan Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <p class="text-gray-500 text-sm">Total Pengguna</p>
                    <p class="text-3xl font-bold text-green-700 mt-2">{{ $totalUsers }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <p class="text-gray-500 text-sm">Total Laporan</p>
                    <p class="text-3xl font-bold text-blue-700 mt-2">{{ $totalLaporan }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <p class="text-gray-500 text-sm">Laporan Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $laporanMenunggu }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <p class="text-gray-500 text-sm">Laporan Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $laporanSelesai }}</p>
                </div>

            </div>

            <!-- Grafik -->
            <div class="bg-white p-6 rounded-xl shadow mb-10">
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">Laporan Per Bulan</h2>
                <canvas id="laporanChart" height="120"></canvas>
            </div>

            <!-- Tabel Laporan -->
          <!-- Tabel Laporan -->
<!-- Tabel Laporan Terbaru (diperbarui) -->
<div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-2xl font-semibold mb-4 text-gray-700">Laporan Terbaru</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">No</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">User</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach(\App\Models\Reports::latest()->take(10)->get() as $index => $laporan)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm font-medium text-gray-800">
                            {{ $laporan->user->name ?? $laporan->user->username }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">
                            {{ $laporan->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700 leading-relaxed">
                            {{ $laporan->description }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <div class="flex justify-center">
                                @php
                                    switch(strtolower($laporan->status)) {
                                        case 'menunggu':
                                        case 'pending':
                                            $statusClass = 'bg-yellow-500 text-white';
                                            break;
                                        case 'ditolak':
                                        case 'rejected':
                                            $statusClass = 'bg-red-500 text-white';
                                            break;
                                        case 'selesai':
                                        case 'confirmed':
                                            $statusClass = 'bg-green-600 text-white';
                                            break;
                                        default:
                                            $statusClass = 'bg-gray-400 text-white';
                                    }
                                @endphp
                                <span class="px-3 py-1.5 rounded-full text-xs font-semibold shadow {{ $statusClass }}">
                                    {{ ucfirst($laporan->status) }}
                                </span>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('laporanChart').getContext('2d');

    // Gradien warna grafik
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(34,197,94,0.9)');
    gradient.addColorStop(1, 'rgba(34,197,94,0.3)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [{
                label: 'Jumlah Laporan',
                data: [
                    @for ($i=1; $i<=12; $i++)
                        {{ $laporanPerBulan[$i] ?? 0 }},
                    @endfor
                ],
                backgroundColor: gradient,
                borderColor: 'rgba(34,197,94,1)',
                borderWidth: 2,
                borderRadius: 15,
                barThickness: 35,
                hoverBackgroundColor: 'rgba(34,197,94,1)',
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    grid: { display: false }
                }
            },
            plugins: {
                tooltip: {
                    backgroundColor: '#111827',
                    padding: 12,
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    titleFont: { weight: 'bold' },
                    bodyFont: { size: 14 },
                    cornerRadius: 8
                },
                legend: {
                    labels: {
                        font: { size: 14, weight: 'bold' },
                        color: '#374151'
                    }
                }
            }
        }
    });
</script>

</x-app-layout>
