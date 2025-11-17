<template>
    <DashLayout>
        <div class="max-w-5xl mx-auto p-6">
            <div class="bg-white shadow-md rounded-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">
                        Tambah Invoice Baru
                    </h2>
                    <div class="text-sm text-gray-500">
                        Isi detail penyewa dan mobil yang disewa
                    </div>
                </div>

                <!-- FORM -->
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- =======================
                DETAIL MOBIL
                ========================== -->
                    <div>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-700">
                                Detail Mobil
                            </h3>
                            <button
                                type="button"
                                @click="addRow"
                                class="inline-flex items-center gap-2 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4v16m8-8H4"
                                    />
                                </svg>
                                Tambah Mobil
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div
                                v-for="(item, i) in form.detail"
                                :key="i"
                                class="border border-gray-100 rounded-xl p-4 bg-gray-50 shadow-sm"
                            >
                                <div
                                    class="grid grid-cols-1 md:grid-cols-3 gap-4"
                                >
                                    <div class="md:col-span-1">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            >Mobil</label
                                        >
                                        <select
                                            v-model="item.id_mobil"
                                            @change="updatePrice(i)"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required
                                        >
                                            <option value="">
                                                -- Pilih Mobil --
                                            </option>
                                            <option
                                                v-for="c in props.cars"
                                                :value="c.id_mobil"
                                                :key="c.id_mobil"
                                            >
                                                {{ c.nama_mobil }} ({{
                                                    c.plat_nomor
                                                }})
                                            </option>
                                        </select>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            >Lokasi</label
                                        >
                                        <select
                                            v-model="item.lokasi_sewa"
                                            @change="updatePrice(i)"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required
                                        >
                                            <option value="">
                                                -- Pilih Lokasi --
                                            </option>
                                            <option value="solo">Solo</option>
                                            <option value="solo_raya">
                                                Solo Raya
                                            </option>
                                            <option value="luar_kota">
                                                Luar Kota
                                            </option>
                                        </select>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            >Tanggal Mulai Sewa</label
                                        >
                                        <input
                                            type="date"
                                            v-model="item.tanggal_sewa"
                                            @change="updatePrice(i)"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required
                                        />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            >Tanggal Akhir Sewa</label
                                        >
                                        <input
                                            type="date"
                                            v-model="item.tanggal_akhir_sewa"
                                            @change="updatePrice(i)"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required
                                        />
                                    </div>
                                </div>

                                <div
                                    class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4"
                                >
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            >Deskripsi Kegiatan</label
                                        >
                                        <textarea
                                            v-model="item.deskripsi_kegiatan"
                                            rows="2"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                        ></textarea>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            >Harga Terpilih</label
                                        >
                                        <p
                                            class="mt-1 text-lg font-semibold text-blue-700"
                                        >
                                            {{
                                                formatCurrency(
                                                    item.harga_terpilih
                                                )
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-end">
                                    <button
                                        v-if="form.detail.length > 1"
                                        type="button"
                                        @click="removeRow(i)"
                                        class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TOTAL -->
                    <div
                        class="mt-4 p-4 bg-gradient-to-r from-green-50 to-white border border-green-100 rounded-lg flex items-center justify-between"
                    >
                        <div>
                            <div class="text-sm text-gray-600">
                                Total Pembayaran
                            </div>
                            <div class="text-2xl font-bold text-green-700">
                                {{ formatCurrency(totalHarga) }}
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            (Semua harga sudah termasuk biaya dasar)
                        </div>
                    </div>

                    <!-- =======================
                FORM PENYEWA
            ========================== -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Nama Penyewa</label
                            >
                            <input
                                type="text"
                                v-model="form.nama_penyewa"
                                class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required
                            />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >No HP Penyewa</label
                            >
                            <input
                                type="tel"
                                v-model="form.no_hp_penyewa"
                                class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required
                            />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Nama Driver</label
                            >
                            <input
                                type="text"
                                v-model="form.driver"
                                class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required
                            />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Alamat Invoice</label
                            >
                            <input
                                type="text"
                                v-model="form.lokasi_invoice"
                                class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Tanggal Invoice</label
                            >
                            <input
                                type="date"
                                v-model="form.tanggal_invoice"
                                class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <div class="mt-6 flex items-center gap-3">
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                            Simpan
                        </button>

                        <Link
                            :href="`/admin/invoice`"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition"
                        >
                            Kembali
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </DashLayout>
</template>

<script setup>
import DashLayout from "../../Layouts/DashboardLayouts.vue";
import { ref, reactive, computed } from "vue";
import { useForm, usePage, Link } from "@inertiajs/vue3";

const props = defineProps({
    cars: Array, // Dikirim dari controller
});

// ---------------------------
// FORM UTAMA
// ---------------------------
const form = useForm({
    nama_penyewa: "",
    no_hp_penyewa: "",
    driver: "",
    lokasi_invoice: "",
    tanggal_invoice: "",
    total_pembayaran: 0,
    detail: [
        {
            id_mobil: "",
            lokasi_sewa: "",
            tanggal_sewa: "",
            tanggal_akhir_sewa: "",
            deskripsi_kegiatan: "",
            harga_terpilih: 0,
        },
    ],
});

// Tambah row mobil
const addRow = () => {
    form.detail.push({
        id_mobil: "",
        lokasi_sewa: "",
        tanggal_sewa: "",
        tanggal_akhir_sewa: "",
        deskripsi_kegiatan: "",
        harga_terpilih: 0,
    });
};

// Hapus row
const removeRow = (index) => {
    form.detail.splice(index, 1);
};

const getDays = (tglSewa, tglAkhirSewa) => {
    if (!tglSewa || !tglAkhirSewa) return 0;

    const s = new Date(tglSewa);
    const e = new Date(tglAkhirSewa);

    const diff = e - s;
    return Math.ceil(diff / (1000 * 60 * 60 * 24)) + 1;
};

// ---------------------------
// Hitung harga berdasarkan pilihan
// ---------------------------
const getPrice = (carId, location, tglSewa, tglAkhirSewa) => {
    const car = props.cars.find((c) => c.id_mobil == carId);
    const waktuSewa = getDays(tglSewa, tglAkhirSewa);

    if (!car || !location || waktuSewa < 0) return 0;

    const priceMap = {
        solo: car.rental_price.harga_solo,
        solo_raya: car.rental_price.harga_solo_raya,
        luar_kota: car.rental_price.harga_luar_kota,
    };

    return (priceMap[location] ?? 0) * waktuSewa;
};

// Update harga setiap kali pilihan berubah
const updatePrice = (index) => {
    const row = form.detail[index];
    row.harga_terpilih = getPrice(
        row.id_mobil,
        row.lokasi_sewa,
        row.tanggal_sewa,
        row.tanggal_akhir_sewa
    );
};

// ---------------------------
// Hitung total semua harga
// ---------------------------
const totalHarga = computed(() =>
    form.detail.reduce((sum, item) => sum + Number(item.harga_terpilih), 0)
);

// Format currency helper for display
const formatCurrency = (val) => {
    // unwrap ref if passed
    const value =
        val && typeof val === "object" && "value" in val ? val.value : val;
    const n = Number(value || 0);
    if (Number.isNaN(n)) return "Rp 0";
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0,
    }).format(n);
};

// Submit form
const submit = () => {
    form.total_pembayaran = totalHarga.value;

    form.post("/admin/invoice", {
        forceFormData: true,
        onError: (errors) => {
            console.log(errors); // Debug jika gagal
        },
        onSuccess: () => {
            alert("Invoice berhasil disimpan!");
        },
    });
};
</script>

<style scoped>
/* .form-control {
    @apply border rounded p-2;
} */
</style>
