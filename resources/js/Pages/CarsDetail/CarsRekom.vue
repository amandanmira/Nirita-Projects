<template>
    <section class="bg-white py-16 px-6 md:px-12 lg:px-20">
        <div class="max-w-7xl mx-auto">
            <!-- ===== REKOMENDASI ===== -->
            <div class="text-center rekom-section">
                <h2 class="text-2xl font-bold text-blue-900 mb-6 rekom-title">
                    Rekomendasi Mobil Lain
                </h2>

                <div
                    class="bg-[#0E1A47] rounded-2xl shadow-lg p-8 md:p-10 rekom-box"
                >
                    <div
                        class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth scrollbar-hide"
                    >
                        <div
                            v-for="unit in rekomUnits"
                            :key="unit.id_mobil"
                            class="flex-shrink-0 w-[100%] sm:w-[48%] lg:w-[23%] bg-white shadow-md rounded-xl overflow-hidden hover:shadow-lg transition snap-start"
                        >
                            <div
                                class="p-4 w-full h-34 flex items-center justify-center bg-gray-100"
                            >
                                <img
                                    :src="unit.first_photo"
                                    :alt="unit.nama_mobil"
                                    class="object-cover rounded-md"
                                />
                            </div>

                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900">
                                    {{ unit.nama_mobil }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ unit.specification?.jenis_transmisi }} •
                                    {{ unit.specification?.kapasitas }} Kursi •
                                    {{ unit.specification?.kategori }}
                                </p>

                                <p class="text-blue-700 font-semibold mt-1">
                                    Rp
                                    {{
                                        formatNumber(
                                            unit.rental_price?.harga_solo
                                        )
                                    }}
                                    / Hari
                                </p>

                                <div class="mt-2 flex justify-between">
                                    <a
                                        :href="`/units/${unit.id_mobil}`"
                                        class="flex items-center justify-center gap-2 bg-black text-white text-md rounded-l-md px-5 py-3 w-full border border-transparent hover:bg-white hover:text-black hover:border-black transition"
                                    >
                                        <i class="fa-solid fa-arrow-right"></i>
                                        Lihat Detail
                                    </a>

                                    <CallBtnMobil
                                        :templates="waTemplates"
                                        :templateId="4"
                                        :carName="unit.nama_mobil"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { computed, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import CallBtnMobil from "../Components/CallBtnMobil.vue";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

onMounted(() => {
    // Judul
    gsap.from(".rekom-title", {
        opacity: 0,
        y: 60,
        duration: 1,
        ease: "power3.out",
        scrollTrigger: {
            trigger: ".rekom-title",
            start: "top 85%",
            toggleActions: "play reverse play reverse",
        },
    });

    // Container utama
    gsap.from(".rekom-box", {
        opacity: 0,
        scale: 0.9,
        duration: 1,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".rekom-box",
            start: "top 80%",
            toggleActions: "play reverse play reverse",
        },
    });

    // Stagger cards
    // gsap.from(".rekom-card", {
    //     opacity: 0,
    //     y: 50,
    //     duration: 0.8,
    //     stagger: 0.2,
    //     ease: "power3.out",
    //     scrollTrigger: {
    //         trigger: ".rekom-card",
    //         start: "top 80%",
    //         toggleActions: "play reverse play reverse",
    //     },
    // });
});

const page = usePage();
const waTemplates = page.props.waTemplates;

// === Data dari Controller ===
const cars = page.props.cars;
const carsRekom = page.props.carsRekom;

// ===== FOTO PERTAMA UNTUK DETAIL =====
const firstPhoto = computed(() => {
    if (!cars.url_foto_mobil) return "/default.jpg";

    try {
        const arr = JSON.parse(cars.url_foto_mobil); // Pastikan decode JSON
        return arr.length ? `/storage/${arr[0]}` : "/default.jpg";
    } catch (e) {
        return "/default.jpg";
    }
});

// ===== FORMAT DATA REKOMENDASI =====
const rekomUnits = computed(() => {
    return carsRekom
        .filter((unit) => unit.id_mobil !== cars.id_mobil) // Jangan tampilkan mobil yang sama
        .slice(0, 4)
        .map((unit) => {
            let first = "/default.jpg";
            try {
                const arr = JSON.parse(unit.url_foto_mobil);
                if (arr.length) {
                    first = `/storage/${arr[0]}`;
                }
            } catch (e) {}

            return {
                ...unit,
                first_photo: first,
            };
        });
});

// ===== FORMAT RUPIAH =====
const formatNumber = (num) => {
    return Number(num).toLocaleString("id-ID");
};
</script>

<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
