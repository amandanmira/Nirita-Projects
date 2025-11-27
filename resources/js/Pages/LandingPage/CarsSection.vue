<template>
    <section class="bg-white py-16 px-6 md:px-20">
        <div class="max-w-7xl mx-auto">
            <!-- Judul -->
            <div class="text-center mb-10">
                <h2
                    class="armada-title text-2xl md:text-3xl font-semibold text-gray-900 mb-2"
                >
                    Pilihan Armada Kami
                </h2>
                <a
                    href="/units"
                    class="armada-link hover:text-blue-600 text-sm underline decoration-dotted py-2"
                >
                    LIHAT SEMUA
                </a>
            </div>

            <!-- Grid -->
            <div
                class="armada-grid grid gap-8 md:grid-cols-3 sm:grid-cols-2 grid-cols-1"
            >
                <div
                    v-for="car in props.cars"
                    :key="car.id_mobil"
                    class="armada-card bg-white shadow-sm border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition"
                >
                    <!-- Gambar -->
                    <div
                        class="w-full h-52 bg-gray-100 flex items-center justify-center overflow-hidden"
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

                            <p class="text-gray-600 text-sm mt-1">
                                {{ car.specification?.jenis_transmisi }} ·
                                {{ car.specification?.kategori }} ·
                                {{ car.specification?.kapasitas }} Kursi
                            </p>

                            <p class="text-blue-600 font-semibold mt-2">
                                {{ formatRupiah(car.rental_price?.harga_solo) }}
                                / Hari
                            </p>
                        </div>

                        <div class="tombol-aksi mt-2">
                            <a
                                :href="`/units/${car.id_mobil}`"
                                class="cursor-pointer flex items-center justify-center gap-2 bg-black text-white text-md rounded-l-md px-5 py-3 w-full border border-transparent hover:bg-white hover:text-black hover:border-black transition"
                            >
                                <i class="fa-solid fa-arrow-right"></i>
                                Lihat Detail
                            </a>

                            <CallBtnMobil
                                :templates="waTemplates"
                                :templateId="4"
                                :carName="car.nama_mobil"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { onMounted } from "vue";
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import { usePage } from "@inertiajs/vue3";
import CallBtnMobil from "../Components/CallBtnMobil.vue";

gsap.registerPlugin(ScrollTrigger);

const page = usePage();
const waTemplates = page.props.waTemplates;

const props = defineProps({
    cars: {
        type: Array,
        default: () => [],
    },
});

// Rupiah format
const formatRupiah = (value) => {
    if (!value) return "-";
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0,
    }).format(Number(value));
};

// get first image
const getFirstPhoto = (fotoData) => {
    try {
        const parsed = JSON.parse(fotoData);
        if (parsed?.length) {
            return parsed[0].startsWith("/storage/")
                ? parsed[0]
                : `/storage/${parsed[0]}`;
        }
    } catch (_) {
        return typeof fotoData === "string"
            ? fotoData.startsWith("/storage/")
                ? fotoData
                : `/storage/${fotoData}`
            : "/placeholder_image/placeholder_mobil.png";
    }
};

// === GSAP ANIMATIONS ===
onMounted(() => {
    // Title & link
    gsap.fromTo(
        ".armada-title",
        { opacity: 0, y: 40 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: ".armada-title",
                start: "top 85%",
                toggleActions: "restart none none reset",
            },
        }
    );

    gsap.fromTo(
        ".armada-link",
        { opacity: 0, y: 40 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            delay: 0.15,
            ease: "power3.out",
            scrollTrigger: {
                trigger: ".armada-title",
                start: "top 85%",
                toggleActions: "restart none none reset",
            },
        }
    );

    // container grid
    gsap.fromTo(
        ".armada-grid",
        { opacity: 0, y: 60 },
        {
            opacity: 1,
            y: 0,
            duration: 1.2,
            delay: 0.3,
            ease: "power2.out",
            scrollTrigger: {
                trigger: ".armada-grid",
                start: "top 85%",
                toggleActions: "restart none none reset",
            },
        }
    );

    // cards stagger
    const cards = gsap.utils.toArray(".armada-card");
    cards.forEach((card, i) => {
        gsap.fromTo(
            card,
            { opacity: 0, y: 80 },
            {
                opacity: 1,
                y: 0,
                duration: 0.9,
                delay: i * 0.15,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: card,
                    start: "top 95%",
                    toggleActions: "restart none none reset",
                },
            }
        );
    });
});
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
