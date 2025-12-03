<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">

        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="p-4 mb-6 text-green-800 bg-green-200 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Kelola Pengguna</h1>

       {{-- Header Action Row --}}
<div class="flex flex-wrap justify-between items-center mb-6 gap-3">

    {{-- Tombol Tambah User --}}
    <a href="{{ route('admin.users.create') }}"
        class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg shadow-md">
        + Tambah User
    </a>

    {{-- Filter dan Search - di sebelah kanan --}}
    <form method="GET" action="" class="flex flex-wrap items-center gap-3">

        <input type="text" name="search"
            placeholder="Cari nama atau email..."
            value="{{ request('search') }}"
            class="border-gray-300 rounded-lg p-3 w-64 focus:ring-green-500 focus:border-green-500">

        <select name="role"
            class="border-gray-300 rounded-lg p-3 focus:ring-green-500 focus:border-green-500">
            <option value="">Semua Role</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
        </select>

        <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg shadow">
            Filter
        </button>
    </form>
</div>


        {{-- Wrapper Tabel Responsif --}}
        <div class="mt-6 bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-green-600">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">Nama</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">Role</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">No HP</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">Alamat</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">

                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-4 py-3 font-medium text-gray-800 whitespace-nowrap">
                                    {{ $user->name }}
                                </td>

                                <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                    {{ $user->email }}
                                </td>

                                <td class="px-4 py-3 capitalize text-gray-600 whitespace-nowrap">
                                    {{ $user->role }}
                                </td>

                                <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                    {{ $user->phone }}
                                </td>

                                <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                    {{ $user->address }}
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($user->is_active)
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-center whitespace-nowrap flex gap-4 justify-center">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="text-green-600 font-semibold hover:underline">
                                        Edit
                                    </a>

                                    {{-- Hapus --}}
                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 font-semibold hover:underline">
                                            Hapus
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $users->links() }}
        </div>

    </div>
</x-app-layout>
