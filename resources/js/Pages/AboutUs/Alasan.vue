<template>
    <section class="bg-gray-50 py-16 px-6 md:px-12 lg:px-20" ref="sectionRef">
        <div class="w-full max-w-7xl mx-auto text-center">
            <!-- Judul -->
            <h2
                class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-12"
                ref="titleRef"
            >
                Mengapa Memilih Nirita Transport?
            </h2>

            <!-- Grid Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div
                    v-for="(item, index) in items"
                    :key="index"
                    class="bg-[#0E1A47] text-white rounded-xl shadow-md p-8 text-left"
                    ref="cardsRef"
                >
                    <p class="leading-relaxed text-xl">
                        {{ item }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, nextTick } from "vue";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

const sectionRef = ref(null);
const titleRef = ref(null);
const cardsRef = ref([]);

const items = [
    "Kami menyediakan beragam unit, mulai dari mobil komersial seperti Toyota Innova Reborn dan Avanza New, hingga mobil mewah seperti Toyota Fortuner dan Alphard, serta Bus Pariwisata.",
    "Kondisi kendaraan selalu prima, terawat, dan dilengkapi kenyamanan seperti AC dan Audio. Unit besar memiliki TV & DVD Karaoke.",
    "Setiap layanan sewa mobil sudah termasuk driver profesional untuk memastikan perjalanan Anda nyaman dan aman.",
    "Selain sewa mobil, kami melayani biro perjalanan pariwisata. One-stop solution untuk semua kebutuhan perjalanan Anda.",
];

onMounted(async () => {
    await nextTick();

    ScrollTrigger.refresh(); // penting untuk Vue

    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: sectionRef.value,
            start: "top 85%",
            toggleActions: "restart none none reset",
        },
    });

    // Animasi Judul
    tl.from(titleRef.value, {
        opacity: 0,
        y: 30,
        duration: 0.7,
        ease: "power3.out",
    });

    // Animasi Cards
    tl.from(
        cardsRef.value,
        {
            opacity: 0,
            y: 40,
            duration: 0.8,
            ease: "power3.out",
            stagger: 0.2,
        },
        "-=0.3"
    );
});
</script>

<style scoped>
/* Optional hover effect */
div.bg-\[\#0E1A47\]:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
}
</style>
