<template>
    <section class="bg-gray-50 py-14 px-6 md:px-12 lg:px-20" ref="sectionRef">
        <div class="max-w-6xl mx-auto text-center">
            <!-- Judul -->
            <h2
                class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4"
                ref="titleRef"
            >
                Menjadi Pilihan Utama untuk Mobilitas Anda
            </h2>

            <!-- Subtext -->
            <p class="text-gray-700 mb-10" ref="descRef">
                Di
                <span class="font-semibold text-gray-900">Nirita Transport</span
                >, kami berkomitmen untuk memberikan layanan transportasi yang
                unggul dan terpercaya, didukung oleh visi dan misi kami:
            </p>

            <!-- Grid Visi Misi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div
                    v-for="(item, index) in cards"
                    :key="index"
                    class="bg-white rounded-xl shadow-md p-8 text-left efek-hover"
                    ref="cardsRef"
                >
                    <h3 class="text-lg font-bold text-gray-900 mb-3">
                        {{ item.title }}
                    </h3>

                    <p class="text-gray-700 leading-relaxed">
                        {{ item.text }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, nextTick, onMounted } from "vue";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

// Refs
const sectionRef = ref(null);
const titleRef = ref(null);
const descRef = ref(null);
const cardsRef = ref([]);

const cards = [
    {
        title: "Visi",
        text: "Menjadi perusahaan jasa pelayanan sewa mobil dan biro perjalanan pariwisata yang terdepan dan terpercaya dalam memberikan solusi mobilitas yang nyaman dan aman sehingga dapat memberikan pengalaman terbaik bagi pelanggan.",
    },
    {
        title: "Misi",
        text: "Menyediakan berbagai macam pilihan unit yang lengkap dan berkualitas serta pelayanan profesional dengan harga terjangkau untuk mewujudkan transportasi yang aman dan nyaman bagi masyarakat.",
    },
];

onMounted(async () => {
    await nextTick();

    ScrollTrigger.refresh(); // Wajib untuk Vue agar posisi element akurat

    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: sectionRef.value,
            start: "top 85%",
            toggleActions: "restart none none reset",
        },
    });

    // Judul
    tl.from(titleRef.value, {
        opacity: 0,
        y: 30,
        duration: 0.7,
        ease: "power3.out",
    });

    // Deskripsi
    tl.from(
        descRef.value,
        {
            opacity: 0,
            y: 20,
            duration: 0.6,
            ease: "power3.out",
        },
        "-=0.3"
    );

    // Kartu (Visi & Misi)
    tl.from(
        cardsRef.value,
        {
            opacity: 0,
            y: 40,
            duration: 0.8,
            ease: "power3.out",
            stagger: 0.25,
        },
        "-=0.2"
    );
});
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
