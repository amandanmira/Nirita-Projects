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
                    href="#"
                    class="hover:text-blue-600 text-sm underline decoration-dotted py-2"
                    >LIHAT SEMUA</a
                >
            </div>

            <!-- Grid -->
            <div class="grid gap-8 md:grid-cols-3 sm:grid-cols-2 grid-cols-1">
                <div
                    v-for="car in cars"
                    :key="car.id"
                    class="bg-white shadow-sm border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition"
                >
                    <!-- Gambar -->
                    <div
                        class="w-full h-52 px-4 bg-gray-100 flex items-center justify-center overflow-hidden"
                    >
                        <img
                            :src="car.image"
                            :alt="car.name"
                            class="object-cover w-full h-full"
                        />
                    </div>

                    <!-- Isi -->
                    <div class="p-5 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ car.name }}
                            </h3>
                            <p class="text-gray-600 text-sm mt-1">
                                {{ car.spec }}
                            </p>
                            <p class="text-blue-600 font-semibold mt-2">
                                {{ car.price }}
                            </p>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="tombol-aksi mt-2">
                            <!-- Tombol Hitam -->
                            <button
                                class="cursor-pointer flex items-center justify-center gap-2 bg-black text-white text-md rounded-l-md px-5 py-3 w-full border border-transparent hover:bg-white hover:text-black hover:border-black hover:border transition"
                            >
                                <i class="fa-solid fa-arrow-right"></i>
                                Lihat Detail
                            </button>

                            <!-- Tombol Biru -->
                            <button
                                class="cursor-pointer flex items-center justify-center bg-blue-600 text-white rounded-r-md px-3 py-2 border border-transparent hover:bg-white hover:text-black hover:border-black hover:border"
                            >
                                <i class="fa-solid fa-phone"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// Import data dummy dari file terpisah
import cars from "@/data/cars.js"; // alias @ mengarah ke resources/js/
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
