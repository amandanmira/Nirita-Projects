<script setup>
import { ref, computed } from "vue";
import allUnits from "@/data/cars2.js";
import fotoMobil from "@/Assets/hero-mobil.png";

const filters = ref({
    name: "",
    type: "Semua",
    capacity: "Semua",
    transmission: "Semua",
    price: "Semua",
    availableOnly: false,
});

// 🔹 Filter logic
const filteredUnits = computed(() => {
    return allUnits.filter((unit) => {
        const matchName = unit.name
            .toLowerCase()
            .includes(filters.value.name.toLowerCase());
        const matchType =
            filters.value.type === "Semua" || unit.type === filters.value.type;
        const matchCapacity =
            filters.value.capacity === "Semua" ||
            unit.capacity === Number(filters.value.capacity);
        const matchTransmission =
            filters.value.transmission === "Semua" ||
            unit.transmission === filters.value.transmission;
        const matchPrice =
            filters.value.price === "Semua" ||
            (filters.value.price === "murah" && unit.price < 1000000) ||
            (filters.value.price === "sedang" &&
                unit.price >= 1000000 &&
                unit.price < 3000000) ||
            (filters.value.price === "mahal" && unit.price >= 3000000);
        const matchAvailable =
            !filters.value.availableOnly || unit.available === true;

        return (
            matchName &&
            matchType &&
            matchCapacity &&
            matchTransmission &&
            matchPrice &&
            matchAvailable
        );
    });
});

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
    <section class="bg-gray-100 py-10 px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- 🔹 Filter Sidebar -->
            <div class="bg-white p-5 rounded-xl shadow-md h-fit">
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
                    <option>Van</option>
                    <option>City Car</option>
                </select>

                <!-- Kapasitas -->
                <label class="block mb-1 text-gray-700">Kapasitas</label>
                <select
                    v-model="filters.capacity"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3"
                >
                    <option>Semua</option>
                    <option value="4">4</option>
                    <option value="7">7</option>
                    <option value="14">14</option>
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
                    <option value="sedang">Rp 1.000.000 - Rp 3.000.000</option>
                    <option value="mahal">&gt; Rp 3.000.000</option>
                </select>

                <!-- Hanya tersedia -->
                <div class="flex items-center mb-4">
                    <input
                        type="checkbox"
                        v-model="filters.availableOnly"
                        id="availableOnly"
                        class="mr-2"
                    />
                    <label for="availableOnly" class="text-gray-700 text-sm"
                        >Tampilkan Unit Tersedia Saja</label
                    >
                </div>

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
                    v-for="unit in filteredUnits"
                    :key="unit.id"
                    class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-lg transition"
                >
                    <div class="p-4">
                        <img
                            :src="unit.image"
                            :alt="unit.name"
                            class="w-full h-44 object-cover"
                        />
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900">
                            {{ unit.name }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            {{ unit.transmission }} • {{ unit.capacity }} Kursi
                            • {{ unit.fuel }}
                        </p>
                        <p class="text-blue-700 font-semibold mt-1">
                            Rp
                            {{
                                unit.price
                                    .find((p) => p.label === "Area Solo")
                                    .value.toLocaleString("id-ID")
                            }}
                            / Hari (Area Solo)
                        </p>

                        <div class="mt-2 flex justify-between">
                            <!-- Tombol Hitam -->
                            <router-link
                                :to="{
                                    name: 'car-detail',
                                    params: { id: unit.id },
                                }"
                                class="cursor-pointer flex items-center justify-center gap-2 bg-black text-white text-md rounded-l-md px-5 py-3 w-full hover:bg-blue-600 transition"
                            >
                                <i class="fa-solid fa-arrow-right"></i>
                                Lihat Detail
                            </router-link>

                            <!-- Tombol Biru -->
                            <button
                                class="cursor-pointer flex items-center justify-center bg-blue-600 text-white rounded-r-md px-3 py-2 hover:bg-black transition"
                            >
                                <i class="fa-solid fa-phone"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
