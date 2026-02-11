<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data statistik umum
        $totalUser = User::count();
        $totalService = Service::count();
        $totalTransaction = Transaction::count();
        $totalRevenue = Transaction::where('status', 'berhasil')->sum('nominal');

        // Inisialisasi array untuk Chart
        $chartLabels = [];
        $chartData = [];

        // Loop 7 hari terakhir
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            // Sesuaikan dengan JS: $chartLabels
            $chartLabels[] = $date->format('d M');

            // Sesuaikan dengan JS: $chartData
            // Tetap menggunakan 'tanggal_transaksi' agar data akurat sesuai database Anda
            $count = Transaction::where('status', 'berhasil')
                ->whereDate('tanggal_transaksi', $date->toDateString())
                ->count();
            $chartData[] = $count;
        }

        $serviceDistribution = Transaction::join('services', 'transactions.service_id', '=', 'services.id')
            ->where('transactions.status', 'berhasil')
            ->select('services.nama_layanan as nama', DB::raw('count(*) as total'))
            ->groupBy('services.nama_layanan')
            ->get();

        $serviceLabels = $serviceDistribution->pluck('nama');
        $serviceCounts = $serviceDistribution->pluck('total');

        // Hitung total transaksi sukses untuk ditampilkan di tengah lingkaran
        $totalSuccessTransactions = $serviceDistribution->sum('total');

        return view('pages.dashboard.index', compact(
            'totalUser',
            'totalService',
            'totalTransaction',
            'totalRevenue',
            'chartLabels',
            'chartData',
            'serviceLabels',
            'serviceCounts',
            'totalSuccessTransactions'
        ));
    }
}
