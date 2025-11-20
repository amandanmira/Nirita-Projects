<template>
    <DashLayouts>
        <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl p-10 mt-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 border-b pb-4">
                ✏️ Edit Data Mobil
            </h1>

            <form
                @submit.prevent="updateMobil"
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
                                >Upload Gambar Baru</label
                            >
                            <button
                                type="button"
                                @click="addGambar"
                                class="bg-gray-100 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-200 transition font-medium mb-3"
                            >
                                + Tambah Gambar
                            </button>

                            <!-- Foto lama -->
                            <div class="flex flex-wrap gap-4 mb-3">
                                <img
                                    v-for="(foto, index) in parsedFotoLama"
                                    :key="index"
                                    :src="getImageUrl(foto)"
                                    class="w-32 h-24 object-cover rounded-lg shadow"
                                />
                            </div>

                            <!-- Input gambar baru -->
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
                                >Kapasitas</label
                            >
                            <input
                                v-model="form.kapasitas"
                                type="number"
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
                        </div>

                        <div>
                            <label class="block font-medium mb-2"
                                >Jenis Transmisi</label
                            >
                            <input
                                v-model="form.jenis_transmisi"
                                type="text"
                                placeholder="Manual / Matic"
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                        </div>

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
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                        </div>

                        <div>
                            <label class="block font-medium mb-2"
                                >Harga Solo Raya</label
                            >
                            <input
                                v-model="form.harga_solo_raya"
                                type="number"
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                        </div>

                        <div>
                            <label class="block font-medium mb-2"
                                >Harga Luar Kota</label
                            >
                            <input
                                v-model="form.harga_luar_kota"
                                type="number"
                                class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
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
                        {{
                            form.processing
                                ? "Menyimpan..."
                                : "Simpan Perubahan"
                        }}
                    </button>
                </div>
            </form>
        </div>
    </DashLayouts>
</template>

<script setup>
import DashLayouts from "../../Layouts/DashboardLayouts.vue";
import { useForm, Link, router } from "@inertiajs/vue3";

const props = defineProps({
    mobil: Object,
});

// Foto lama (string JSON dari database)
const parsedFotoLama = JSON.parse(props.mobil.url_foto_mobil || "[]");

// form data
const form = useForm({
    nama_mobil: props.mobil.nama_mobil || "",
    ketersediaan: props.mobil.ketersediaan || 1,
    old_photos: props.mobil.foto_mobil || [], // foto lama (dari DB)
    deleted_photos: [], // untuk mencatat foto lama yang ingin dihapus
    new_photos: [], // file baru yang di-upload
    kapasitas: props.mobil.specification?.kapasitas || "",
    kategori: props.mobil.specification?.kategori || "",
    fasilitas: JSON.parse(props.mobil.specification?.fasilitas || "[]"),
    jenis_transmisi: props.mobil.specification?.jenis_transmisi || "",
    harga_solo: props.mobil.rental_price?.harga_solo || "",
    harga_solo_raya: props.mobil.rental_price?.harga_solo_raya || "",
    harga_luar_kota: props.mobil.rental_price?.harga_luar_kota || "",
});

const addGambar = () => form.url_foto_mobil.push(null);
const removeGambar = (index) => form.url_foto_mobil.splice(index, 1);
const handleFileChange = (event, index) => {
    const file = event.target.files[0];
    form.url_foto_mobil[index] = file;
};

const addFasilitas = () => form.fasilitas.push("");
const removeFasilitas = (index) => form.fasilitas.splice(index, 1);

const updateMobil = () => {
    const dataKirim = new FormData();
    for (const key in form) {
        if (key === "url_foto_mobil") {
            form.url_foto_mobil.forEach((file) =>
                dataKirim.append("url_foto_mobil[]", file)
            );
        } else if (key === "fasilitas") {
            form.fasilitas.forEach((item, i) =>
                dataKirim.append(`fasilitas[${i}]`, item)
            );
        } else {
            dataKirim.append(key, form[key]);
        }
    }
    dataKirim.append("_method", "PUT");

    router.post(`/admin/mobil/${props.mobil.id_mobil}`, dataKirim, {
        forceFormData: true,
        onSuccess: () => alert("✅ Data mobil berhasil diperbarui!"),
        onError: (err) => console.error("❌ Error:", err),
    });
};

const getImageUrl = (path) => {
    return path.startsWith("storage") ? `/${path}` : `/storage/${path}`;
};
</script>
