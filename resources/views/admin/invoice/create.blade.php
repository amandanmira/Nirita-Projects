@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Invoice Baru</h2>

        <form action="{{ route('admin.invoice.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <button type="button" id="add-row" class="btn btn-secondary mb-3">Tambah Mobil</button>

                <div id="detail-wrapper">
                    <div class="input-group mb-2 detail-item">
                        <div>
                            <label for="id_mobil" class="form-label">Mobil Yang Disewa</label>
                            <select name="detail[0][id_mobil]" id="id_mobil" class="form-select select-mobil" required>
                                <option value="">-- Pilih Mobil --</option>
                                @foreach ($cars as $c)
                                    <option value="{{ $c->id_mobil }}" data-harga-solo="{{ $c->rentalPrice->harga_solo }}"
                                        data-harga-solo_raya="{{ $c->rentalPrice->harga_solo_raya }}"
                                        data-harga-luar_kota="{{ $c->rentalPrice->harga_luar_kota }}">{{ $c->nama_mobil }}
                                        ({{ $c->plat_nomor }})</option>
                                @endforeach
                            </select>
                            @error('id_mobil') <small class="text-danger">{{ $message }}</small> @enderror

                            <label for="lokasi_sewa" class="form-label">Lokasi Sewa</label>
                            <select name="detail[0][lokasi_sewa]" id="lokasi_sewa" class="form-select select-lokasi"
                                required>
                                <option value="">-- Pilih Lokasi --</option>
                                <option value="solo" class="harga_solo">Solo</option>
                                <option value="solo_raya" class="harga_solo_raya">Solo Raya</option>
                                <option value="luar_kota" class="harga_luar_kota">Luar Kota</option>
                            </select>
                            @error('lokasi_sewa') <small class="text-danger">{{ $message }}</small> @enderror

                            <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                            <input type="date" name="detail[0][tanggal_sewa]" id="tanggal_sewa" class="form-control"
                                required>
                            @error('tanggal_sewa') <small class="text-danger">{{ $message }}</small> @enderror

                            <label for="deskripsi_kegiatan" class="form-label">Deskripsi Kegiatan</label>
                            <textarea name="detail[0][deskripsi_kegiatan]" id="deskripsi_kegiatan" rows="4"
                                class="form-control"></textarea>
                            @error('deskripsi_kegiatan') <small class="text-danger">{{ $message }}</small> @enderror

                            <div class="harga-terpilih"></div>
                        </div>


                        <button type="button" class="btn btn-danger remove-row">Hapus</button>
                    </div>
                </div>

                <input type="hidden" name="total_pembayaran" id="total-pembayaran" required>
                <div id="total-harga">Total Pembayaran : -</div>
            </div>

            <script>
                let index = 1;

                document.addEventListener('DOMContentLoaded', function () {
                    const wrapper = document.getElementById('detail-wrapper');
                    const totalHargaEl = document.getElementById('total-harga');
                    const inputTotal = document.getElementById('total-pembayaran');

                    const formatRupiah = (angka) => angka ? `Rp ${parseInt(angka).toLocaleString('id-ID')}` : '-';

                    function hitungTotal() {
                        let total = 0;
                        wrapper.querySelectorAll('.detail-item').forEach(row => {
                            const hargaText = row.dataset.hargaTerpilih;
                            if (hargaText && !isNaN(hargaText)) total += parseInt(hargaText);
                        });

                        totalHargaEl.textContent = `Total Pembayaran : ${formatRupiah(total)}`;
                        inputTotal.value = total;
                    }

                    function updateHarga(row) {
                        const mobilSelect = row.querySelector('.select-mobil');
                        const hargaSolo = row.querySelector('.harga_solo');
                        const hargaSoloRaya = row.querySelector('.harga_solo_raya');
                        const hargaLuarKota = row.querySelector('.harga_luar_kota');
                        const mobil = mobilSelect.options[mobilSelect.selectedIndex];

                        if (mobil.value === "") {
                            row.dataset.hargaTerpilih = 0;
                            row.querySelector('.harga-terpilih').textContent = '';
                            hitungTotal();


                            hargaSolo.textContent = 'Solo';
                            hargaSoloRaya.textContent = 'Solo Raya';
                            hargaLuarKota.textContent = 'Luar Kota';

                            return;
                        }

                        // Ambil data harga dari atribut data-*
                        const solo = mobil.dataset.hargaSolo;
                        const soloRaya = mobil.dataset.hargaSolo_raya;
                        const luarKota = mobil.dataset.hargaLuar_kota;

                        // Tampilkan di daftar harga
                        hargaSolo.textContent = `Solo : ${formatRupiah(solo)}`;
                        hargaSoloRaya.textContent = `Solo Raya : ${formatRupiah(soloRaya)}`;
                        hargaLuarKota.textContent = `Luar Kota : ${formatRupiah(luarKota)}`;
                    }

                    function updateHargaTerpilih(row) {
                        const mobilSelect = row.querySelector('.select-mobil');
                        const lokasiSelect = row.querySelector('.select-lokasi');
                        const mobil = mobilSelect.options[mobilSelect.selectedIndex];
                        const lokasi = lokasiSelect.value;

                        if (!mobil.value || !lokasi) {
                            row.dataset.hargaTerpilih = 0;
                            hitungTotal();
                            return;
                        }

                        const harga = mobil.dataset[`harga${lokasi.charAt(0).toUpperCase() + lokasi.slice(1)}`]; console.log(mobil.dataset);
                        row.dataset.hargaTerpilih = harga || 0;
                        hitungTotal();
                    }

                    wrapper.addEventListener('change', function (e) {
                        const row = e.target.closest('.detail-item');

                        if (e.target.classList.contains('select-mobil')) {
                            updateHarga(row);
                            updateHargaTerpilih(row)
                        }
                        if (e.target.classList.contains('select-lokasi')) {
                            updateHargaTerpilih(row);
                        }
                    });

                    // Event hapus baris
                    document.addEventListener('click', function (e) {
                        if (e.target.classList.contains('remove-row')) {
                            e.target.closest('.detail-item').remove();
                            hitungTotal();
                        }
                    });
                });

                document.getElementById('add-row').addEventListener('click', function () {
                    const wrapper = document.getElementById('detail-wrapper');
                    const newRow = document.createElement('div');
                    newRow.classList.add('input-group', 'mb-2', 'detail-item');
                    newRow.innerHTML = `
                        <div>
                            <label for="id_mobil" class="form-label">Mobil Yang Disewa</label>
                            <select name="detail[` + index + `][id_mobil]" id="id_mobil" class="form-select select-mobil" required>
                                <option value="">-- Pilih Mobil --</option>
                                @foreach ($cars as $c)
                                    <option value="{{ $c->id_mobil }}" data-harga-solo="{{ $c->rentalPrice->harga_solo }}"
                                    data-harga-solo_raya="{{ $c->rentalPrice->harga_solo_raya }}"
                                    data-harga-luar_kota="{{ $c->rentalPrice->harga_luar_kota }}">{{ $c->nama_mobil }} ({{ $c->plat_nomor }})</option>
                                @endforeach
                            </select>
                            @error('id_mobil') <small class="text-danger">{{ $message }}</small> @enderror

                            <label for="lokasi_sewa" class="form-label">Lokasi Sewa</label>
                            <select name="detail[` + index + `][lokasi_sewa]" id="lokasi_sewa" class="form-select select-lokasi" required>
                                <option value="">-- Pilih Lokasi --</option>
                                <option value="solo" class="harga_solo">Solo</option>
                                <option value="solo_raya" class="harga_solo_raya">Solo Raya</option>
                                <option value="luar_kota" class="harga_luar_kota">Luar Kota</option>
                            </select>
                            @error('lokasi_sewa') <small class="text-danger">{{ $message }}</small> @enderror

                            <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                            <input type="date" name="detail[` + index + `][tanggal_sewa]" id="tanggal_sewa" class="form-control" required>
                            @error('tanggal_sewa') <small class="text-danger">{{ $message }}</small> @enderror

                            <label for="deskripsi_kegiatan" class="form-label">Deskripsi Kegiatan</label>
                            <textarea name="detail[` + index++ + `][deskripsi_kegiatan]" id="deskripsi_kegiatan" rows="4"
                                class="form-control"></textarea>
                            @error('deskripsi_kegiatan') <small class="text-danger">{{ $message }}</small> @enderror

                            <div class="harga-terpilih"></div>
                        </div>



                        <button type="button" class="btn btn-danger remove-row">Hapus</button>
                    `;
                    wrapper.appendChild(newRow);
                });
            </script>

            <div class="mb-3">
                <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
                <input type="text" name="nama_penyewa" id="nama_penyewa" class="form-control" required>
                @error('nama_penyewa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="no_hp_penyewa" class="form-label">No Telepon Penyewa</label>
                <input type="tel" name="no_hp_penyewa" id="no_hp_penyewa" class="form-control" required>
                @error('no_hp_penyewa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="driver" class="form-label">Nama Driver</label>
                <input type="text" name="driver" id="driver" class="form-control" required>
                @error('driver') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.invoice.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection