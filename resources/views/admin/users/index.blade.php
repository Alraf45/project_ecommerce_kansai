@include('layout.adminhead')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | Daftar Pengguna</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="flex pt-[10px]">
  <main class="ml-64 flex-1 p-8 min-h-screen mt-[-65px]">
    <div class="container mx-auto">

      {{-- Header --}}
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-3xl font-bold text-gray-800">Daftar Pengguna</h1>
          <p class="text-gray-500 mt-1 text-sm">Kelola data akun pengguna dan admin</p>
        </div>
        <a href="{{ route('admin.users.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow transition duration-200">
          + Tambah Pengguna
        </a>
      </div>

      {{-- Notifikasi sukses --}}
      @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow">
          {{ $message }}
        </div>
      @endif

      {{-- Tabel Pengguna --}}
      <div class="overflow-hidden bg-white rounded-2xl shadow-md">
        <table class="min-w-full border-collapse">
          <thead class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wide">
            <tr>
              <th class="px-5 py-3 text-left">No</th>
              <th class="px-5 py-3 text-left">Nama</th>
              <th class="px-5 py-3 text-left">Email</th>
              <th class="px-5 py-3 text-left">Peran </th>
              <th class="px-5 py-3 text-center">Status</th>
              <th class="px-5 py-3 text-center">Login Terakhir</th>
              <th class="px-5 py-3 text-center">Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($users as $i => $user)
              <tr class="border-t hover:bg-gray-50 transition">
                <td class="px-5 py-3 text-gray-600">
                  {{-- Jika pakai paginate() --}}
                  @if(method_exists($users, 'firstItem'))
                    {{ $users->firstItem() + $i }}
                  @else
                    {{ $i + 1 }}
                  @endif
                </td>

                <td class="px-5 py-3 font-semibold text-gray-800">{{ $user->name }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $user->email }}</td>

                {{-- Role --}}
                <td class="px-5 py-3 text-gray-700 capitalize">
                  <span class="px-3 py-1 rounded-full text-xs font-medium
                    {{ $user->role == 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-700' }}">
                    {{ $user->role }}
                  </span>
                </td>

                {{-- Status --}}
                <td class="px-5 py-3 text-center">
                  @if($user->is_active)
                    <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full font-medium">Aktif</span>
                  @else
                    <span class="bg-red-100 text-red-700 text-sm px-3 py-1 rounded-full font-medium">Nonaktif</span>
                  @endif
                </td>

                {{-- Login terakhir --}}
                <td class="px-5 py-3 text-center text-gray-600">
                  {{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('d M Y, H:i') : '-' }}
                </td>

                {{-- Tombol Aksi --}}
                <td class="px-4 py-3 text-center">
                  <div class="flex flex-col items-center gap-2">
                    {{-- Edit --}}
                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                       class="inline-flex items-center justify-center gap-1 bg-yellow-500 hover:bg-yellow-600 
                              text-white text-sm font-semibold px-4 py-2 rounded-md shadow-sm w-24 transition-all duration-200">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" 
                           viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                              d="M15.232 5.232a3 3 0 014.243 4.243L7.5 21.5H3v-4.5L15.232 5.232z" />
                      </svg>
                      Edit
                    </a>

                    {{-- Hapus --}}
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                          onsubmit="return confirm('Yakin hapus pengguna ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                              class="inline-flex items-center justify-center gap-1 bg-red-600 hover:bg-red-700 
                                     text-white text-sm font-semibold px-4 py-2 rounded-md shadow-sm w-24 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" 
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-5 text-gray-500">Belum ada pengguna terdaftar.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      @if(method_exists($users, 'links'))
      <div class="mt-6 flex justify-end">
        {{ $users->links() }}
      </div>
      @endif

    </div>
  </main>
</div>

</body>
</html>
