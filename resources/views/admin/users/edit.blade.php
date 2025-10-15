@include('layout.adminhead')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Edit Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="flex pt-[10px]">
    <main class="ml-64 flex-1 p-8 min-h-screen mt-[-65px]">
        <div class="container mx-auto">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Edit Pengguna</h1>
                    <p class="text-gray-500 mt-1 text-sm">Ubah informasi pengguna yang sudah terdaftar</p>
                </div>
            </div>

            {{-- Form Edit Pengguna --}}
            <div class="bg-white rounded-2xl shadow-md p-8 max-w-2xl mx-auto">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                               class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Masukkan nama pengguna" required>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                               class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="contoh@email.com" required>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Password (Opsional)</label>
                        <input type="password" name="password" 
                               class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>

                    {{-- Peran --}}
                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Peran</label>
                        <select name="role" 
                                class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                required>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Status</label>
                        <select name="is_active" 
                                class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                required>
                            <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('admin.users.index') }}" 
                           class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2.5 rounded-md shadow-sm transition duration-200">
                            Batal
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-md shadow-sm transition duration-200">
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>

</body>
</html>
