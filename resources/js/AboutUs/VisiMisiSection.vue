<template>
    <section class="bg-white py-14 px-6 md:px-12 lg:px-20">
        <div class="max-w-6xl mx-auto text-center">
            <!-- Judul -->
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4">
                Menjadi Pilihan Utama untuk Mobilitas Anda
            </h2>
            <p class="text-gray-700 mb-10">
                Di
                <span class="font-semibold text-gray-900">Nirita Transport</span
                >, kami berkomitmen untuk memberikan layanan transportasi yang
                unggul dan terpercaya, didukung oleh visi dan misi kami:
            </p>

            <!-- Grid Visi Misi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Kartu Visi -->
                <div
                    class="bg-white rounded-xl shadow-md p-8 text-left efek-hover"
                >
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Visi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Menjadi perusahaan jasa pelayanan sewa mobil dan biro
                        perjalanan pariwisata yang terdepan dan terpercaya dalam
                        memberikan solusi mobilitas yang nyaman dan aman
                        sehingga dapat memberikan pengalaman yang baik bagi
                        pelanggan.
                    </p>
                </div>

                <!-- Kartu Misi -->
                <div
                    class="bg-white rounded-xl shadow-md p-8 text-left efek-hover"
                >
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Misi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Menyediakan berbagai macam pilihan unit yang lengkap dan
                        berkualitas dan pelayanan yang profesional dan ramah
                        pada pelanggan dengan harga yang terjangkau dan
                        kompetitif untuk mewujudkan transportasi yang aman dan
                        nyaman bagi masyarakat.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// Tidak ada logic khusus
</script>

<style scoped>
section {
    font-family: Poppins, sans-serif;
}
.efek-hover:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
}
</style>
