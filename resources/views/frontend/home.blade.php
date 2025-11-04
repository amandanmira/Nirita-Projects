<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nirita Rental Mobil</title>
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

        .cars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }

        .car-card {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
        }

        .car-card h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .car-card p {
            color: #666;
            margin: 5px 0;
        }

        .testimonials {
            background: #f4f4f4;
            padding: 40px 0;
            margin: 40px 0;
        }

        .testimonial {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }

        .faq {
            margin: 40px 0;
        }

        .faq-item {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }

        .btn:hover {
            background: #0066cc;
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-wrap: wrap;
            }

            .nav-container a {
                flex: 1 1 auto;
                text-align: center;
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
            <a href="/" class="active">Home</a>
            <a href="/units">Units</a>
            <a href="/about">About Us</a>
            <a href="/review">Review</a>
            <a href="/faq">FAQ</a>
            <a href="/contact">Contact</a>
        </div>
    </nav>

    <div class="container">
        <h2>Mobil Tersedia</h2>
        <div class="cars-grid">
            @forelse($cars as $car)
                <div class="car-card">
                    @if($car->url_foto_mobil)
                        <img src="{{ asset('storage/' . $car->url_foto_mobil) }}" alt="{{ $car->nama_mobil }}"
                            style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
                    @endif
                    <h3>{{ $car->nama_mobil }}</h3>
                    @if($car->rentalPrice)
                        <p><strong>Harga Solo:</strong> Rp
                            {{ number_format($car->rentalPrice->harga_solo ?? 0, 0, ',', '.') }}/hari
                        </p>
                    @endif
                    <p><strong>Plat Nomor:</strong> {{ $car->plat_nomor }}</p>
                    <p><strong>Unit Tersedia:</strong> {{ $car->ketersediaan }}</p>
                    <p>{{ Str::limit($car->deskripsi ?? 'Deskripsi tidak tersedia', 100) }}</p>
                    <a href="{{ route('car.detail', $car->id_mobil) }}" class="btn">Lihat Detail</a>
                </div>
            @empty
                <p>Belum ada mobil tersedia. Silakan tambahkan di dashboard admin.</p>
            @endforelse
        </div>
    </div>

    <div class="testimonials">
        <div class="container">
            <h2>Testimoni Pelanggan</h2>
            @forelse($testimonials as $testimonial)
                <div class="testimonial">
                    @if($testimonial->url_gambar)
                        <img src="{{ asset('storage/' . $testimonial->url_gambar) }}" alt="Testimoni"
                            style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 10px;">
                    @endif
                    <p style="font-style: italic;">"{{ $testimonial->desk_testimoni }}"</p>
                </div>
            @empty
                <p>Belum ada testimoni.</p>
            @endforelse
        </div>
    </div>

    <div class="container faq">
        <h2>FAQ (Frequently Asked Questions)</h2>
        <p>Belum ada FAQ.</p>
    </div>

    <footer style="background: #333; color: #fff; text-align: center; padding: 20px; margin-top: 40px;">
        <p>&copy; 2025 Nirita Rental Mobil. All rights reserved.</p>
        <a href="{{ route('admin.') }}" style="color: #fff;">Admin Panel</a>
    </footer>
</body>

</html>