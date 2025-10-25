<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            color: #002060;
            margin: 40px;
            font-size: 12pt;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #002060;
            font-size: 28pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 2px solid #002060;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
            font-size: 14px;
        }

        .no-border {
            border: none;
        }

        .header-text {
            margin-bottom: -10px;
            font-size: 15px;
        }

        .signature {
            margin-top: 60px;
            width: 100%;
            text-align: left;
        }

        .signature div {
            margin-top: 40px;
        }

        .total-section td {
            font-weight: bold;
        }

        .driver {
            margin-top: 10px;
            font-size: 12pt;
        }

        .penyewa {
            margin-left: 2rem;
            font-size: 16pt;
        }

        .footer {
            margin-top: 50px;
        }

        .footer strong {
            display: block;
        }

        table>thead>tr>th {
            font-size: 16pt;
            text-align: center;
            height: 100px;
        }

        table>tbody>tr>td {
            font-size: 11pt;
            text-align: center;
        }

        .harga {
            text-align: right;
        }
    </style>
</head>

<body>
    <h2>INVOICE</h2>

    <p class="penyewa"><strong>Kepada: {{ $nama ?? '' }}</strong></p>

    <p class="header-text">
        <strong>Bersama ini kami sampaikan, tagihan sewa kendaraan dengan rincian sebagai berikut:</strong>
    </p>

    <table>
        <thead>
            <tr>
                <th style="width:4%;">No</th>
                <th style="width:14%">Nama Kendaraan</th>
                <th style="width:15%">Periode</th>
                <th style="width:42%">Tujuan/Kegiatan</th>
                <th style="width:25%">Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items ?? [] as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item['nama'] ?? '' }}</td>
                    <td>{{ $item['periode'] ?? '' }}</td>
                    <td>{{ $item['tujuan'] ?? '' }}</td>
                    <td class="harga">{{ number_format($item['harga'] ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-section">
                <td colspan="2">TOTAL:</td>
                <td colspan="2"></td>
                <td class="harga">{{ number_format($total ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>TERBILANG:</strong></td>
                <td colspan="3" style="text-align: center"><strong>{{ $terbilang ?? '' }}</strong></td>
            </tr>
        </tbody>
    </table>

    <p class="driver"><strong>Driver:</strong><br>{{ $driver ?? '' }}</p>

    <div class="footer">
        <p>Solo, {{ $tanggal ?? '' }}<br>Hormat Kami,</p>
        <br><br><br><br>
        <div>
            {{ $penanggungJawab ?? 'Hari Suryono' }}<br>
            <strong>{{ $perusahaan ?? 'Nirta Transport' }}</strong>
        </div>
    </div>
</body>

</html>