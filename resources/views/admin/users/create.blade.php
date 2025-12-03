<x-app-layout>
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">

        <!-- Header: Tombol Kembali + Judul -->
        <div class="flex items-center gap-4 mb-8">
            
            <!-- Tombol Kembali -->
            <a href="{{ route('admin.usermanagement') }}"
                class="inline-flex items-center justify-center w-10 h-10 rounded-full 
                bg-green-700 hover:bg-green-800 transition shadow">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </a>

            <h1 class="text-3xl font-extrabold text-gray-800 tracking-wide">
                Tambah Pengguna
            </h1>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="flex flex-col">
                <label class="font-semibold text-gray-700 mb-1">Nama</label>
                <input type="text" name="name"
                    class="border rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            </div>

            <div class="flex flex-col">
                <label class="font-semibold text-gray-700 mb-1">Email</label>
                <input type="email" name="email"
                    class="border rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            </div>

            <div class="flex flex-col">
                <label class="font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                    class="border rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            </div>

            <div class="flex flex-col">
                <label class="font-semibold text-gray-700 mb-1">Nomor HP</label>
                <input type="text" name="phone"
                    class="border rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            </div>

            <div class="flex flex-col">
                <label class="font-semibold text-gray-700 mb-1">Alamat</label>
                <textarea name="address"
                    class="border rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none" rows="3" required></textarea>
            </div>

            <div class="flex flex-col">
                <label class="font-semibold text-gray-700 mb-1">Role</label>
                <select name="role"
                    class="border rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold text-lg transition shadow">
                Simpan
            </button>

        </form>
    </div>
</x-app-layout>
