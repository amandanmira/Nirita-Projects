<template>
    <section class="px-18 py-10 bg-white text-gray-800">
        <!-- Judul utama -->
        <div class="grid md:grid-cols-2 gap-16">
            <!-- Kolom Kiri - Paket Layanan -->
            <div class="left-col">
                <h2
                    class="text-2xl font-bold text-blue-800 mb-4 inline-block pb-1"
                >
                    Paket Layanan
                </h2>

                <h3 class="font-semibold mb-2">Paket Layanan Tersedia:</h3>
                <ul class="list-decimal list-inside space-y-1 leading-relaxed">
                    <li class="stagger-item">
                        <strong>Paket Basic</strong> – Include mineral water
                    </li>
                    <li class="stagger-item">
                        <strong>Paket Standard</strong> – Include mineral water,
                        soft drink
                    </li>
                    <li class="stagger-item">
                        <strong>Paket Plus</strong> – Include mineral water,
                        soft drink, buah
                    </li>
                    <li class="stagger-item">
                        <strong>Paket Premium</strong> – Include mineral water,
                        soft drink, buah, snack
                    </li>
                    <li class="stagger-item">
                        <strong>Paket Deluxe</strong> – Include mineral water,
                        soft drink, buah, snack, makan siang
                    </li>
                    <li class="stagger-item">
                        <strong>Paket Ultimate</strong> – Include mineral water,
                        soft drink, buah, snack, makan siang, oleh-oleh khas
                        kota tersebut
                    </li>
                    <li class="stagger-item">
                        <strong>Paket Complete</strong> – Include mineral water,
                        soft drink, buah, snack, makan siang, uang parkir setiap
                        destinasi wisata
                    </li>
                    <li class="stagger-item">
                        <strong>Paket All Inclusive</strong> – Include mineral
                        water, soft drink, buah, snack, makan siang, uang parkir
                        setiap destinasi wisata, dan e-tol (untuk luar
                        kota/jarak jauh/mengejar waktu)
                    </li>
                </ul>
            </div>

            <!-- Kolom Kanan - Fasilitas -->
            <div class="right-col">
                <h2
                    class="text-2xl font-bold text-blue-800 mb-4 inline-block pb-1 stagger-item"
                >
                    Fasilitas
                </h2>

                <h3 class="font-semibold mb-2">Fasilitas Yang Tersedia:</h3>

                <ul class="list-decimal list-inside space-y-1 leading-relaxed">
                    <li
                        v-for="(item, index) in fasilitasList"
                        :key="index"
                        class="stagger-item"
                    >
                        {{ item }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- Catatan -->
        <div class="tips-box mt-5">
            <p class="mt-5 text-lg text-blue-800 font-semibold">Catatan:</p>
            <p class="text-lg">
                Paket yang lebih tinggi sudah termasuk semua fasilitas dari
                paket sebelumnya ditambah benefit tambahan untuk kenyamanan
                perjalanan Anda.
            </p>
        </div>

        <!-- Tips Pemesanan -->
        <div
            class="tips-box max-w-2xl mx-auto mt-8 bg-blue-50 border border-blue-100 rounded-xl p-6 shadow-sm flex flex-col items-start md:items-center gap-4"
        >
            <div class="flex items-center gap-2 text-blue-800 text-3xl">
                💡
                <h3 class="text-blue-800 font-bold text-xl mb-1">
                    Tips Pemesanan
                </h3>
            </div>
            <div>
                <p class="text-gray-700 text-md leading-relaxed">
                    Untuk mendapatkan pengalaman terbaik, pastikan Anda memilih
                    paket yang sesuai dengan kebutuhan perjalanan Anda.
                </p>
                <p class="mt-3 text-gray-700 text-md leading-relaxed">
                    Hubungi admin kami untuk konsultasi paket yang paling cocok
                    untuk rencana perjalanan Anda.
                </p>
            </div>
        </div>
    </section>
</template>

<script setup>
import { computed, onMounted } from "vue";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

const props = defineProps({
    cars: {
        type: Object,
        required: true,
    },
});

onMounted(() => {
    // Kiri
    gsap.from(".left-col", {
        opacity: 0,
        x: -80,
        duration: 1,
        ease: "power3.out",
        scrollTrigger: {
            trigger: ".left-col",
            start: "top 80%",
            toggleActions: "restart none none reset",
        },
    });

    // Kanan
    gsap.from(".right-col", {
        opacity: 0,
        x: 80,
        duration: 1,
        ease: "power3.out",
        scrollTrigger: {
            trigger: ".right-col",
            start: "top 80%",
            toggleActions: "restart none none reset",
        },
    });

    // Stagger pada list item paket & fasilitas
    gsap.from(".stagger-item", {
        opacity: 0,
        y: 40,
        duration: 0.6,
        stagger: 0.15,
        ease: "power3.out",
        scrollTrigger: {
            trigger: ".stagger-item",
            start: "top 85%",
            toggleActions: "restart none none reset",
        },
    });

    // Box Tips Pemesanan
    gsap.from(".tips-box", {
        opacity: 0,
        scale: 0.9,
        duration: 0.8,
        ease: "power3.out",
        scrollTrigger: {
            trigger: ".tips-box",
            start: "top 90%",
            toggleActions: "restart none none reset",
        },
    });
});

// Parsing fasilitas TEXT → array
const fasilitasList = computed(() => {
    if (!props.cars.specification?.fasilitas) return [];

    try {
        // Jika string JSON → parse
        return JSON.parse(props.cars.specification?.fasilitas);
    } catch (e) {
        // Jika formatnya dipisah koma → "AC,TV,Minum"
        return props.cars.specification?.fasilitas
            .split(",")
            .map((item) => item.trim());
    }
});
</script>

<style scoped></style>
