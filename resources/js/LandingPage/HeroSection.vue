<script setup>
import alphardImage from "@/Assets/hero-mobil.png";
</script>

<template>
    <section
        class="bg-gradient-to-t from-[#101B4E] to-blue-700 text-white py-16 px-8 md:px-20 flex flex-col md:flex-row items-center justify-between"
    >
        <div class="max-w-lg space-y-4">
            <h3 class="text-yellow-400 font-semibold">Nirita Transport</h3>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Solusi Transportasi <br />
                Terpercaya
            </h1>
            <div class="flex space-x-4 mt-6">
                <button
                    class="bg-gray-200 text-gray-800 font-semibold px-6 py-2 rounded-full hover:bg-gray-300 transition"
                >
                    Selengkapnya
                </button>
                <button
                    class="bg-blue-500 text-white font-semibold px-6 py-2 rounded-full hover:bg-blue-600 transition"
                >
                    Pesan Sekarang
                </button>
            </div>
        </div>

        <div class="mt-10 md:mt-0">
            <img
                :src="alphardImage"
                alt="Alphard"
                class="w-[400px] md:w-[550px] drop-shadow-2xl"
            />
        </div>
    </section>
</template>
