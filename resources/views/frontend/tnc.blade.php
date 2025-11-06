<style>
    /* Seluruh CSS kustom Anda tetap dipertahankan
          untuk menjaga tampilan.
        */
    .tnc-container {
        max-width: 900px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .tnc-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .tnc-header h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #1a3a52;
    }

    .tnc-header p {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
    }

    .tnc-item {
        background: white;
        border-left: 4px solid #0066cc;
        padding: 25px;
        margin-bottom: 20px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .tnc-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .tnc-item h3 {
        color: #1a3a52;
        font-weight: 600;
        margin-bottom: 12px;
        font-size: 18px;
    }


    .tnc-item div>* {
        color: #555;
        line-height: 1.7;
        font-size: 15px;
        margin: 0;
    }

    .tnc-item div p {
        margin-bottom: 1rem;
    }

    /* Kita ganti tnc-loading dengan tnc-error dari style Anda */
    .tnc-error {
        background: #fff3cd;
        border: 1px solid #ffc107;
        color: #856404;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
        text-align: center;
    }
</style>

<div class="tnc-container">
    <div class="tnc-header">
        <h1>Syarat & Ketentuan</h1>
        <p>Seluruh daftar syarat dan ketentuan rental mobil kami. Sebelum melakukan penyewaan, harap membaca dan
            memahami syarat ketentuan berikut ini.</p>
    </div>

    <!--
          BAGIAN INI DIUBAH TOTAL
          Kita tidak lagi menggunakan <div id="tncContent"> atau <script>
          Kita langsung menggunakan data $tncs dari controller.
        -->
    @if($tncs->isEmpty())
        <div class="tnc-error">
            Belum ada data Syarat & Ketentuan yang ditambahkan.
        </div>
    @else
        @foreach($tncs as $index => $tnc)
            <div class="tnc-item">
                <!-- Kita gunakan $index + 1 untuk penomoran -->
                <h3>{{ $index + 1 }}. {{ $tnc->judul }}</h3>


                <div>
                    {!! $tnc->deskripsi !!}
                </div>
            </div>
        @endforeach
    @endif
    <!-- AKHIR DARI BAGIAN YANG DIUBAH -->

</div>