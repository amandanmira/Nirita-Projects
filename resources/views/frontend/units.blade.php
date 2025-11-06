<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Units - Nirita Rental Mobil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background: #f5f5f5;
        }

        header {
            background: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        nav {
            background: #444;
            padding: 0;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: 0;
        }

        .nav-container a {
            color: #fff;
            text-decoration: none;
            padding: 15px 25px;
            display: block;
            transition: background 0.3s;
        }

        .nav-container a:hover,
        .nav-container a.active {
            background: #0066cc;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .page-title {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: #666;
            margin-bottom: 30px;
        }

        .filter-section {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .filter-section h3 {
            color: #333;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .filter-group input,
        .filter-group select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #0066cc;
        }

        .price-range {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 10px;
            align-items: center;
        }

        .price-range span {
            text-align: center;
            color: #666;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-primary {
            background: #0066cc;
            color: #fff;
        }

        .btn-primary:hover {
            background: #0052a3;
        }

        .btn-secondary {
            background: #666;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #555;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .results-count {
            color: #666;
            font-size: 14px;
        }

        .car-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .car-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .car-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .car-info {
            padding: 20px;
        }

        .car-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .car-details {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 15px 0;
            font-size: 14px;
            color: #666;
        }

        .car-detail-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .car-detail-item::before {
            content: "•";
            color: #0066cc;
            font-weight: bold;
            font-size: 18px;
        }

        .car-price {
            font-size: 18px;
            font-weight: bold;
            color: #0066cc;
            margin: 15px 0;
        }

        .car-plat {
            color: #999;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .car-availability {
            display: inline-block;
            padding: 5px 12px;
            background: #e8f5e9;
            color: #2e7d32;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .btn-detail {
            width: 100%;
            padding: 12px;
            background: #333;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 4px;
            display: block;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-detail:hover {
            background: #0066cc;
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #999;
            background: #fff;
            border-radius: 8px;
        }

        .no-results h3 {
            font-size: 24px;
            margin-bottom: 10px;
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
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .filter-grid {
                grid-template-columns: 1fr;
            }

            .car-grid {
                grid-template-columns: 1fr;
            }

            .nav-container {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Nirita Rental Mobil</h1>
        <p>Sewa mobil terbaik untuk perjalanan Anda</p>
    </header>

    <nav>
        <div class="nav-container">
            <a href="/">Home</a>
            <a href="/units" class="active">Units</a>
            <a href="/about">About Us</a>
            <a href="/review">Review</a>
            <a href="/faq">FAQ</a>
            <a href="/contact">Contact</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="page-title">Katalog Mobil</h1>
        <p class="page-subtitle">Temukan mobil yang sesuai dengan kebutuhan Anda</p>

        <!-- FILTER SECTION -->
        <div class="filter-section">
            <h3>Filter Unit</h3>
            <form id="filterForm">
                <div class="filter-grid">
                    <!-- Nama Mobil -->
                    <div class="filter-group">
                        <label for="namaMobil">Cari Nama Unit</label>
                        <input type="text" id="namaMobil" name="nama_mobil" placeholder="Contoh: Toyota Alphard">
                    </div>

                    <!-- Jenis Mobil / Kategori -->
                    <div class="filter-group">
                        <label for="kategori">Jenis Mobil</label>
                        <select id="kategori" name="kategori">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="MPV">MPV</option>
                            <option value="SUV">SUV</option>
                            <option value="Large SUV">Large SUV</option>
                            <option value="MPV Luxury">MPV Luxury</option>
                            <option value="MiniBus">MiniBus</option>
                            <option value="Luxury Minibus">Luxury Minibus</option>
                        </select>
                    </div>

                    <!-- Kapasitas -->
                    <div class="filter-group">
                        <label for="kapasitas">Kapasitas Penumpang</label>
                        <input type="number" id="kapasitas" name="kapasitas" placeholder="Contoh: 7" min="1">
                    </div>

                    <!-- Transmisi -->
                    <div class="filter-group">
                        <label for="transmisi">Transmisi</label>
                        <select id="transmisi" name="transmisi">
                            <option value="">Semua</option>
                            <option value="Manual">Manual</option>
                            <option value="Matic">Matic</option>
                        </select>
                    </div>
                </div>

                <!-- Harga Range -->
                <div class="filter-group" style="margin-top: 20px;">
                    <label>Harga Per Hari</label>
                    <div class="price-range">
                        <select id="hargaMin" name="harga_min">
                            <option value="">Min</option>
                            <option value="200000">Rp 200.000</option>
                            <option value="400000">Rp 400.000</option>
                            <option value="600000">Rp 600.000</option>
                            <option value="800000">Rp 800.000</option>
                            <option value="1000000">Rp 1.000.000</option>
                            <option value="1200000">Rp 1.200.000</option>
                            <option value="1400000">Rp 1.400.000</option>
                            <option value="1600000">Rp 1.600.000</option>
                            <option value="1800000">Rp 1.800.000</option>
                            <option value="2000000">Rp 2.000.000</option>
                        </select>
                        <span>—</span>
                        <select id="hargaMax" name="harga_max">
                            <option value="">Max</option>
                            <option value="400000">Rp 400.000</option>
                            <option value="600000">Rp 600.000</option>
                            <option value="800000">Rp 800.000</option>
                            <option value="1000000">Rp 1.000.000</option>
                            <option value="1200000">Rp 1.200.000</option>
                            <option value="1400000">Rp 1.400.000</option>
                            <option value="1600000">Rp 1.600.000</option>
                            <option value="1800000">Rp 1.800.000</option>
                            <option value="2000000">Rp 2.000.000</option>
                            <option value="3000000">Rp 3.000.000</option>
                        </select>
                    </div>
                </div>

                <!-- Checkbox: Tampilkan Unit Tersedia Saja -->
                <div class="filter-group" style="margin-top: 20px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" id="tersediaOnly" name="tersedia_only" style="width: auto;">
                        <span style="font-weight: normal;">Tampilkan Unit Tersedia Saja</span>
                    </label>
                </div>

                <div class="filter-actions">
                    <button type="button" class="btn btn-secondary" onclick="resetFilter()">Reset</button>
                    <button type="submit" class="btn btn-primary">Terapkan</button>
                </div>
            </form>
        </div>

        <!-- RESULTS -->
        <div class="results-header">
            <h3 class="results-count">Menampilkan <span id="resultCount">{{ $cars->count() }}</span> unit</h3>
        </div>

        <div class="car-grid" id="carGrid">
            @forelse($cars as $car)
            <div class="car-card" data-nama="{{ strtolower($car->nama_mobil) }}"
                data-kategori="{{ $car->specification->kategori ?? '' }}"
                data-kapasitas="{{ $car->specification->kapasitas ?? 0 }}"
                data-transmisi="{{ $car->specification->jenis_transmisi ?? '' }}"
                data-harga="{{ $car->rentalPrice->harga_solo ?? 0 }}" data-ketersediaan="{{ $car->ketersediaan }}">

                @if($car->url_foto_mobil)
                <img src="{{ asset($car->url_foto_mobil) }}" alt="{{ $car->nama_mobil }}"
                    class="car-image">
                @else
                <div class="car-image"
                    style="background: #ddd; display: flex; align-items: center; justify-content: center;">
                    <span style="color: #999;">No Image</span>
                </div>
                @endif

                <div class="car-info">
                    <h3 class="car-name">{{ $car->nama_mobil }}</h3>

                    <div class="car-price">
                        Rp {{ number_format($car->rentalPrice->harga_solo ?? 0, 0, ',', '.') }} / Hari
                    </div>

                    <div class="car-details">
                        <div class="car-detail-item">{{ $car->specification->kapasitas ?? '-' }} Kursi</div>
                        <div class="car-detail-item">{{ $car->specification->kategori ?? '-' }}</div>
                        <div class="car-detail-item">{{ $car->specification->jenis_transmisi ?? '-' }}</div>
                    </div>

                    <p class="car-plat">Plat Nomor: {{ $car->plat_nomor }}</p>

                    <span class="car-availability">Unit Tersedia: {{ $car->ketersediaan }}</span>

                    <a href="{{ route('car.detail', $car->id_mobil) }}" class="btn-detail">Lihat Detail</a>
                </div>
            </div>
            @empty
            <div class="no-results">
                <h3>Tidak ada mobil tersedia</h3>
                <p>Silakan coba filter lain atau hubungi kami untuk informasi lebih lanjut</p>
            </div>
            @endforelse
        </div>

        <div id="noResults" class="no-results" style="display: none;">
            <h3>Tidak ada hasil yang ditemukan</h3>
            <p>Coba ubah filter pencarian Anda</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Nirita Rental Mobil. All rights reserved.</p>
        <a href="{{ route('admin.') }}">Admin Panel</a>
    </footer>

    <script>
        const carCards = document.querySelectorAll('.car-card');
        const carGrid = document.getElementById('carGrid');
        const noResults = document.getElementById('noResults');
        const resultCount = document.getElementById('resultCount');

        document.getElementById('filterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            filterCars();
        });

        function filterCars() {
            const namaMobil = document.getElementById('namaMobil').value.toLowerCase();
            const kategori = document.getElementById('kategori').value;
            const kapasitas = parseInt(document.getElementById('kapasitas').value) || 0;
            const transmisi = document.getElementById('transmisi').value;
            const hargaMin = parseInt(document.getElementById('hargaMin').value) || 0;
            const hargaMax = parseInt(document.getElementById('hargaMax').value) || Infinity;
            const tersediaOnly = document.getElementById('tersediaOnly').checked;

            let visibleCount = 0;

            carCards.forEach(card => {
                const cardNama = card.dataset.nama;
                const cardKategori = card.dataset.kategori;
                const cardKapasitas = parseInt(card.dataset.kapasitas);
                const cardTransmisi = card.dataset.transmisi;
                const cardHarga = parseInt(card.dataset.harga);
                const cardKetersediaan = parseInt(card.dataset.ketersediaan);

                let show = true;

                // Filter nama
                if (namaMobil && !cardNama.includes(namaMobil)) {
                    show = false;
                }

                // Filter kategori
                if (kategori && cardKategori !== kategori) {
                    show = false;
                }

                // Filter kapasitas
                if (kapasitas > 0 && cardKapasitas !== kapasitas) {
                    show = false;
                }

                // Filter transmisi
                if (transmisi && cardTransmisi !== transmisi) {
                    show = false;
                }

                // Filter harga
                if (cardHarga < hargaMin || cardHarga > hargaMax) {
                    show = false;
                }

                // Filter ketersediaan
                if (tersediaOnly && cardKetersediaan === 0) {
                    show = false;
                }

                if (show) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Update result count
            resultCount.textContent = visibleCount;

            // Show/hide no results message
            if (visibleCount === 0) {
                carGrid.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                carGrid.style.display = 'grid';
                noResults.style.display = 'none';
            }
        }

        function resetFilter() {
            document.getElementById('filterForm').reset();
            carCards.forEach(card => {
                card.style.display = 'block';
            });
            carGrid.style.display = 'grid';
            noResults.style.display = 'none';
            resultCount.textContent = carCards.length;
        }
    </script>
</body>

</html>