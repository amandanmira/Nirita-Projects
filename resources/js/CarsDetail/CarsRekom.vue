<template>
    <section class="bg-white py-16 px-6 md:px-12 lg:px-20">
        <div class="max-w-7xl mx-auto text-center">
            <!-- Wrapper -->
            <div class="bg-[#0E1A47] rounded-2xl shadow-lg p-8 md:p-10">
                <div
                    class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-6"
                >
                    <div
                        v-for="unit in displayedUnits"
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
                                {{ unit.transmission }} •
                                {{ unit.capacity }} Kursi • {{ unit.fuel }}
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
        </div>
    </section>
</template>

<script setup>
import { computed } from "vue";
import allUnits from "@/data/cars2.js";

// Shuffle helper (Fisher-Yates)
const shuffle = (array) => {
    const a = array.slice();
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
};

// Display only 4 random units (if less than 4, show all)
const displayedUnits = computed(() => {
    if (!Array.isArray(allUnits)) return [];
    const pool = shuffle(allUnits);
    return pool.slice(0, Math.min(4, pool.length));
});
</script>
