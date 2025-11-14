<template>
    <DashLayouts>
        <div
            class="max-w-6xl mx-auto bg-white rounded-2xl shadow-2xl mt-10 p-8 border border-gray-100"
        >
            <!-- Header -->
            <div class="flex items-center justify-between mb-6 border-b pb-4">
                <h1
                    class="text-3xl font-extrabold text-gray-800 tracking-tight"
                >
                    {{ mobil.nama_mobil }}
                </h1>
                <Link
                    :href="'/admin/mobil'"
                    class="px-5 py-2 bg-gradient-to-r from-gray-200 to-gray-300 text-gray-800 font-semibold rounded-lg shadow hover:from-gray-300 hover:to-gray-400 transition duration-300"
                >
                    ← Kembali
                </Link>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Carousel -->
                <div
                    class="relative rounded-2xl overflow-hidden shadow-lg border border-gray-200"
                >
                    <img
                        :src="resolveImagePath(parsedFotoMobil[currentIndex])"
                        class="w-full h-full object-contain transition-all duration-700 ease-in-out"
                        alt="Foto Mobil"
                    />

                    <!-- Navigasi -->
                    <button
                        @click="prevSlide"
                        class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full p-2 shadow-lg transition"
                    >
                        ‹
                    </button>
                    <button
                        @click="nextSlide"
                        class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full p-2 shadow-lg transition"
                    >
                        ›
                    </button>

                    <!-- Indikator -->
                    <div
                        class="absolute bottom-3 left-0 right-0 flex justify-center gap-2"
                    >
                        <span
                            v-for="(foto, index) in parsedFotoMobil"
                            :key="index"
                            @click="goToSlide(index)"
                            :class="[
                                'w-3 h-3 rounded-full cursor-pointer transition-all duration-300',
                                index === currentIndex
                                    ? 'bg-blue-600 scale-110'
                                    : 'bg-gray-300 hover:bg-gray-400',
                            ]"
                        ></span>
                    </div>
                </div>

                <!-- Detail -->
                <div class="space-y-4 text-gray-700">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama Mobil</p>
                            <p class="font-semibold text-gray-900 text-lg">
                                {{ mobil.nama_mobil }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Plat Nomor</p>
                            <p class="font-semibold text-gray-900 text-lg">
                                {{ mobil.plat_nomor }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kapasitas</p>
                            <p class="font-semibold">
                                {{ mobil.specification?.kapasitas || "-" }}
                                Orang
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kategori</p>
                            <p class="font-semibold">
                                {{ mobil.specification?.kategori || "-" }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Transmisi</p>
                            <p class="font-semibold">
                                {{
                                    mobil.specification?.jenis_transmisi || "-"
                                }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Ketersediaan</p>
                            <span
                                class="inline-block py-1 rounded-full text-sm font-medium"
                                :class="
                                    mobil.ketersediaan > 0
                                        ? 'text-green-800'
                                        : 'text-red-800'
                                "
                            >
                                {{ mobil.ketersediaan }} Unit
                            </span>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div
                        class="mt-4 bg-gray-50 rounded-lg p-4 border border-gray-200"
                    >
                        <p class="font-semibold text-gray-900 mb-2 text-lg">
                            Harga Sewa
                        </p>
                        <ul class="space-y-1 text-sm">
                            <li>
                                Solo:
                                <span class="font-semibold text-gray-800"
                                    >Rp
                                    {{ formatHarga(rental?.harga_solo) }}</span
                                >
                            </li>
                            <li>
                                Solo Raya:
                                <span class="font-semibold text-gray-800"
                                    >Rp
                                    {{
                                        formatHarga(rental?.harga_solo_raya)
                                    }}</span
                                >
                            </li>
                            <li>
                                Luar Kota:
                                <span class="font-semibold text-gray-800"
                                    >Rp
                                    {{
                                        formatHarga(rental?.harga_luar_kota)
                                    }}</span
                                >
                            </li>
                        </ul>
                    </div>

                    <!-- Fasilitas -->
                    <div class="mt-6">
                        <h2
                            class="text-lg font-semibold text-gray-900 border-b pb-2 mb-3"
                        >
                            Fasilitas
                        </h2>
                        <ul
                            class="grid grid-cols-3 list-disc list-inside text-gray-700 space-y-1"
                        >
                            <li
                                v-for="(item, index) in parsedFasilitas"
                                :key="index"
                                class="leading-relaxed"
                            >
                                {{ item }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </DashLayouts>
</template>

<script setup>
import DashLayouts from "../../Layouts/DashboardLayouts.vue";
import { computed, ref, onMounted, onBeforeUnmount } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    mobil: Object,
});

// Parsing data JSON
const parsedFotoMobil = computed(() => {
    try {
        return JSON.parse(props.mobil.url_foto_mobil);
    } catch {
        return [props.mobil.url_foto_mobil];
    }
});

const parsedFasilitas = computed(() => {
    const raw = props.mobil.specification?.fasilitas;
    try {
        return raw ? JSON.parse(raw) : [];
    } catch {
        return [];
    }
});

const formatHarga = (angka) => {
    if (!angka) return "-";
    const num = Number(angka);
    if (isNaN(num)) return "-";
    return new Intl.NumberFormat("id-ID").format(num);
};

const rental = computed(
    () => props.mobil.rentalPrice || props.mobil.rental_price || null
);

const resolveImagePath = (path) => {
    if (!path) return "/placeholder_image/placeholder_mobil.png";
    if (path.startsWith("../")) return path.replace("..", "");
    if (path.startsWith("/storage")) return path;
    return `/storage/${path}`;
};

// Carousel
const currentIndex = ref(0);
let intervalId = null;

const nextSlide = () => {
    currentIndex.value =
        (currentIndex.value + 1) % parsedFotoMobil.value.length;
};
const prevSlide = () => {
    currentIndex.value =
        (currentIndex.value - 1 + parsedFotoMobil.value.length) %
        parsedFotoMobil.value.length;
};
const goToSlide = (index) => {
    currentIndex.value = index;
};

onMounted(() => {
    intervalId = setInterval(nextSlide, 5000);
});
onBeforeUnmount(() => {
    clearInterval(intervalId);
});
</script>

<style scoped></style>
