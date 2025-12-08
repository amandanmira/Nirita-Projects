<script setup>
import { ref, computed, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import gsap from "gsap";
import CallBtnMobil from "../Components/CallBtnMobil.vue";

const page = usePage();
const waTemplates = page.props.waTemplates;

const props = defineProps({
    cars: {
        type: Array,
        default: () => [],
    },
});

// GSAP Animasi HANYA saat halaman reload
onMounted(() => {
    // Sidebar animasi
    gsap.from(".filter-sidebar", {
        opacity: 0,
        x: -50,
        duration: 1,
        ease: "power3.out",
    });

    // Grid card animasi
    gsap.fromTo(
        ".car-card",
        { opacity: 0, y: 50 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: "power3.out",
            stagger: 0.15,
            delay: 0.3,
        }
    );
});

// Filter Model
const filters = ref({
    name: "",
    type: "Semua",
    capacity: "Semua",
    transmission: "Semua",
    price: "Semua",
    availableOnly: false,
});

// Format Rupiah
const formatRupiah = (value) => {
    if (!value) return "-";
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0,
    }).format(Number(value));
};

// Ambil foto pertama dari array JSON database
const getFirstPhoto = (fotoData) => {
    try {
        const parsed = JSON.parse(fotoData);
        if (Array.isArray(parsed) && parsed.length > 0) {
            return parsed[0].startsWith("/storage/")
                ? parsed[0]
                : `/storage/${parsed[0]}`;
        }
    } catch {}

    if (typeof fotoData === "string") {
        return fotoData.startsWith("/storage/")
            ? fotoData
            : `/storage/${fotoData}`;
    }

    return "/placeholder_image/placeholder_mobil.png";
};

// Computed filter
const filteredUnits = computed(() => {
    return props.cars.filter((car) => {
        const sp = car.specification || {};
        const rp = car.rental_price || {};

        const matchName = car.nama_mobil
            ?.toLowerCase()
            .includes(filters.value.name.toLowerCase());

        const matchType =
            filters.value.type === "Semua" ||
            sp.kategori === filters.value.type;

        const matchCapacity =
            filters.value.capacity === "Semua" ||
            (filters.value.capacity === "5" &&
                sp.kapasitas >= 5 &&
                sp.kapasitas < 8) ||
            (filters.value.capacity === "8" &&
                sp.kapasitas >= 8 &&
                sp.kapasitas < 14) ||
            (filters.value.capacity === "14" && sp.kapasitas >= 14);

        const matchTransmission =
            filters.value.transmission === "Semua" ||
            sp.jenis_transmisi === filters.value.transmission;

        const matchPrice =
            filters.value.price === "Semua" ||
            (filters.value.price === "murah" && rp.harga_solo < 1000000) ||
            (filters.value.price === "sedang" &&
                rp.harga_solo >= 1000000 &&
                rp.harga_solo < 2000000) ||
            (filters.value.price === "agak-mahal" &&
                rp.harga_solo >= 2000000 &&
                rp.harga_solo < 3000000) ||
            (filters.value.price === "mahal" && rp.harga_solo >= 3000000);

        return (
            matchName &&
            matchType &&
            matchCapacity &&
            matchTransmission &&
            matchPrice
        );
    });
});

// Reset Filter
const resetFilter = () => {
    filters.value = {
        name: "",
        type: "Semua",
        capacity: "Semua",
        transmission: "Semua",
        price: "Semua",
        availableOnly: false,
    };
};
</script>

<template>
    <section class="bg-gray-100 py-10 px-4 md:px-8 lg:px-16">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- 🔹 Filter Sidebar -->
            <div
                class="bg-white p-5 rounded-xl shadow-md h-fit filter-sidebar md:sticky md:top-0"
            >
                <h2 class="text-xl font-semibold text-blue-800 mb-4">
                    Filter Unit
                </h2>

                <!-- Cari nama -->
                <input
                    v-model="filters.name"
                    type="text"
                    placeholder="Cari Nama Unit..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />

                <!-- Jenis Mobil -->
                <label class="block mb-1 text-gray-700">Jenis Mobil</label>
                <select
                    v-model="filters.type"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"
                >
                    <option>Semua</option>
                    <option>MPV</option>
                    <option>SUV</option>
                    <option>Large SUV</option>
                    <option>MPV Luxury</option>
                    <option>MiniBus</option>
                    <option>Luxury Minibus</option>
                </select>

                <!-- Kapasitas -->
                <label class="block mb-1 text-gray-700">Kapasitas</label>
                <select
                    v-model="filters.capacity"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"
                >
                    <option>Semua</option>
                    <option value="5">5 - 8</option>
                    <option value="8">8 - 14</option>
                    <option value="14">14+</option>
                </select>

                <!-- Transmisi -->
                <label class="block mb-1 text-gray-700">Transmisi</label>
                <select
                    v-model="filters.transmission"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"
                >
                    <option>Semua</option>
                    <option>Matic</option>
                    <option>Manual</option>
                </select>

                <!-- Harga -->
                <label class="block mb-1 text-gray-700">Harga Per Hari</label>
                <select
                    v-model="filters.price"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"
                >
                    <option>Semua</option>
                    <option value="murah">&lt; Rp 1.000.000</option>
                    <option value="sedang">Rp 1.000.000 - Rp 2.000.000</option>
                    <option value="agak-mahal">
                        Rp 2.000.000 - Rp 3.000.000
                    </option>
                    <option value="mahal">&gt; Rp 3.000.000</option>
                </select>

                <!-- Tombol -->
                <div class="flex gap-3">
                    <button
                        class="bg-blue-600 text-white font-medium px-4 py-2 rounded-lg w-full hover:bg-blue-700 transition"
                    >
                        Terapkan
                    </button>
                    <button
                        @click="resetFilter"
                        class="bg-gray-300 text-gray-700 font-medium px-4 py-2 rounded-lg w-full hover:bg-gray-400 transition"
                    >
                        Reset
                    </button>
                </div>
            </div>

            <!-- 🔹 Grid Unit -->
            <div
                class="md:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
            >
                <div
                    v-for="car in filteredUnits"
                    :key="car.id_mobil"
                    class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-lg transition px-2 py-3 car-card"
                >
                    <!-- Foto -->
                    <div
                        class="w-full h-52 bg-gray-100 flex items-center justify-center overflow-hidden p-2 rounded-xl"
                    >
                        <img
                            :src="getFirstPhoto(car.url_foto_mobil)"
                            :alt="car.nama_mobil"
                            class="object-cover hover:scale-105 transition"
                        />
                    </div>

                    <!-- Info -->
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 text-lg">
                            {{ car.nama_mobil }}
                        </h3>

                        <p class="text-gray-600 text-sm mt-1">
                            {{ car.specification?.jenis_transmisi }} •
                            {{ car.specification?.kategori }} •
                            {{ car.specification?.kapasitas }} Kursi
                        </p>

                        <p class="text-blue-600 font-semibold mt-2">
                            {{ formatRupiah(car.rental_price?.harga_solo) }} /
                            Hari
                        </p>

                        <div class="mt-3 tombol-aksi">
                            <a
                                :href="`/units/${car.id_mobil}`"
                                class="flex items-center justify-center gap-2 bg-black text-white text-md rounded-l-md px-5 py-3 w-full border border-transparent hover:bg-white hover:text-black hover:border-black transition"
                            >
                                <i class="fa-solid fa-arrow-right"></i>
                                Lihat Detail
                            </a>

                            <CallBtnMobil
                                :templates="waTemplates"
                                :templateId="2"
                                :carName="car.nama_mobil"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.tombol-aksi {
    display: grid;
    grid-template-columns: auto 50px;
}
</style>
