<template>
    <section class="bg-white py-16 px-6 md:px-12 lg:px-20">
        <div class="w-full max-w-7xl mx-auto text-center">
            <!-- Judul -->
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-12">
                Mengapa Memilih Nirita Transport?
            </h2>

            <!-- Grid Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 1 -->
                <div
                    class="bg-[#0E1A47] text-white rounded-xl shadow-md p-8 text-left"
                >
                    <p class="leading-relaxed text-xl">
                        Kami menyediakan beragam unit, mulai dari mobil
                        komersial (seperti Toyota Innova Reborn, Avanza New),
                        mobil mewah (seperti Toyota Fortuner, Toyota Alphard),
                        hingga Bus Pariwisata (Medium Bus dan Big Bus).
                    </p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-[#0E1A47] text-white rounded-xl shadow-md p-8 text-left"
                >
                    <p class="leading-relaxed text-xl">
                        Kondisi kendaraan kami selalu prima, terawat, dan
                        dilengkapi dengan fasilitas kenyamanan seperti AC dan
                        Audio. Unit besar bahkan dilengkapi TV & DVD Karaoke.
                    </p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-[#0E1A47] text-white rounded-xl shadow-md p-8 text-left"
                >
                    <p class="leading-relaxed text-xl">
                        Setiap layanan sewa mobil sudah termasuk driver
                        profesional untuk memastikan perjalanan Anda lancar dan
                        menyenangkan.
                    </p>
                </div>

                <!-- Card 4 -->
                <div
                    class="bg-[#0E1A47] text-white rounded-xl shadow-md p-8 text-left"
                >
                    <p class="leading-relaxed text-xl">
                        Selain sewa mobil, kami juga melayani jasa biro
                        perjalanan pariwisata, menjadikan kami one-stop solution
                        untuk semua rencana perjalanan Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// Tidak perlu logic khusus
</script>

<style scoped>
/* Tambahan opsional untuk efek hover */
div.bg-\[\#0E1A47\]:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
}
</style>
