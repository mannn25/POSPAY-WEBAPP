<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Print Struk #{{ $data->id }}</title>
    <style>
        /* Pengaturan Ukuran Kertas Thermal */
        @page {
            size: 58mm auto;
            /* Memaksa ukuran lebar 58mm, tinggi otomatis */
            margin: 0;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            width: 58mm;
            /* Sesuaikan dengan lebar kertas (58mm atau 80mm) */
            margin: 0;
            padding: 5mm;
            font-size: 12px;
            color: #000;
        }

        .text-center {
            text-align: center;
        }

        .fw-bold {
            font-weight: bold;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }

        table td {
            vertical-align: top;
            padding: 2px 0;
        }

        .total-section {
            font-size: 14px;
            margin-top: 5px;
        }

        /* Menghilangkan Header/Footer bawaan browser (URL & Tanggal di pojok) */
        @media print {

            header,
            footer,
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body onload="window.print(); window.onafterprint = function(){ window.close(); }">

    <div class="text-center">
        <span class="fw-bold" style="font-size: 14px;">Pospay</span><br>
        <span style="font-size: 10px;">Jl. Alamat Toko No. 123</span><br>
        <span style="font-size: 10px;">{{ date('d/m/Y H:i', strtotime($data->tanggal_transaksi)) }}</span>
    </div>

    <div class="line"></div>

    <table>
        <tr>
            <td>No. Struk</td>
            <td align="right">#{{ $data->id }}</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td align="right">{{ $data->customer->nama_pelanggan }}</td>
        </tr>
        <tr>
            <td>Layanan</td>
            <td align="right">{{ $data->service->nama_layanan }}</td>
        </tr>
        <tr>
            <td>Petugas</td>
            <td align="right">{{ $data->user->name }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <table class="total-section">
        <tr class="fw-bold">
            <td>TOTAL</td>
            <td align="right">Rp {{ number_format($data->nominal, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="text-center" style="margin-top: 10px;">
        <span>Terima Kasih Atas</span><br>
        <span>Kepercayaan Anda</span>
    </div>

</body>

</html>
