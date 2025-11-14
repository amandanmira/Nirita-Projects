<script setup>
import alphardImage from "../Assets/hero-mobil.png";
</script>

<template>
    <section
        class="bg-gradient-to-t from-[#101B4E] to-blue-700 text-white py-14 px-5 md:px-16 lg:px-20"
    >
        <div class="max-w-7xl mx-auto w-full">
            <div
                class="w-full flex flex-col-reverse md:flex-row items-center md:items-center justify-between gap-5"
            >
                <!-- Left column: heading + buttons -->
                <div
                    class="w-full md:max-w-lg space-y-4 flex flex-col items-center text-center md:items-start md:text-left"
                >
                    <h3 class="text-yellow-400 font-semibold">
                        Nirita Transport
                    </h3>
                    <h1
                        class="text-3xl sm:text-4xl md:text-[54px] font-extrabold leading-tight"
                    >
                        Solusi Transportasi <br />
                        Terpercaya
                    </h1>
                    <div class="flex flex-wrap gap-3 mt-6">
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

                <!-- Right column: image -->
                <div
                    class="w-full md:w-auto flex justify-center md:justify-end"
                >
                    <img
                        :src="alphardImage"
                        alt="Alphard"
                        class="w-[320px] sm:w-[380px] md:w-[480px] lg:w-[550px] max-w-full drop-shadow-2xl"
                    />
                </div>
            </div>
        </div>
    </section>
</template>
