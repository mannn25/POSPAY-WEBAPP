<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::all();
        return view('pages.service.index', compact('service'));
    }

    public function insert(Request $request)
    {
        Service::create([
            'kode_layanan' => $request->kode_layanan,
            'nama_layanan' => $request->nama_layanan
        ]);

        return redirect()->back()->with('success', 'Jenis layanan berhasil ditambah');
    }

    public function update(Request $request, $id)
    {
        Service::where('id', $id)->update([
            'kode_layanan' => $request->kode_layanan,
            'nama_layanan' => $request->nama_layanan
        ]);

        return redirect()->back()->with('success', 'Jenis layanan berhasil diupdate!');
    }

    public function delete($id)
    {
        Service::where('id', $id)->delete();

        return redirect()->back()->with('delete', 'Jenis layanan berhasil dihapus!');
    }
}
