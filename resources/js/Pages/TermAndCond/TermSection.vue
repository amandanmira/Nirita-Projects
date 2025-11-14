<script setup>
import MainLayout from "../Layouts/MainLayouts.vue";
</script>

<template>
    <MainLayout>
        <section class="py-16 px-4 bg-gray-50 text-gray-800">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-3 text-gray-900">
                    Syarat & Ketentuan
                </h2>
                <p class="text-gray-600 leading-relaxed">
                    Selamat datang di layanan rental mobil kami. Sebelum
                    melakukan pemesanan, harap membaca dan memahami syarat serta
                    ketentuan berikut ini. Dengan melakukan pemesanan, Anda
                    dianggap telah menyetujui seluruh ketentuan yang berlaku.
                </p>
            </div>

            <div
                class="space-y-8 max-w-4xl mx-auto bg-gradient-to-t from-[#101B4E] to-[#173A84] p-12 rounded-2xl"
            >
                <!-- 1. Persyaratan Penyewa -->
                <div class="efek-hover bg-white rounded-xl p-6">
                    <h3 class="text-lg md:text-xl font-bold mb-3">
                        1. Persyaratan Penyewa
                    </h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>
                            Penyewa wajib memiliki KTP asli dan berusia minimal
                            18 tahun.
                        </li>
                        <li>
                            KTP akan digunakan sebagai identitas utama dalam
                            proses verifikasi dan administrasi penyewaan.
                        </li>
                    </ul>
                </div>

                <!-- 2. Ketentuan Pemesanan -->
                <div class="efek-hover bg-white rounded-xl p-6">
                    <h3 class="text-lg md:text-xl font-bold mb-3">
                        2. Ketentuan Pemesanan
                    </h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>
                            Untuk periode weekend, libur Natal dan Tahun Baru
                            (Nataru), Idul Fitri, serta hari-hari besar lainnya
                            atau musim liburan (peak season), penyewa dihimbau
                            untuk tidak melakukan pemesanan mendadak mulai dari
                            H-7 sampai hari H. Hal ini bertujuan agar
                            ketersediaan unit dapat dikelola dengan baik dan
                            pelayanan tetap optimal.
                        </li>
                        <li>
                            Pemesanan di waktu tersebut hanya dapat dilakukan
                            dalam kondisi darurat, seperti:
                            <ul
                                class="list-[lower-alpha] list-inside ml-4 space-y-1"
                            >
                                <li>
                                    Repeat order atau penambahan unit bagi
                                    pelanggan yang telah melakukan pemesanan
                                    sebelumnya.
                                </li>
                                <li>
                                    Kebutuhan mendesak seperti takziah atau
                                    keadaan darurat lainnya yang dapat
                                    dipertanggungjawabkan.
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- 3. Pembayaran dan Kebijakan DP -->
                <div class="efek-hover bg-white rounded-xl p-6">
                    <h3 class="text-lg md:text-xl font-bold mb-3">
                        3. Pembayaran dan Kebijakan DP
                    </h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>
                            Pada periode peak season, pelanggan disarankan untuk
                            melakukan pembayaran uang muka (DP) sebesar ±10%
                            dari total harga sewa.
                        </li>
                        <li>
                            DP yang sudah dibayarkan tidak dapat dikembalikan
                            (non-refundable) apabila terjadi pembatalan dari
                            pihak penyewa.
                        </li>
                        <li>
                            Setelah DP diterima, pelunasan wajib dilakukan pada
                            hari keberangkatan (hari H) sebelum kendaraan
                            digunakan.
                        </li>
                    </ul>
                </div>

                <!-- 4. Metode Pembayaran -->
                <div class="efek-hover bg-white rounded-xl p-6">
                    <h3 class="text-lg md:text-xl font-bold mb-3">
                        4. Metode Pembayaran
                    </h3>
                    <p class="text-gray-700 mb-2">
                        Penyewa dapat melakukan pelunasan dengan dua metode
                        berikut:
                    </p>
                    <ul
                        class="list-[lower-alpha] list-inside text-gray-700 space-y-1 ml-4"
                    >
                        <li>
                            Tunai (Cash): Pembayaran diserahkan langsung kepada
                            driver yang bertugas sebelum keberangkatan.
                        </li>
                        <li>
                            Non-tunai (Cashless): Pembayaran dilakukan melalui
                            transfer ke rekening admin resmi sesuai instruksi
                            yang diberikan saat konfirmasi pemesanan.
                        </li>
                    </ul>
                </div>

                <!-- 5. Ketentuan Tambahan -->
                <div class="efek-hover bg-white rounded-xl p-6">
                    <h3 class="text-lg md:text-xl font-bold mb-3">
                        5. Ketentuan Tambahan
                    </h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>
                            Penyewa wajib menjaga kebersihan dan kondisi
                            kendaraan selama masa sewa.
                        </li>
                        <li>
                            Penyewa bertanggung jawab atas segala kerusakan atau
                            kehilangan yang disebabkan oleh kelalaian
                            penggunaan.
                        </li>
                        <li>
                            Pihak rental berhak menolak atau membatalkan
                            pemesanan apabila penyewa tidak memenuhi ketentuan
                            yang berlaku.
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style scoped>
.efek-hover:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
}
</style>
