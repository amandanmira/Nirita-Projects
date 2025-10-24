<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mobil - Nirita Rental Mobil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .detail-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin: 40px 0;
        }

        .detail-image {
            text-align: center;
        }

        .detail-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .detail-info h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .detail-info p {
            color: #666;
            margin: 15px 0;
            font-size: 16px;
        }

        .detail-info strong {
            color: #333;
        }

        .kalkulasi-sewa {
            background: #f9f9f9;
            border: 2px solid #333;
            padding: 30px;
            border-radius: 8px;
            margin-top: 30px;
        }

        .kalkulasi-sewa h3 {
            color: #333;
            margin-bottom: 20px;
            font-size: 20px;
            text-align: center;
        }

        .form-group {
            margin: 20px 0;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group input[readonly] {
            background: #e9ecef;
            cursor: not-allowed;
        }

        .input-number {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 10px;
            align-items: center;
        }

        .btn-operator {
            padding: 10px 15px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
        }

        .btn-operator:hover {
            background: #555;
        }

        .input-number input {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .total-section {
            background: #fff;
            padding: 20px;
            border-top: 2px solid #ddd;
            margin-top: 20px;
            border-radius: 4px;
        }

        .total-section p {
            font-size: 18px;
            margin: 10px 0;
        }

        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: #0066cc;
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            background: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            text-align: center;
        }

        .btn:hover {
            background: #555;
        }

        .btn-kembali {
            background: #666;
            margin-bottom: 20px;
            display: inline-block;
            width: auto;
        }

        .btn-kembali:hover {
            background: #888;
        }

        .deskripsi {
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 20px 0;
            grid-column: 1 / -1;
        }

        .spek-fasilitas-box {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            text-align: left;
            margin-top: 20px;
            border: 1px solid #e0e0e0;
        }

        .spek-fasilitas-box h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .spek-item {
            margin: 12px 0;
            color: #666;
            font-size: 15px;
        }

        .spek-item strong {
            color: #333;
            min-width: 150px;
            display: inline-block;
        }

        .fasilitas-list {
            list-style: none;
            padding: 0;
        }

        .fasilitas-list li {
            margin: 10px 0;
            color: #666;
            padding-left: 25px;
            position: relative;
            line-height: 1.6;
        }

        .fasilitas-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #0066cc;
            font-weight: bold;
            font-size: 18px;
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        footer a {
            color: #fff;
        }

        @media (max-width: 768px) {
            .detail-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Nirita Rental Mobil</h1>
        <p>Sewa mobil terbaik untuk perjalanan Anda</p>
    </header>

    <div class="container">
        <a href="/" class="btn-kembali">← Kembali</a>

        <div class="detail-container">
            <div class="detail-image">
                @if($car->url_foto_mobil)
                    <img src="{{ asset('storage/' . $car->url_foto_mobil) }}" alt="{{ $car->nama_mobil }}">
                @else
                    <div
                        style="width: 100%; height: 400px; background: #ddd; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <p>Foto tidak tersedia</p>
                    </div>
                @endif

                <!-- SECTION SPESIFIKASI & FASILITAS -->
                <div class="spek-fasilitas-box">
                    <h3>Spesifikasi Mobil</h3>

                    <div class="spek-item">
                        <strong>Kapasitas Penumpang:</strong> {{ $car->specification->kapasitas ?? '-' }} orang
                    </div>

                    <div class="spek-item">
                        <strong>Kategori:</strong> {{ $car->specification->kategori ?? '-' }}
                    </div>

                    <div class="spek-item">
                        <strong>Jenis Transmisi:</strong> {{ $car->specification->jenis_transmisi ?? '-' }}
                    </div>

                    <h3 style="margin-top: 25px;">Fasilitas</h3>

                    <ul class="fasilitas-list">
                        @if($car->specification && $car->specification->fasilitas)
                            @php
                                $fasilitasList = is_array($car->specification->fasilitas)
                                    ? $car->specification->fasilitas
                                    : json_decode($car->specification->fasilitas, true);
                            @endphp

                            @if($fasilitasList && is_array($fasilitasList))
                                @foreach($fasilitasList as $fasilitas)
                                    <li>{{ $fasilitas }}</li>
                                @endforeach
                            @else
                                <li style="color: #999;">Fasilitas tidak tersedia</li>
                            @endif
                        @else
                            <li style="color: #999;">Fasilitas tidak tersedia</li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="detail-info">
                <h2>{{ $car->nama_mobil }}</h2>

                <p>
                    <strong>Plat Nomor:</strong> {{ $car->plat_nomor }}
                </p>

                @if($car->rentalPrice)
                    <div style="background: #f0f0f0; padding: 15px; border-radius: 8px; margin: 15px 0;">
                        <p style="margin: 10px 0;">
                            <strong>Harga per Hari (Dalam Kota Solo):</strong>
                            <span style="color: #0066cc; font-size: 16px; font-weight: bold;">
                                Rp {{ number_format($car->rentalPrice->harga_solo ?? 0, 0, ',', '.') }}
                            </span>
                        </p>
                        <p style="margin: 10px 0;">
                            <strong>Harga per Hari (Soloraya):</strong>
                            <span style="color: #0066cc; font-size: 16px; font-weight: bold;">
                                Rp {{ number_format($car->rentalPrice->harga_solo_raya ?? 0, 0, ',', '.') }}
                            </span>
                        </p>
                        <p style="margin: 10px 0;">
                            <strong>Harga per Hari (Luar Kota):</strong>
                            <span style="color: #0066cc; font-size: 16px; font-weight: bold;">
                                Rp {{ number_format($car->rentalPrice->harga_luar_kota ?? 0, 0, ',', '.') }}
                            </span>
                        </p>
                    </div>
                @endif

                <p>
                    <strong>Unit Tersedia:</strong> {{ $car->ketersediaan }}
                </p>

                <div class="kalkulasi-sewa">
                    <h3>Kalkulasi Sewa</h3>

                    <div class="form-group">
                        <label>Pilih Tarif</label>
                        <select id="pilihanTarif"
                            style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                            <option value="solo">Dalam Kota Solo - Rp
                                {{ number_format($car->rentalPrice->harga_solo ?? 0, 0, ',', '.') }}/hari</option>
                            <option value="soloraya">Soloraya - Rp
                                {{ number_format($car->rentalPrice->harga_solo_raya ?? 0, 0, ',', '.') }}/hari</option>
                            <option value="luar_kota">Luar Kota - Rp
                                {{ number_format($car->rentalPrice->harga_luar_kota ?? 0, 0, ',', '.') }}/hari</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga per Hari</label>
                        <input type="text" id="hargaPerHari"
                            value="Rp {{ number_format($car->rentalPrice->harga_solo ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Hari</label>
                        <div class="input-number">
                            <button type="button" class="btn-operator" id="btnKurang">−</button>
                            <input type="number" id="jumlahHari" value="1" min="1" readonly>
                            <button type="button" class="btn-operator" id="btnTambah">+</button>
                        </div>
                    </div>

                    <div class="total-section">
                        <div class="form-group">
                            <label>Total Biaya</label>
                            <div class="total-amount" id="totalBiaya">
                                Rp {{ number_format($car->rentalPrice->harga_solo ?? 0, 0, ',', '.') }}
                            </div>
                        </div>

                        <small style="color: #999; display: block; text-align: center; margin-top: 15px;">
                            * Estimasi biaya final sesuai invoice dari admin
                        </small>
                    </div>
                </div>

                <button class="btn" style="margin-top: 20px;">Pesan Sekarang</button>
            </div>

            @if($car->deskripsi)
                <div class="deskripsi">
                    <h3>Deskripsi Mobil</h3>
                    <p>{{ $car->deskripsi }}</p>
                </div>
            @endif
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Nirita Rental Mobil. All rights reserved.</p>
        <a href="{{ route('admin.') }}">Admin Panel</a>
    </footer>

    <script>
        const hargaSolo = {{ $car->rentalPrice->harga_solo ?? 0 }};
        const hargaSoloraya = {{ $car->rentalPrice->harga_solo_raya ?? 0 }};
        const hargaLuarKota = {{ $car->rentalPrice->harga_luar_kota ?? 0 }};

        let hargaPerHariValue = hargaSolo;

        const pilihanTarifSelect = document.getElementById('pilihanTarif');
        const hargaPerHariInput = document.getElementById('hargaPerHari');
        const jumlahHariInput = document.getElementById('jumlahHari');
        const totalBiayaDiv = document.getElementById('totalBiaya');
        const btnTambah = document.getElementById('btnTambah');
        const btnKurang = document.getElementById('btnKurang');

        function formatRupiah(angka) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
        }

        function updateHarga() {
            const tarif = pilihanTarifSelect.value;

            if (tarif === 'solo') {
                hargaPerHariValue = hargaSolo;
            } else if (tarif === 'soloraya') {
                hargaPerHariValue = hargaSoloraya;
            } else if (tarif === 'luar_kota') {
                hargaPerHariValue = hargaLuarKota;
            }

            hargaPerHariInput.value = formatRupiah(hargaPerHariValue);
            hitungTotal();
        }

        function hitungTotal() {
            const jumlahHari = parseInt(jumlahHariInput.value) || 1;
            const total = hargaPerHariValue * jumlahHari;
            totalBiayaDiv.textContent = formatRupiah(total);
        }

        pilihanTarifSelect.addEventListener('change', updateHarga);

        btnTambah.addEventListener('click', function () {
            let nilai = parseInt(jumlahHariInput.value) || 1;
            jumlahHariInput.value = nilai + 1;
            hitungTotal();
        });

        btnKurang.addEventListener('click', function () {
            let nilai = parseInt(jumlahHariInput.value) || 1;
            if (nilai > 1) {
                jumlahHariInput.value = nilai - 1;
                hitungTotal();
            }
        });

        hitungTotal();
    </script>
</body>

</html>