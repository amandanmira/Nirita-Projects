<template>
    <DashLayout>
        <div class="max-w-5xl mx-auto bg-white shadow p-8 rounded-lg">
            <h1 class="text-3xl font-bold mb-6">Edit Invoice</h1>

            <form @submit.prevent="submitForm" class="space-y-6">
                <!-- Nama Penyewa -->
                <div>
                    <label class="font-semibold">Nama Penyewa</label>
                    <input
                        type="text"
                        v-model="form.nama_penyewa"
                        class="w-full border rounded p-2"
                    />
                    <p class="text-red-500 text-sm" v-if="errors.nama_penyewa">
                        {{ errors.nama_penyewa }}
                    </p>
                </div>

                <!-- No HP -->
                <div>
                    <label class="font-semibold">No HP Penyewa</label>
                    <input
                        type="text"
                        v-model="form.no_hp_penyewa"
                        class="w-full border rounded p-2"
                    />
                    <p class="text-red-500 text-sm" v-if="errors.no_hp_penyewa">
                        {{ errors.no_hp_penyewa }}
                    </p>
                </div>

                <!-- Driver -->
                <div>
                    <label class="font-semibold">Nama Driver</label>
                    <input
                        type="text"
                        v-model="form.driver"
                        class="w-full border rounded p-2"
                    />
                    <p class="text-red-500 text-sm" v-if="errors.driver">
                        {{ errors.driver }}
                    </p>
                </div>

                <div>
                    <label class="font-semibold">Alamat Invoice</label>
                    <input
                        type="text"
                        v-model="form.lokasi_invoice"
                        class="w-full border rounded p-2"
                    />
                    <p
                        class="text-red-500 text-sm"
                        v-if="errors.lokasi_invoice"
                    >
                        {{ errors.lokasi_invoice }}
                    </p>
                </div>

                <div>
                    <label class="font-semibold">Tanggal Invoice</label>
                    <input
                        type="date"
                        v-model="form.tanggal_invoice"
                        class="w-full border rounded p-2"
                    />
                    <p
                        class="text-red-500 text-sm"
                        v-if="errors.tanggal_invoice"
                    >
                        {{ errors.tanggal_invoice }}
                    </p>
                </div>

                <!-- Total Pembayaran -->
                <div>
                    <label class="font-semibold">Total Pembayaran</label>
                    <input
                        type="number"
                        v-model="form.total_pembayaran"
                        class="w-full border rounded p-2"
                    />
                    <p
                        class="text-red-500 text-sm"
                        v-if="errors.total_pembayaran"
                    >
                        {{ errors.total_pembayaran }}
                    </p>
                </div>

                <!-- Detail Sewa -->
                <div>
                    <h2 class="text-xl font-bold mb-3">Detail Sewa</h2>

                    <div
                        v-for="(d, i) in form.detail"
                        :key="i"
                        class="border p-4 rounded mb-4"
                    >
                        <div class="flex justify-between mb-3">
                            <h3 class="font-semibold">Mobil {{ i + 1 }}</h3>
                            <button
                                type="button"
                                class="text-red-600"
                                @click="removeDetail(i)"
                                v-if="form.detail.length > 1"
                            >
                                Hapus
                            </button>
                        </div>

                        <!-- Mobil -->
                        <div class="mb-3">
                            <label class="font-semibold">Mobil</label>
                            <select
                                v-model="d.id_mobil"
                                class="w-full border rounded p-2"
                                @change="updatePrice(i)"
                            >
                                <option value="">-- pilih mobil --</option>
                                <option
                                    v-for="m in cars"
                                    :value="m.id_mobil"
                                    :key="m.id_mobil"
                                >
                                    {{ m.nama_mobil }}
                                </option>
                            </select>
                            <p
                                class="text-red-500 text-sm"
                                v-if="errors[`detail.${i}.id_mobil`]"
                            >
                                {{ errors[`detail.${i}.id_mobil`] }}
                            </p>
                        </div>

                        <!-- Lokasi Sewa -->
                        <div class="mb-3">
                            <label class="font-semibold">Lokasi Sewa</label>
                            <select
                                v-model="d.lokasi_sewa"
                                class="w-full border rounded p-2"
                                @change="updatePrice(i)"
                            >
                                <option value="">-- pilih lokasi --</option>
                                <option value="solo">Solo</option>
                                <option value="solo_raya">Solo Raya</option>
                                <option value="luar_kota">Luar Kota</option>
                            </select>
                            <p
                                class="text-red-500 text-sm"
                                v-if="errors[`detail.${i}.lokasi_sewa`]"
                            >
                                {{ errors[`detail.${i}.lokasi_sewa`] }}
                            </p>
                        </div>

                        <!-- Tanggal Sewa -->
                        <div class="mb-3">
                            <label class="font-semibold"
                                >Tanggal Mulai Sewa</label
                            >
                            <input
                                type="date"
                                v-model="d.tanggal_sewa"
                                @change="updatePrice(i)"
                                class="w-full border rounded p-2"
                            />
                            <p
                                class="text-red-500 text-sm"
                                v-if="errors[`detail.${i}.tanggal_sewa`]"
                            >
                                {{ errors[`detail.${i}.tanggal_sewa`] }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="font-semibold"
                                >Tanggal Akhir Sewa</label
                            >
                            <input
                                type="date"
                                v-model="d.tanggal_akhir_sewa"
                                @change="updatePrice(i)"
                                class="w-full border rounded p-2"
                            />
                            <p
                                class="text-red-500 text-sm"
                                v-if="errors[`detail.${i}.tanggal_sewa`]"
                            >
                                {{ errors[`detail.${i}.tanggal_akhir_sewa`] }}
                            </p>
                        </div>

                        <!-- Harga otomatis -->
                        <div class="mt-2 text-sm text-green-700 font-semibold">
                            Harga: {{ formatCurrency(d.harga_terpilih) }}
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="font-semibold"
                                >Deskripsi Kegiatan</label
                            >
                            <textarea
                                v-model="d.deskripsi_kegiatan"
                                class="w-full border rounded p-2"
                            ></textarea>
                        </div>
                    </div>

                    <button
                        type="button"
                        class="px-4 py-2 bg-green-600 text-white rounded"
                        @click="addDetail"
                    >
                        + Tambah Mobil
                    </button>
                </div>

                <div class="flex gap-4 items-center">
                    <!-- Kembali -->
                    <Link
                        href="/admin/invoice"
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition"
                    >
                        Batal
                    </Link>

                    <!-- Submit -->
                    <button
                        type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </DashLayout>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import DashLayout from "../../Layouts/DashboardLayouts.vue";

const props = defineProps({
    bill: Object,
    cars: Array,
    errors: Object,
});

const getDays = (tglSewa, tglAkhirSewa) => {
    if (!tglSewa || !tglAkhirSewa) return 0;

    const s = new Date(tglSewa);
    const e = new Date(tglAkhirSewa);

    const diff = e - s;
    return Math.ceil(diff / (1000 * 60 * 60 * 24)) + 1;
};

// helper: get price from cars list
const getPrice = (carId, location, tglSewa, tglAkhirSewa) => {
    const car = props.cars.find((c) => c.id_mobil == carId);
    const waktuSewa = getDays(tglSewa, tglAkhirSewa);

    if (!car || !location || waktuSewa < 0) return 0;

    const rp = car.rental_price || car.rentalPrice || {};
    const priceMap = {
        solo: rp.harga_solo ?? 0,
        solo_raya: rp.harga_solo_raya ?? 0,
        luar_kota: rp.harga_luar_kota ?? 0,
    };

    return (priceMap[location] ?? 0) * waktuSewa;
};

// Mapping awal data (include harga_terpilih)
const form = useForm({
    nama_penyewa: props.bill.nama_penyewa,
    no_hp_penyewa: props.bill.no_hp_penyewa,
    driver: props.bill.driver,
    lokasi_invoice: props.bill.lokasi_invoice,
    tanggal_invoice: props.bill.tanggal_invoice,
    total_pembayaran: props.bill.total_pembayaran,
    detail: props.bill.bill_details.map((d) => ({
        id: d.id,
        id_mobil: d.id_mobil,
        lokasi_sewa: d.lokasi_sewa,
        tanggal_sewa: d.tanggal_sewa,
        tanggal_akhir_sewa: d.tanggal_akhir_sewa,
        deskripsi_kegiatan: d.deskripsi_kegiatan,
        harga_terpilih: getPrice(
            d.id_mobil,
            d.lokasi_sewa,
            d.tanggal_sewa,
            d.tanggal_akhir_sewa
        ),
    })),
});

// Tambah row detail
const addDetail = () => {
    form.detail.push({
        id: null,
        id_mobil: "",
        lokasi_sewa: "",
        tanggal_sewa: "",
        tanggal_akhir_sewa: "",
        deskripsi_kegiatan: "",
        harga_terpilih: 0,
    });
};

// Hapus row detail
const removeDetail = (index) => {
    form.detail.splice(index, 1);
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

    form.total_pembayaran = totalHarga;
};

// Hitung total semua harga
const totalHarga = computed(() =>
    form.detail.reduce((sum, item) => sum + Number(item.harga_terpilih || 0), 0)
);

// Format rupiah helper
const formatCurrency = (val) => {
    const n = Number(val || 0);
    if (Number.isNaN(n)) return "Rp 0";
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0,
    }).format(n);
};

// Submit ke server
const submitForm = () => {
    form.total_pembayaran = totalHarga.value;

    form.put(`/admin/invoice/${props.bill.id_nota}`, {
        preserveScroll: true,
        onSuccess: () => {
            console.log("Update berhasil:", form);
            alert("Invoice berhasil diperbarui!");
        },
        onError: (errors) => {
            console.error("Error saat update:", errors);
        },
    });
};
</script>
