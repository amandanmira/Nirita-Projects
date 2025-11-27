<template>
    <section
        ref="refAbout"
        class="bg-gray-50 py-6 md:py-20 px-6 md:px-16 lg:px-20"
    >
        <div class="w-full max-w-7xl mx-auto about-wrapper">
            <!-- Judul -->
            <h2
                ref="refTitle"
                class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-center text-gray-900 mb-10"
            >
                Tentang Nirita Transport
            </h2>

            <!-- Konten Utama -->
            <div
                ref="refContent"
                class="about-content bg-[#0b1a46] text-white rounded-2xl shadow-lg flex flex-col md:flex-row items-center gap-8 p-6 md:p-10"
            >
                <!-- Kolom Kiri (Teks) -->
                <div
                    ref="refText"
                    class="flex-1 space-y-4 leading-relaxed about-text"
                >
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
                    ref="refImages"
                    class="flex-1 grid grid-cols-2 gap-4 justify-center items-center w-full md:w-auto"
                >
                    <img
                        :src="FotoKiri"
                        alt="Bus Nirita"
                        class="imgItem rounded-xl object-cover w-full h-40 md:h-56 lg:h-72 shadow-md"
                    />
                    <img
                        :src="FotoKanan"
                        alt="Mobil Nirita"
                        class="imgItem rounded-xl object-cover w-full h-40 md:h-56 lg:h-72 shadow-md"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, nextTick } from "vue";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

import FotoKiri from "../Assets/section-kiri.jpg";
import FotoKanan from "../Assets/section-kanan.jpg";

// refs
const refAbout = ref(null);
const refTitle = ref(null);
const refContent = ref(null);
const refText = ref(null);
const refImages = ref(null);

onMounted(async () => {
    await nextTick();
    ScrollTrigger.refresh(); // WAJIB untuk Vue 3

    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: refAbout.value,
            start: "top 80%",
        },
    });

    // 1. Fade-in section wrapper
    tl.from(refAbout.value, {
        opacity: 0,
        y: 20,
        duration: 0.8,
        ease: "power3.out",
    });

    // 2. Judul muncul
    tl.from(
        refTitle.value,
        {
            opacity: 0,
            y: 20,
            duration: 0.6,
            ease: "power2.out",
        },
        "-=0.4"
    );

    // 3. Box konten fade-up
    tl.from(
        refContent.value,
        {
            opacity: 0,
            y: 25,
            duration: 0.8,
            ease: "power3.out",
        },
        "-=0.4"
    );

    // 4. Teks masuk halus dari kiri
    tl.from(
        refText.value.children,
        {
            opacity: 0,
            x: -30,
            duration: 0.7,
            ease: "power3.out",
            stagger: 0.15,
        },
        "-=0.3"
    );

    // 5. Gambar masuk dari kanan (stagger)
    tl.from(
        refImages.value.querySelectorAll(".imgItem"),
        {
            opacity: 0,
            x: 30,
            duration: 0.8,
            ease: "power3.out",
            stagger: 0.2,
        },
        "-=0.5"
    );
});
</script>

<style scoped>
/* Tidak perlu CSS tambahan — animasi sudah full GSAP */
</style>
