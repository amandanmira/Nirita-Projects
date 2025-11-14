<template>
    <DashLayouts>
        <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl p-10 mt-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 border-b pb-4">
                🚗 Tambah Mobil Baru
            </h1>

            <form
                @submit.prevent="submit"
                enctype="multipart/form-data"
                class="space-y-10"
            >
                <!-- === INFORMASI MOBIL === -->
                <section>
                    <h2
                        class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-2"
                    >
                        Informasi Mobil
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium mb-2"
                                >Nama Mobil</label
                            >
                            <input
                                v-model="form.nama_mobil"
                                type="text"
                                placeholder="Contoh: Avanza 2021"
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                            <p
                                v-if="form.errors.nama_mobil"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.nama_mobil }}
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium mb-2"
                                >Plat Nomor</label
                            >
                            <input
                                v-model="form.plat_nomor"
                                type="text"
                                placeholder="AB 1234 CD"
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                            <p
                                v-if="form.errors.plat_nomor"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.plat_nomor }}
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium mb-2"
                                >Ketersediaan</label
                            >
                            <input
                                v-model="form.ketersediaan"
                                type="number"
                                min="1"
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                            <p
                                v-if="form.errors.ketersediaan"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.ketersediaan }}
                            </p>
                        </div>

                        <!-- Upload Gambar -->
                        <div>
                            <label class="block font-medium mb-2"
                                >Upload Gambar</label
                            >
                            <button
                                type="button"
                                @click="addGambar"
                                class="bg-gray-100 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-200 transition font-medium mb-3"
                            >
                                + Tambah Gambar
                            </button>

                            <div class="space-y-3">
                                <div
                                    v-for="(
                                        gambar, index
                                    ) in form.url_foto_mobil"
                                    :key="index"
                                    class="flex items-center gap-3"
                                >
                                    <input
                                        type="file"
                                        class="border rounded-lg p-2 w-full"
                                        @change="
                                            handleFileChange($event, index)
                                        "
                                        required
                                    />
                                    <button
                                        type="button"
                                        @click="removeGambar(index)"
                                        class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- === SPESIFIKASI === -->
                <section>
                    <h2
                        class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-2"
                    >
                        Spesifikasi Mobil
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium mb-2"
                                >Kapasitas (Penumpang)</label
                            >
                            <input
                                v-model="form.kapasitas"
                                type="number"
                                placeholder="4"
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                            <p
                                v-if="form.errors.kapasitas"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.kapasitas }}
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium mb-2"
                                >Kategori</label
                            >
                            <select
                                v-model="form.kategori"
                                class="border rounded-md p-2 w-full"
                            >
                                <option value="">-- Pilih Kategori --</option>
                                <option value="MPV">MPV</option>
                                <option value="SUV">SUV</option>
                                <option value="Large SUV">Large SUV</option>
                                <option value="MPV Luxury">MPV Luxury</option>
                                <option value="MiniBus">MiniBus</option>
                                <option value="Luxury Minibus">
                                    Luxury Minibus
                                </option>
                            </select>
                            <p
                                v-if="form.errors.kategori"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.kategori }}
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium mb-2"
                                >Jenis Transmisi</label
                            >
                            <input
                                v-model="form.jenis_transmisi"
                                type="text"
                                placeholder="Manual / Automatic"
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                            <p
                                v-if="form.errors.jenis_transmisi"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.jenis_transmisi }}
                            </p>
                        </div>

                        <!-- Fasilitas -->
                        <div>
                            <label class="block font-medium mb-2"
                                >Fasilitas</label
                            >
                            <button
                                type="button"
                                @click="addFasilitas"
                                class="bg-gray-100 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-200 transition font-medium mb-3"
                            >
                                + Tambah Fasilitas
                            </button>

                            <div class="space-y-2">
                                <div
                                    v-for="(item, index) in form.fasilitas"
                                    :key="index"
                                    class="flex items-center gap-3"
                                >
                                    <input
                                        type="text"
                                        v-model="form.fasilitas[index]"
                                        placeholder="Contoh: AC, Bluetooth, Kamera Belakang"
                                        class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                    />
                                    <button
                                        type="button"
                                        @click="removeFasilitas(index)"
                                        class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </div>
                            <p
                                v-if="form.errors.fasilitas"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.fasilitas }}
                            </p>
                        </div>
                    </div>
                </section>

                <!-- === HARGA SEWA === -->
                <section>
                    <h2
                        class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-2"
                    >
                        Harga Sewa
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block font-medium mb-2"
                                >Harga Solo</label
                            >
                            <input
                                v-model="form.harga_solo"
                                type="number"
                                placeholder="Rp"
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                            <p
                                v-if="form.errors.harga_solo"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.harga_solo }}
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium mb-2"
                                >Harga Solo Raya</label
                            >
                            <input
                                v-model="form.harga_solo_raya"
                                type="number"
                                placeholder="Rp"
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                            <p
                                v-if="form.errors.harga_solo_raya"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.harga_solo_raya }}
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium mb-2"
                                >Harga Luar Kota</label
                            >
                            <input
                                v-model="form.harga_luar_kota"
                                type="number"
                                placeholder="Rp"
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                            <p
                                v-if="form.errors.harga_luar_kota"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.harga_luar_kota }}
                            </p>
                        </div>
                    </div>
                </section>

                <!-- === BUTTON === -->
                <div class="flex justify-end mt-10 gap-4">
                    <Link
                        href="/admin/mobil"
                        class="bg-gray-100 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-200 transition font-medium"
                    >
                        Kembali
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium shadow-md"
                    >
                        {{ form.processing ? "Menyimpan..." : "Simpan Mobil" }}
                    </button>
                </div>
            </form>
        </div>
    </DashLayouts>
</template>

<script setup>
import DashLayouts from "../../Layouts/DashboardLayouts.vue";
import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    nama_mobil: "",
    plat_nomor: "",
    ketersediaan: 1,
    url_foto_mobil: [],
    kapasitas: "",
    kategori: "",
    fasilitas: [""],
    jenis_transmisi: "",
    harga_solo: "",
    harga_solo_raya: "",
    harga_luar_kota: "",
});

const addGambar = () => form.url_foto_mobil.push(null);
const removeGambar = (index) => form.url_foto_mobil.splice(index, 1);
const handleFileChange = (event, index) => {
    const file = event.target.files[0];
    form.url_foto_mobil[index] = file;
};

const addFasilitas = () => form.fasilitas.push("");
const removeFasilitas = (index) => form.fasilitas.splice(index, 1);

const submit = () => {
    form.post("/admin/mobil", {
        forceFormData: true,
    });
};
</script>
