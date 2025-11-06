@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Mobil</h2>

        <form action="{{ route('admin.mobil.update', $mobil) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <br>
            <h3>Gambar Sebelumnya:</h3>

            @foreach (json_decode($mobil->url_foto_mobil) as $gambar)
                <img src="{{ asset('storage/' . $gambar) }}" width="300">
            @endforeach
            <br><br>
            <div class="mb-3">
                <label for="url_foto_mobil" class="form-label">Gambar</label>
                <br>
                <button type="button" id="add-gambar-row" class="btn btn-secondary mb-3">Tambah Gambar</button>

                <div id="gambar-wrapper">
                    <div class="input-group mb-2 gambar-item">
                        <input type="file" name="url_foto_mobil[]" id="url_foto_mobil" class="form-control">
                        <button type="button" class="btn btn-danger remove-gambar-row">Hapus</button>
                    </div>
                </div>
                @error('url_foto_mobil') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="nama_mobil" class="form-label">Nama Mobil</label>
                <input type="text" name="nama_mobil" id="nama_mobil" class="form-control" value="{{ $mobil->nama_mobil }}"
                    required>
                @error('nama_mobil') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="plat_nomor" class="form-label">Plat Nomor</label>
                    <input type="text" name="plat_nomor" id="plat_nomor" class="form-control"
                        value="{{ $mobil->plat_nomor }}" required>
                    @error('plat_nomor') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col">
                    <label for="ketersediaan" class="form-label">Jumlah Ketersediaan</label>
                    <input type="number" name="ketersediaan" id="ketersediaan" class="form-control"
                        value="{{ $mobil->ketersediaan }}" required>
                    @error('ketersediaan') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <h3>Spesifikasi Mobil</h3>

            <div class="row mb-3">
                <div class="col">
                    <label for="kapasitas" class="form-label">Kapasitas Penumpang</label>
                    <input type="number" name="kapasitas" id="kapasitas" class="form-control"
                        value="{{ $mobil->specification->kapasitas }}" required>
                    @error('kapasitas') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                @php
                    $kategori = ['MPV', 'SUV', 'Large SUV', 'MPV Luxury', 'MiniBus', 'Luxury Minibus'];
                @endphp

                <div class="col">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select" required>
                        @foreach ($kategori as $k)
                            <option value="{{ $k }}" {{ $mobil->specification->kategori == $k ? 'selected' : '' }}>{{ $k }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col">
                    <label for="jenis_transmisi" class="form-label">Jenis Transmisi</label>
                    <input type="text" name="jenis_transmisi" id="jenis_transmisi" class="form-control"
                        value="{{ $mobil->specification->jenis_transmisi }}" required>
                    @error('jenis_transmisi') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <h3>Fasilitas</h3>

            @php
                $fasilitas = json_decode($mobil->specification->fasilitas, false);
            @endphp

            <div class="mb-3">
                <button type="button" id="add-row" class="btn btn-secondary mb-3">Tambah Fasilitas</button>

                <div id="fasilitas-wrapper">
                    @foreach ($fasilitas as $f)
                        <div class="input-group mb-2 fasilitas-item">
                            <input type="text" name="fasilitas[]" id="fasilitas[]" class="form-control"
                                placeholder="Masukkan fasilitas" value="{{ $f }}">
                            <button type="button" class="btn btn-danger remove-row">Hapus</button>
                        </div>
                    @endforeach
                </div>

                @error('fasilitas[]') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <script>
                document.getElementById('add-row').addEventListener('click', function () {
                    const wrapper = document.getElementById('fasilitas-wrapper');
                    const newRow = document.createElement('div');
                    newRow.classList.add('input-group', 'mb-2', 'fasilitas-item');
                    newRow.innerHTML = `
                                    <input type="text" name="fasilitas[]" class="form-control" placeholder="Masukkan fasilitas">
                                    <button type="button" class="btn btn-danger remove-row">Hapus</button>
                                `;
                    wrapper.appendChild(newRow);
                });

                document.getElementById('add-gambar-row').addEventListener('click', function () {
                    const wrapper = document.getElementById('gambar-wrapper');
                    const newRow = document.createElement('div');
                    newRow.classList.add('input-group', 'mb-2', 'gambar-item');
                    newRow.innerHTML = `
                                            <input type="file" name="url_foto_mobil[]" id="url_foto_mobil" class="form-control">
                                            <button type="button" class="btn btn-danger remove-gambar-row">Hapus</button>
                                        `;
                    wrapper.appendChild(newRow);
                });

                // Event hapus baris
                document.addEventListener('click', function (e) {
                    if (e.target.classList.contains('remove-row')) {
                        e.target.closest('.fasilitas-item').remove();
                    } else if (e.target.classList.contains('remove-gambar-row')) {
                        e.target.closest('.gambar-item').remove();
                    }
                });
            </script>

            <h3>Harga Sewa</h3>

            <div class="row mb-3">
                <div class="col">
                    <label for="harga_solo" class="form-label">Harga Solo</label>
                    <input type="number" name="harga_solo" id="harga_solo" class="form-control"
                        value="{{ $mobil->rentalPrice->harga_solo }}" required>
                    @error('harga_solo') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col">
                    <label for="harga_solo_raya" class="form-label">Harga Solo Raya</label>
                    <input type="number" name="harga_solo_raya" id="harga_solo_raya" class="form-control"
                        value="{{ $mobil->rentalPrice->harga_solo_raya }}" required>
                    @error('harga_solo_raya') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col">
                    <label for="harga_luar_kota" class="form-label">Harga Luar Kota</label>
                    <input type="number" name="harga_luar_kota" id="harga_luar_kota" class="form-control"
                        value="{{ $mobil->rentalPrice->harga_luar_kota }}" required>
                    @error('harga_luar_kota') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success">Perbarui</button>
            <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection