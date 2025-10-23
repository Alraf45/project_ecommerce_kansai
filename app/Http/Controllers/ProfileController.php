<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * 🧭 Menampilkan halaman edit profil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * 💾 Update profil user (nama, email, dan foto profil)
     */
    public function update(Request $request, $id = null)
    {
        $authUser = Auth::user();

        // 🧩 Pilih user yang akan diupdate
        // Jika $id diberikan dan admin, bisa update profil user lain
        $user = $id && $authUser->role === 'admin' ? User::findOrFail($id) : $authUser;

        // ❌ Non-admin tidak boleh edit user lain
        if ($authUser->role !== 'admin' && $user->id !== $authUser->id) {
            abort(403, 'Anda tidak punya izin untuk mengubah profil ini.');
        }

        // ✅ Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 📸 Upload foto profil (jika ada)
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Simpan foto baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        // 🔄 Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * 🗑️ Hapus akun user
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Hapus foto profil jika ada
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();
        Auth::logout();

        return redirect('/')->with('success', 'Akun berhasil dihapus!');
    }
}
