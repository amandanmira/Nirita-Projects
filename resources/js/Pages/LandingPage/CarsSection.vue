<template>
    <section class="bg-white py-16 px-6 md:px-20">
        <div class="max-w-7xl mx-auto">
            <!-- Judul -->
            <div class="text-center mb-10">
                <h2
                    class="text-2xl md:text-3xl font-semibold text-gray-900 mb-2"
                >
                    Pilihan Armada Kami
                </h2>
                <a
                    href="/units"
                    class="hover:text-blue-600 text-sm underline decoration-dotted py-2"
                >
                    LIHAT SEMUA
                </a>
            </div>

            <!-- Grid -->
            <div class="grid gap-8 md:grid-cols-3 sm:grid-cols-2 grid-cols-1">
                <div
                    v-for="car in props.cars"
                    :key="car.id_mobil"
                    class="bg-white shadow-sm border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition"
                >
                    <!-- Gambar -->
                    <div
                        class="w-full h-52 px-4 bg-gray-100 flex items-center justify-center overflow-hidden"
                    >
                        <img
                            :src="getFirstPhoto(car.url_foto_mobil)"
                            :alt="car.nama_mobil"
                            class="object-cover w-full h-full rounded-md hover:scale-105 transition"
                        />
                    </div>

                    <!-- Isi -->
                    <div class="p-5 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ car.nama_mobil }}
                            </h3>

                            <!-- Specification singkat -->
                            <p class="text-gray-600 text-sm mt-1">
                                {{ car.specification?.jenis_transmisi }} ·
                                {{ car.specification?.kategori }} ·
                                {{ car.specification?.kapasitas }} Kursi
                            </p>

                            <!-- Harga -->
                            <p class="text-blue-600 font-semibold mt-2">
                                {{ formatRupiah(car.rental_price?.harga_solo) }}
                                / Hari
                            </p>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="tombol-aksi mt-2">
                            <a
                                :href="`/units/${car.id_mobil}`"
                                class="cursor-pointer flex items-center justify-center gap-2 bg-black text-white text-md rounded-l-md px-5 py-3 w-full border border-transparent hover:bg-white hover:text-black hover:border-black transition"
                            >
                                <i class="fa-solid fa-arrow-right"></i>
                                Lihat Detail
                            </a>

                            <a
                                :href="`https://wa.me/6281393604105?text=Halo,%20saya%20ingin%20menyewa%20${car.nama_mobil}`"
                                target="_blank"
                                class="cursor-pointer flex items-center justify-center bg-blue-600 text-white rounded-r-md px-3 py-2 border border-transparent hover:bg-white hover:text-black hover:border-black transition"
                            >
                                <i class="fa-solid fa-phone"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const props = defineProps({
    cars: {
        type: Array,
        default: () => [],
    },
});

// Format angka ke Rupiah (IDR) tanpa desimal
const formatRupiah = (value) => {
    if (value === null || value === undefined || value === "") return "-";
    const n = Number(value);
    if (Number.isNaN(n)) return "-";
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0,
    }).format(n);
};

// fungsi mengambil gambar pertama (sama seperti di admin)
const getFirstPhoto = (fotoData) => {
    try {
        const parsed = JSON.parse(fotoData);
        if (Array.isArray(parsed) && parsed.length > 0) {
            return parsed[0].startsWith("/storage/")
                ? parsed[0]
                : `/storage/${parsed[0]}`;
        }
    } catch (e) {
        if (typeof fotoData === "string") {
            return fotoData.startsWith("/storage/")
                ? fotoData
                : `/storage/${fotoData}`;
        }
    }

    return "/placeholder_image/placeholder_mobil.png";
};
</script>

<style scoped>
section {
    font-family: "Poppins", sans-serif;
}
.tombol-aksi {
    display: grid;
    grid-template-columns: auto 50px;
}
</style>
