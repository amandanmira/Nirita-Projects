<template>
    <section class="max-w-4xl mx-auto my-9 px-6">
        <h2 class="text-2xl font-bold text-center text-blue-800 mb-6">
            Kalkulasi Sewa
        </h2>

        <div
            class="bg-blue-50 rounded-xl shadow-lg p-8 flex flex-col gap-8 md:flex-row justify-between items-start md:items-center"
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
                            v-for="(harga, index) in mobil.price"
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
                        <span class="text-lg font-semibold">{{
                            jumlahHari
                        }}</span>
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
                        class="bg-white rounded-md px-4 py-2 border text-right w-40"
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
import { ref, computed } from "vue";
import mobilData from "../data/cars2.js";

const mobilId = parseInt(window.location.pathname.split("/").pop());
const mobil = mobilData.find((m) => m.id === mobilId);

const jumlahHari = ref(1);
const selectedLabel = ref(mobil.price[0].label); // default area pertama
const totalBiaya = ref(0);

// Ambil harga berdasarkan label yang dipilih
const selectedPrice = computed(() => {
    return mobil.price.find((p) => p.label === selectedLabel.value);
});

// Fungsi hitung total biaya
const hitungBiaya = () => {
    totalBiaya.value = selectedPrice.value.value * jumlahHari.value;
};

// Tambah/Kurang hari
const tambahHari = () => {
    jumlahHari.value++;
    // hitungBiaya();
};

const kurangiHari = () => {
    if (jumlahHari.value > 1) {
        jumlahHari.value--;
        // hitungBiaya();
    }
};

// Format rupiah
const formatCurrency = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(number);
};

// Jalankan perhitungan awal
// hitungBiaya();
</script>
