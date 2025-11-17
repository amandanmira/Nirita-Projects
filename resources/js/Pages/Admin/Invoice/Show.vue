<template>
    <DashLayout>
        <div class="max-w-5xl mx-auto p-6">
            <h1 class="text-3xl font-bold mb-4">Detail Invoice</h1>

            <div class="flex gap-3 mb-6">
                <Link
                    href="/admin/invoice"
                    class="px-4 py-2 bg-gray-600 text-white rounded"
                >
                    Kembali
                </Link>

                <a
                    :href="`/admin/invoice/${bill.id_nota}/pdf`"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg"
                >
                    Cetak Invoice
                </a>
            </div>

            <div class="bg-white shadow rounded p-6">
                <table class="w-full border-collapse">
                    <tbody>
                        <!-- DETAIL SEWA -->
                        <tr>
                            <td class="font-semibold w-56 align-top">
                                Detail Sewa
                            </td>
                            <td class="w-5 align-top">:</td>
                            <td>
                                <div
                                    v-for="(d, i) in bill.bill_details"
                                    :key="i"
                                    class="mb-6"
                                >
                                    <img
                                        :src="`/storage/${
                                            JSON.parse(d.cars.url_foto_mobil)[0]
                                        }`"
                                        class="h-28 rounded shadow"
                                    />

                                    <ul class="mt-2 space-y-1">
                                        <li>
                                            <strong
                                                >Mobil Yang Dipinjam :</strong
                                            >
                                            {{ d.cars.nama_mobil }}
                                        </li>
                                        <li>
                                            <strong>Lokasi Sewa :</strong>
                                            {{ mapLokasi(d.lokasi_sewa) }}
                                        </li>
                                        <li>
                                            <strong>Harga Sewa :</strong>
                                            Rp
                                            {{
                                                hargaSewa(d).toLocaleString(
                                                    "id-ID"
                                                )
                                            }}
                                        </li>
                                        <li>
                                            <strong>Tanggal Sewa :</strong>
                                            {{ d.tanggal_sewa }}
                                        </li>
                                        <li>
                                            <strong>Deskripsi :</strong>
                                            {{ d.deskripsi_kegiatan ?? "-" }}
                                        </li>
                                    </ul>

                                    <hr class="my-4" />
                                </div>
                            </td>
                        </tr>

                        <!-- NAMA PENYEWA -->
                        <tr>
                            <td class="font-semibold">Nama Penyewa</td>
                            <td>:</td>
                            <td>{{ bill.nama_penyewa }}</td>
                        </tr>

                        <!-- NO HP -->
                        <tr>
                            <td class="font-semibold">No HP Penyewa</td>
                            <td>:</td>
                            <td>{{ bill.no_hp_penyewa }}</td>
                        </tr>

                        <!-- DRIVER -->
                        <tr>
                            <td class="font-semibold">Nama Driver</td>
                            <td>:</td>
                            <td>{{ bill.driver }}</td>
                        </tr>

                        <!-- TOTAL -->
                        <tr>
                            <td class="font-semibold">Total Pembayaran</td>
                            <td>:</td>
                            <td>
                                Rp
                                {{
                                    bill.total_pembayaran.toLocaleString(
                                        "id-ID"
                                    )
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </DashLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import DashLayout from "../../Layouts/DashboardLayouts.vue";

const props = defineProps({
    bill: Object,
});

// const printPdf = () => {
//     window.open(`/invoice/${props.bill.id_nota}/pdf`, "_blank");
// };

// Map lokasi (sama seperti Blade)
const mapLokasi = (lokasi) => {
    return {
        solo: "Solo",
        solo_raya: "Solo Raya",
        luar_kota: "Luar Kota",
    }[lokasi];
};

// Hitung harga sewa sesuai lokasi
const hargaSewa = (d) => {
    const rp = d.cars.rental_price;

    return {
        solo: rp.harga_solo,
        solo_raya: rp.harga_solo_raya,
        luar_kota: rp.harga_luar_kota,
    }[d.lokasi_sewa];
};
</script>

<style scoped>
table td {
    padding: 8px 4px;
}
</style>
