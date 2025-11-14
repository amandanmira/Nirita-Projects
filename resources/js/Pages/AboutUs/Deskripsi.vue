<template>
    <section class="bg-gray-50 py-8 md:py-20 px-6 md:px-16 lg:px-20">
        <div class="w-full max-w-7xl mx-auto">
            <!-- Judul -->
            <h2
                class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-center text-gray-900 mb-10"
            >
                Tentang Nirita Transport
            </h2>

            <!-- Konten Utama -->
            <div
                class="bg-[#0b1a46] text-white rounded-2xl shadow-lg flex flex-col md:flex-row items-center gap-8 p-6 md:p-10"
            >
                <!-- Kolom Kiri (Teks) -->
                <div class="flex-1 space-y-4 leading-relaxed">
                    <p class="text-xl">
                        Nirita Transport adalah perusahaan penyedia layanan
                        transportasi dan biro perjalanan pariwisata terkemuka di
                        Surakarta, Jawa Tengah. Didirikan sejak tahun 2009, kami
                        berdedikasi untuk memberikan solusi mobilitas yang aman,
                        nyaman, dan profesional.
                    </p>
                    <p class="text-xl">
                        Kami melayani berbagai kebutuhan pelanggan, mulai dari
                        perjalanan perorangan, keluarga, hingga operasional
                        perusahaan.
                    </p>
                </div>

                <!-- Kolom Kanan (Gambar) -->
                <div
                    class="flex-1 grid grid-cols-2 gap-4 justify-center items-center w-full md:w-auto"
                >
                    <img
                        :src="FotoKiri"
                        alt="Bus Nirita"
                        class="rounded-xl object-cover w-full h-40 md:h-56 lg:h-72 shadow-md"
                    />
                    <img
                        :src="FotoKanan"
                        alt="Mobil Nirita"
                        class="rounded-xl object-cover w-full h-40 md:h-56 lg:h-72 shadow-md"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import FotoKiri from "../Assets/section-kiri.jpg";
import FotoKanan from "../Assets/section-kanan.jpg";
</script>

<style scoped>
/* Tambahan opsional jika ingin efek bayangan lembut */
</style>
