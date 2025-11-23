<script setup>
import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import { gsap } from "gsap";
import alphardImage from "../Assets/hero-mobil.png";
import PesanSekarangBtn from "../Components/PesanSekarangBtn.vue";

const page = usePage();
const waTemplates = page.props.waTemplates;

const sectionKiri = ref(null);
const sectionKanan = ref(null);
onMounted(() => {
    gsap.from(sectionKiri.value, {
        duration: 1,
        opacity: 0,
        x: -100,
        ease: "power3.out",
    });
});
onMounted(() => {
    gsap.from(sectionKanan.value, {
        duration: 1,
        opacity: 0,
        x: 100,
        ease: "power3.out",
    });
});
</script>

<template>
    <section
        class="bg-gradient-to-t from-[#101B4E] to-blue-700 text-white py-12 px-5 md:px-16 lg:px-18"
    >
        <div class="max-w-7xl mx-auto w-full">
            <div
                class="w-full flex flex-col-reverse md:flex-row items-center md:items-center justify-between gap-8"
            >
                <!-- Left column: heading + buttons -->
                <div
                    ref="sectionKiri"
                    class="w-full md:max-w-lg space-y-4 flex flex-col items-center text-center md:items-start md:text-left"
                >
                    <h3 class="text-yellow-400 font-semibold text-xl">
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
                            <a href="/about">Selengkapnya</a>
                        </button>
                        <!-- <button
                            class="bg-blue-500 text-white font-semibold px-6 py-2 rounded-full hover:bg-blue-600 transition"
                        >
                            Pesan Sekarang
                        </button> -->
                        <PesanSekarangBtn
                            :templates="waTemplates"
                            :templateId="3"
                        />
                    </div>
                </div>

                <!-- Right column: image -->
                <div
                    ref="sectionKanan"
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
