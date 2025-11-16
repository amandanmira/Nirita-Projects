<template>
    <div
        v-if="cars"
        class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-20 py-10 px-6 md:px-10 lg:px-18 bg-gradient-to-t from-blue-700 to-[#101B4E] text-white"
    >
        <!-- Gambar Mobil -->
        <div
            class="p-4 rounded-lg overflow-hidden shadow-lg flex justify-center items-center"
        >
            <!-- Carousel Foto -->
            <div
                class="relative w-full h-72 md:h-96 rounded-xl overflow-hidden"
            >
                <img
                    :src="photos[currentIndex]"
                    alt="car photo"
                    class="w-full h-full object-cover transition-all duration-500"
                />

                <!-- Tombol Prev -->
                <button
                    @click="prevPhoto"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/40 text-white px-3 py-2 rounded-full"
                >
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <!-- Tombol Next -->
                <button
                    @click="nextPhoto"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/40 text-white px-3 py-2 rounded-full"
                >
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

                <!-- Indikator Dot -->
                <div class="absolute bottom-3 w-full flex justify-center gap-2">
                    <span
                        v-for="(p, i) in photos"
                        :key="i"
                        class="w-3 h-3 rounded-full"
                        :class="i === currentIndex ? 'bg-white' : 'bg-white/40'"
                    ></span>
                </div>
            </div>
        </div>

        <!-- Detail Mobil -->
        <div class="flex flex-col justify-center">
            <h1 class="text-3xl font-bold mb-5">
                {{ cars.nama_mobil }}
            </h1>

            <!-- Harga -->
            <div class="relative w-full max-w-md">
                <p class="text-md tracking-wide text-[#BFD4FF]">
                    Harga mulai dari
                </p>

                <!-- Harga aktif -->
                <div
                    @click="toggleDropdown"
                    class="cursor-pointer flex justify-between items-center mt-2 bg-white/10 px-4 py-3 rounded-2xl border border-white/20 hover:bg-white/20 transition"
                >
                    <div>
                        <span class="text-3xl font-extrabold">
                            {{ formatCurrency(selectedPrice.value) }}
                        </span>
                        <span class="text-sm text-[#C8D3F5] ml-1">
                            / Hari ({{ selectedPrice.label }})
                        </span>
                    </div>

                    <i
                        class="fa-solid fa-chevron-down text-xl text-blue-200 transition-transform"
                        :class="{ 'rotate-180': showDropdown }"
                    ></i>
                </div>

                <!-- Dropdown -->
                <transition name="fade">
                    <div
                        v-if="showDropdown"
                        class="absolute w-full mt-2 bg-black/90 border border-black/50 rounded-2xl shadow-lg overflow-hidden z-20"
                    >
                        <div
                            v-for="item in priceOptions"
                            :key="item.label"
                            @click="selectPrice(item)"
                            class="px-6 py-4 hover:bg-blue-600/60 transition cursor-pointer border-b border-white/10 last:border-none"
                        >
                            <span class="font-semibold text-white text-lg">
                                {{ formatCurrency(item.value) }}
                            </span>
                            <span class="text-sm text-[#C8D3F5] ml-1">
                                / Hari ({{ item.label }})
                            </span>
                        </div>
                    </div>
                </transition>
            </div>

            <!-- Spesifikasi -->
            <p class="mt-6 mb-0">Spesifikasi</p>
            <div class="flex md:flex-wrap w-full max-w-md gap-4 mt-2">
                <div class="spec-box">
                    <i class="fa-solid fa-gear text-2xl text-[#A6C1FA]"></i>
                    <div>
                        <p class="text-sm text-[#D1D5DC]">Transmisi</p>
                        <p class="text-white">
                            {{ cars.specification?.jenis_transmisi }}
                        </p>
                    </div>
                </div>

                <div class="spec-box">
                    <i class="fa-solid fa-users text-2xl text-[#A6C1FA]"></i>
                    <div>
                        <p class="text-sm text-[#D1D5DC]">Kapasitas</p>
                        <p class="text-white">
                            {{ cars.specification?.kapasitas }} Seat
                        </p>
                    </div>
                </div>

                <div class="spec-box">
                    <i class="fa-solid fa-car text-2xl text-[#A6C1FA]"></i>
                    <div>
                        <p class="text-sm text-[#D1D5DC]">Jenis Mobil</p>
                        <p class="text-white">
                            {{ cars.specification?.kategori }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sisa Unit & Tombol -->
            <div class="mt-6 flex flex-col sm:flex-row gap-6">
                <div
                    class="bg-gray-900 px-5 py-3 rounded-lg flex items-center justify-center"
                >
                    <i class="fa-solid fa-car text-2xl mr-2"></i>
                    <p>Sisa Unit:</p>
                    <span class="font-semibold ml-2">
                        {{ cars.ketersediaan }}
                    </span>
                </div>

                <a
                    :href="`https://wa.me/6281393604105?text=Halo,%20saya%20ingin%20menyewa%20${cars.nama_mobil}`"
                    target="_blank"
                    class="bg-blue-600 px-5 py-3 rounded-lg flex items-center justify-center hover:bg-blue-700"
                >
                    <i class="fa-solid fa-phone text-2xl mr-2"></i>
                    Hubungi
                </a>
            </div>
        </div>
    </div>

    <div v-else class="text-center p-10">
        <p class="text-gray-500 text-lg">Mobil tidak ditemukan.</p>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps({
    cars: Object,
});

// ---- Foto Pertama ----
const photos = computed(() => {
    try {
        return JSON.parse(props.cars.url_foto_mobil).map(
            (p) => `/storage/${p}`
        );
    } catch {
        return props.cars.url_foto_mobil
            ? [`/storage/${props.cars.url_foto_mobil}`]
            : [];
    }
});

const currentIndex = ref(0);

const nextPhoto = () => {
    currentIndex.value = (currentIndex.value + 1) % photos.value.length;
};

const prevPhoto = () => {
    currentIndex.value =
        (currentIndex.value - 1 + photos.value.length) % photos.value.length;
};

// ---- Dropdown Harga ----
const showDropdown = ref(false);

const priceOptions = computed(() => [
    {
        label: "Solo",
        value: props.cars.rental_price?.harga_solo,
    },
    {
        label: "Solo Raya",
        value: props.cars.rental_price?.harga_solo_raya,
    },
    {
        label: "Luar Kota",
        value: props.cars.rental_price?.harga_luar_kota,
    },
]);

const selectedPrice = ref(priceOptions.value[0]);

const toggleDropdown = () => (showDropdown.value = !showDropdown.value);

const selectPrice = (item) => {
    selectedPrice.value = item;
    showDropdown.value = false;
};

const formatCurrency = (value) =>
    new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(value);
</script>

<style scoped>
.spec-box {
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(255, 255, 255, 0.1);
    padding: 16px;
    border-radius: 10px;
    flex: 1;
}
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
