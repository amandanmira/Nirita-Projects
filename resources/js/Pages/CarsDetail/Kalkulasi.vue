<template>
    <section class="max-w-4xl mx-auto my-9 px-6">
        <h2
            class="kalkulasi-box text-2xl font-bold text-center text-blue-800 mb-6"
        >
            Kalkulasi Sewa
        </h2>

        <div
            class="kalkulasi-box bg-blue-50 rounded-xl shadow-lg p-8 flex flex-col gap-8 md:flex-row justify-between items-center"
        >
            <!-- Kolom Kiri -->
            <div class="flex-1 w-full space-y-4">
                <!-- Pilih Area -->
                <div class="flex justify-between items-center">
                    <p class="font-semibold text-gray-800">Pilih Area</p>
                    <select
                        v-model="selectedLabel"
                        @change="hitungBiaya"
                        class="border rounded-md px-3 py-1 text-gray-700 bg-white focus:outline-none"
                    >
                        <option
                            v-for="(harga, index) in priceOptions"
                            :key="index"
                            :value="harga.label"
                        >
                            {{ harga.label }}
                        </option>
                    </select>
                </div>

                <!-- Harga per Hari -->
                <div class="flex justify-between items-center">
                    <p class="font-semibold text-gray-800">Harga per Hari</p>
                    <p class="text-gray-700 font-medium">
                        {{ formatCurrency(selectedPrice.value) }}
                        <span class="text-sm text-gray-500">
                            ({{ selectedLabel }})
                        </span>
                    </p>
                </div>

                <!-- Jumlah Hari -->
                <div class="flex justify-between items-center">
                    <p class="font-semibold text-gray-800">Jumlah Hari</p>
                    <div class="flex items-center gap-3">
                        <button
                            @click="kurangiHari"
                            class="cursor-pointer w-8 h-8 flex justify-center items-center rounded-full bg-white shadow text-gray-600 hover:bg-gray-100"
                        >
                            −
                        </button>
                        <span class="text-lg font-semibold">
                            {{ jumlahHari }}
                        </span>
                        <button
                            @click="tambahHari"
                            class="cursor-pointer w-8 h-8 flex justify-center items-center rounded-full bg-white shadow text-gray-600 hover:bg-gray-100"
                        >
                            +
                        </button>
                    </div>
                </div>

                <!-- Total Biaya -->
                <div class="flex justify-between items-center">
                    <p class="font-semibold text-gray-800">Total Biaya</p>
                    <input
                        type="text"
                        class="bg-white rounded-md px-4 py-2 text-right w-40"
                        :value="formatCurrency(totalBiaya)"
                        readonly
                    />
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="flex flex-col items-center md:items-start space-y-2">
                <button
                    @click="hitungBiaya"
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-2 rounded-lg transition"
                >
                    Hitung Biaya
                </button>
                <p class="text-xs text-gray-500">
                    * Estimasi, biaya final sesuai invoice dari admin
                </p>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

const props = defineProps({
    cars: Object,
});

onMounted(() => {
    gsap.from(".kalkulasi-box", {
        opacity: 0,
        scale: 0.9,
        duration: 0.8,
        ease: "power3.out",
        scrollTrigger: {
            trigger: ".kalkulasi-box",
            start: "top 90%",
            toggleActions: "restart none none reset",
        },
    });
});

// === Harga dari backend ===
const priceOptions = computed(() => [
    { label: "Area Solo", value: props.cars.rental_price?.harga_solo ?? 0 },
    {
        label: "Solo Raya",
        value: props.cars.rental_price?.harga_solo_raya ?? 0,
    },
    {
        label: "Luar Kota",
        value: props.cars.rental_price?.harga_luar_kota ?? 0,
    },
]);

// === Default area pertama ===
const selectedLabel = ref(priceOptions.value[0].label);

// === Harga sesuai label ===
const selectedPrice = computed(() => {
    return (
        priceOptions.value.find((p) => p.label === selectedLabel.value) || {
            value: 0,
        }
    );
});

// === Jumlah hari & total biaya ===
const jumlahHari = ref(1);
const totalBiaya = ref(0);

// Hitung biaya
const hitungBiaya = () => {
    totalBiaya.value = selectedPrice.value.value * jumlahHari.value;
};

// Tambah / kurang hari
const tambahHari = () => jumlahHari.value++;
const kurangiHari = () => {
    if (jumlahHari.value > 1) jumlahHari.value--;
};

// Format currency
const formatCurrency = (number) =>
    new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(number);
</script>
