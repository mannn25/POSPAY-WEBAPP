<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil data transaksi beserta relasinya
        $transaksi = Transaction::with(['customer', 'service', 'user'])
            ->latest()
            ->get();

        // Mapping data untuk menambahkan warna avatar secara dinamis
        $transaksi->map(function ($item) {
            // Tentukan palet warna soft (Background & Teks)
            $palette = [
                ['bg' => '#E3F2FD', 'text' => '#0D47A1'], // Biru
                ['bg' => '#FCE4EC', 'text' => '#880E4F'], // Pink
                ['bg' => '#E8F5E9', 'text' => '#1B5E20'], // Hijau
                ['bg' => '#FFF3E0', 'text' => '#E65100'], // Oranye
                ['bg' => '#F3E5F5', 'text' => '#4A148C'], // Ungu
                ['bg' => '#E0F7FA', 'text' => '#006064'], // Teal
                ['bg' => '#FFFDE7', 'text' => '#F57F17'], // Kuning
            ];

            // Ambil nama pelanggan, jika kosong beri default 'Guest'
            $name = $item->customer->nama_pelanggan ?? 'Guest';

            // Gunakan nilai ASCII huruf pertama untuk memilih index warna agar konsisten
            $index = ord(strtoupper(substr($name, 0, 1))) % count($palette);

            // Masukkan data warna ke dalam objek item
            $item->avatar_bg = $palette[$index]['bg'];
            $item->avatar_text = $palette[$index]['text'];

            return $item;
        });

        $services = Service::all();

        return view('pages.transaksi.index', compact('transaksi', 'services'));
    }

    public function insert(Request $request)
    {
        // bersihkan titik nominal dulu
        $nominalBersih = str_replace('.', '', $request->nominal);

        $request->merge([
            'nominal' => $nominalBersih
        ]);

        $request->validate([
            'nama_pelanggan'     => 'required',
            'nomor_pelanggan'    => 'required',
            'service_id'         => 'required',
            'tanggal_transaksi'  => 'required',
            'nominal'            => 'required|numeric',
            'status'             => 'required|in:berhasil,gagal'
        ]);

        // buat / ambil customer
        $customer = Customer::firstOrCreate(
            ['nomor_pelanggan' => $request->nomor_pelanggan],
            ['nama_pelanggan'  => $request->nama_pelanggan]
        );

        $transaction = Transaction::create([
            'user_id'           => auth()->id(),
            'service_id'        => $request->service_id,
            'customer_id'       => $customer->id,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'nominal'           => $nominalBersih,
            'status'            => $request->status
        ]);

        return back()->with([
            'success'  => 'Transaksi berhasil disimpan',
            'print_id' => $transaction->id
        ]);
    }

    public function print($id)
    {
        $data = Transaction::with(['customer', 'service', 'user'])->findOrFail($id);
        return view('pages.transaksi.print', compact('data'));
    }
}
