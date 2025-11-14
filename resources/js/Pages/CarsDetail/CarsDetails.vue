<template>
    <div
        v-if="car"
        class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-20 py-10 px-6 md:px-10 lg:px-18 bg-gradient-to-t from-blue-700 to-[#101B4E] text-white"
    >
        <!-- 🖼️ Gambar Mobil -->
        <div
            class="p-4 rounded-lg overflow-hidden shadow-lg flex justify-center items-center"
        >
            <img
                :src="car.image"
                alt="car"
                class="w-full max-w-md md:max-w-full object-cover rounded-xl"
            />
        </div>

        <!-- 📋 Detail Mobil -->
        <div class="flex flex-col justify-center">
            <h1
                class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-5 text-center md:text-left"
            >
                {{ car.name }}
            </h1>

            <!-- 💰 Harga -->
            <div class="relative w-full max-w-md">
                <p class="text-md tracking-wide text-[#BFD4FF]">
                    Harga mulai dari
                </p>

                <!-- Tampilan harga aktif -->
                <div
                    @click="toggleDropdown"
                    class="cursor-pointer flex justify-between items-center mt-2 bg-white/10 px-4 sm:px-6 py-3 rounded-2xl backdrop-blur-sm border border-white/20 shadow-inner hover:bg-white/20 transition"
                >
                    <div>
                        <span
                            class="text-2xl sm:text-3xl font-extrabold text-white drop-shadow-[0_1px_3px_rgba(255,255,255,0.3)]"
                        >
                            {{ formatCurrency(selectedPrice.value) }}
                        </span>
                        <span
                            class="text-xs sm:text-sm text-[#C8D3F5] font-medium ml-1"
                            >/ Hari ({{ selectedPrice.label }})</span
                        >
                    </div>
                    <i
                        class="fa-solid fa-chevron-down text-lg sm:text-xl text-blue-200 transition-transform"
                        :class="{ 'rotate-180': showDropdown }"
                    ></i>
                </div>

                <!-- Dropdown daftar harga -->
                <transition name="fade">
                    <div
                        v-if="showDropdown"
                        class="absolute w-full mt-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-lg overflow-hidden z-20"
                    >
                        <div
                            v-for="(p, index) in car.price"
                            :key="index"
                            @click="selectPrice(p)"
                            class="px-4 sm:px-6 py-3 sm:py-4 hover:bg-blue-600/60 transition cursor-pointer border-b border-white/10 last:border-none"
                        >
                            <span
                                class="font-semibold text-white text-base sm:text-lg"
                            >
                                {{ formatCurrency(p.value) }}
                            </span>
                            <span
                                class="text-xs sm:text-sm text-[#C8D3F5] ml-1"
                            >
                                / Hari ({{ p.label }})
                            </span>
                        </div>
                    </div>
                </transition>
            </div>

            <!-- ⚙️ Spesifikasi -->
            <p class="mt-6 mb-0 text-left">Spesifikasi</p>
            <div class="flex flex-wrap w-full max-w-md gap-3 sm:gap-4 mt-2">
                <div
                    class="flex items-center gap-2 bg-white/10 px-3 py-4 rounded-lg flex-1"
                >
                    <i
                        class="fa-solid fa-gear text-xl sm:text-2xl text-[#A6C1FA]"
                    ></i>
                    <div>
                        <p class="text-xs sm:text-sm text-[#D1D5DC]">
                            Transmisi
                        </p>
                        <p class="text-sm text-white">{{ car.transmission }}</p>
                    </div>
                </div>

                <div
                    class="flex items-center gap-2 bg-white/10 px-3 py-4 rounded-lg flex-1"
                >
                    <i
                        class="fa-solid fa-users text-xl sm:text-2xl text-[#A6C1FA]"
                    ></i>
                    <div>
                        <p class="text-xs sm:text-sm text-[#D1D5DC]">
                            Kapasitas
                        </p>
                        <p class="text-sm text-white">
                            {{ car.capacity }} Seat
                        </p>
                    </div>
                </div>

                <div
                    class="flex items-center gap-2 bg-white/10 px-3 py-4 rounded-lg flex-1"
                >
                    <i
                        class="fa-solid fa-car text-xl sm:text-2xl text-[#A6C1FA]"
                    ></i>
                    <div>
                        <p class="text-xs sm:text-sm text-[#D1D5DC]">
                            Jenis Mobil
                        </p>
                        <p class="text-sm text-white">{{ car.type }}</p>
                    </div>
                </div>
            </div>

            <!-- 🚗 Unit & Tombol -->
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-start gap-4 sm:gap-8 mt-6 text-center md:text-left"
            >
                <div
                    class="flex items-center justify-center bg-gray-900 px-5 py-3 rounded-lg text-sm sm:text-base"
                >
                    <i class="fa-solid fa-car text-2xl mr-2"></i>
                    <p>Sisa Unit Tersedia:</p>
                    <span class="font-semibold ml-2">{{ car.available }}</span>
                </div>

                <button
                    class="flex items-center justify-center gap-4 bg-blue-600 text-white font-semibold px-5 py-3 rounded-lg hover:bg-blue-700 transition text-sm sm:text-base disabled:bg-gray-500"
                    :disabled="!car.available"
                >
                    <i class="fa-solid fa-phone text-2xl"></i>
                    {{ car.available ? "Sewa Sekarang" : "Tidak Tersedia" }}
                </button>
            </div>
        </div>
    </div>

    <div v-else class="text-center p-10">
        <p class="text-gray-500 text-lg">Mobil tidak ditemukan.</p>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import cars from "@/data/cars2.js";

const route = useRoute();
const car = ref(null);
const showDropdown = ref(false);
const selectedPrice = ref({ label: "Area Solo", value: 0 });

onMounted(() => {
    car.value = cars.find((c) => c.id === parseInt(route.params.id));
    if (car.value && car.value.price.length > 0) {
        selectedPrice.value = car.value.price[0];
    }
});

const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
};

const selectPrice = (price) => {
    selectedPrice.value = price;
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
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
