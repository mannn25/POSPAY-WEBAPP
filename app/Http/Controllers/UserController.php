<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $petugas = User::all();

        // Mapping untuk menentukan warna berdasarkan inisial nama petugas
        $petugas->map(function ($item) {
            $palette = [
                ['bg' => '#E3F2FD', 'text' => '#0D47A1'], // Biru
                ['bg' => '#FCE4EC', 'text' => '#880E4F'], // Pink
                ['bg' => '#E8F5E9', 'text' => '#1B5E20'], // Hijau
                ['bg' => '#FFF3E0', 'text' => '#E65100'], // Oranye
                ['bg' => '#F3E5F5', 'text' => '#4A148C'], // Ungu
                ['bg' => '#E0F7FA', 'text' => '#006064'], // Teal
                ['bg' => '#FFFDE7', 'text' => '#F57F17'], // Kuning
            ];

            // Gunakan nama petugas untuk menentukan index warna
            $name = $item->name ?? 'Admin';
            $index = ord(strtoupper(substr($name, 0, 1))) % count($palette);

            // Masukkan properti warna ke dalam objek $item
            $item->avatar_bg = $palette[$index]['bg'];
            $item->avatar_text = $palette[$index]['text'];

            return $item;
        });

        return view('pages.petugas.index', compact('petugas'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'name' => 'required|string|max:100',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,petugas'
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->back()->with('success', ucfirst($request->role) . 'Berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'name'     => 'required|string|max:255',
            'role'     => 'required|in:admin,petugas',
            'password' => 'nullable|min:8', // Password opsional saat edit
        ]);

        // 2. Cari data petugas
        $user = User::findOrFail($id);

        // 3. Update data dasar
        $user->username = $request->username;
        $user->name = $request->name;
        $user->role = $request->role;

        // 4. Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // 5. Kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data petugas berhasil diperbarui!');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('delete', ' Petugas berhasil dihapus!');
    }
}
