<script setup>
import { onMounted } from "vue";
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

import MainLayout from "../Layouts/MainLayouts.vue";

gsap.registerPlugin(ScrollTrigger);

const props = defineProps({
    tncs: Array,
});

onMounted(() => {
    // Animasi judul
    gsap.fromTo(
        ".tnc-title",
        { opacity: 0, y: 40 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: ".tnc-title",
                start: "top 85%",
                toggleActions: "restart none none reset",
            },
        }
    );

    // Animasi deskripsi
    gsap.fromTo(
        ".tnc-desc",
        { opacity: 0, y: 40 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            delay: 0.15,
            ease: "power3.out",
            scrollTrigger: {
                trigger: ".tnc-desc",
                start: "top 85%",
                toggleActions: "restart none none reset",
            },
        }
    );

    // Animasi kartu TnC (stagger)
    gsap.utils.toArray(".tnc-card").forEach((card, i) => {
        gsap.fromTo(
            card,
            { opacity: 0, y: 50 },
            {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: i * 0.2,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: card,
                    start: "top 90%",
                    toggleActions: "restart none none reset",
                },
            }
        );
    });
});
</script>

<template>
    <MainLayout>
        <section class="py-16 px-4 bg-gray-50 text-gray-800">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <h2
                    class="tnc-title text-2xl md:text-3xl font-bold mb-3 text-gray-900 opacity-0"
                >
                    Syarat & Ketentuan
                </h2>

                <p class="tnc-desc text-gray-600 leading-relaxed opacity-0">
                    Selamat datang di layanan rental mobil kami. Sebelum
                    melakukan pemesanan, harap membaca dan memahami syarat serta
                    ketentuan berikut ini. Dengan melakukan pemesanan, Anda
                    dianggap telah menyetujui seluruh ketentuan yang berlaku.
                </p>
            </div>

            <div
                class="space-y-6 max-w-4xl mx-auto bg-gradient-to-t from-[#101B4E] to-[#173A84] p-12 rounded-2xl"
            >
                <div
                    v-for="term in props.tncs"
                    :key="term.id"
                    class="tnc-card efek-hover bg-white rounded-xl p-6 opacity-0"
                >
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">
                        {{ term.judul }}
                    </h3>
                    <div class="text-gray-700 leading-relaxed">
                        <p v-html="term.deskripsi"></p>
                    </div>
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
