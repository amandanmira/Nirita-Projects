<template>
    <DashLayouts>
        <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl p-10 mt-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 border-b pb-4">
                ✏️ Edit Data Mobil
            </h1>

            <form @submit.prevent="updateMobil" class="space-y-10">
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

                        <div class="md:col-span-2">
                            <label class="block font-medium mb-2"
                                >Upload Gambar</label
                            >

                            <h3 class="text-lg font-medium mb-2 text-gray-700">
                                Foto Lama
                            </h3>
                            <div class="flex flex-wrap gap-4 mb-5">
                                <div
                                    v-for="(fotoPath, index) in parsedFotoLama"
                                    :key="index"
                                    class="relative"
                                >
                                    <img
                                        :src="getImageUrl(fotoPath)"
                                        class="w-32 h-24 object-cover rounded-lg shadow border"
                                    />
                                    <button
                                        type="button"
                                        @click="removeOldPhoto(fotoPath)"
                                        class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-700 transition"
                                        title="Hapus foto ini"
                                    >
                                        &times;
                                    </button>
                                </div>
                                <p
                                    v-if="parsedFotoLama.length === 0"
                                    class="text-gray-500 italic"
                                >
                                    Tidak ada foto lama yang tersisa.
                                </p>
                            </div>

                            <h3 class="text-lg font-medium mb-2 text-gray-700">
                                Tambah Foto Baru
                            </h3>
                            <button
                                type="button"
                                @click="addNewPhotoInput"
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition font-medium mb-3"
                            >
                                + Tambah Gambar Baru
                            </button>

                            <div class="space-y-3">
                                <div
                                    v-for="(
                                        fileWrapper, index
                                    ) in form.new_photos"
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
                                        @click="removeNewPhotoInput(index)"
                                        class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

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
                                min="1"
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
                                class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"
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
import { useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";
// Menggunakan 'router' tidak lagi diperlukan jika menggunakan form.put

const props = defineProps({
    mobil: Object,
});

// 1. Parsing Foto Lama (mengambil data dari DB)
const initialFotoLama = JSON.parse(props.mobil.url_foto_mobil || "[]");
// Variabel reaktif untuk menampilkan foto lama yang belum dihapus oleh user
const parsedFotoLama = ref(initialFotoLama);

// 2. Form data Inertia.js
const form = useForm({
    _method: "PUT", // Penting: Method spoofing untuk update
    nama_mobil: props.mobil.nama_mobil || "",
    ketersediaan: props.mobil.ketersediaan || 1,

    // Foto Handling:
    deleted_photos: [], // Array untuk menyimpan path foto lama yang ingin dihapus
    // new_photos adalah array of File objects
    new_photos: [], // Menggantikan form.url_foto_mobil

    // Spesifikasi
    kapasitas: props.mobil.specification?.kapasitas || "",
    kategori: props.mobil.specification?.kategori || "",
    // Fasilitas diubah menjadi string JSON di backend, tetapi kita kelola sebagai array di frontend
    fasilitas: JSON.parse(props.mobil.specification?.fasilitas || "[]"),
    jenis_transmisi: props.mobil.specification?.jenis_transmisi || "",

    // Harga
    harga_solo: props.mobil.rental_price?.harga_solo || "",
    harga_solo_raya: props.mobil.rental_price?.harga_solo_raya || "",
    harga_luar_kota: props.mobil.rental_price?.harga_luar_kota || "",
});

// --- Fungsi Pengelolaan Gambar Baru ---

// Menambahkan input file baru
const addNewPhotoInput = () => form.new_photos.push(null);

// Menghapus input file baru dari array
const removeNewPhotoInput = (index) => form.new_photos.splice(index, 1);

// Menangani perubahan file
const handleFileChange = (event, index) => {
    const file = event.target.files[0];
    // Menyimpan objek File ke array new_photos
    form.new_photos[index] = file;
};

// --- Fungsi Pengelolaan Foto Lama (Penghapusan) ---

const removeOldPhoto = (photoPath) => {
    // 1. Tambahkan path foto ke array 'deleted_photos' agar backend bisa menghapusnya
    form.deleted_photos.push(photoPath);

    // 2. Hapus foto dari tampilan UI (parsedFotoLama)
    const index = parsedFotoLama.value.indexOf(photoPath);
    if (index > -1) {
        parsedFotoLama.value.splice(index, 1);
    }
};

// --- Fungsi Pengelolaan Fasilitas ---

const addFasilitas = () => form.fasilitas.push("");
const removeFasilitas = (index) => form.fasilitas.splice(index, 1);

// --- Fungsi Pengiriman Formulir Utama ---

const updateMobil = () => {
    // 1. Bersihkan array fasilitas dari string kosong (opsional, tapi disarankan)
    form.fasilitas = form.fasilitas.filter((item) => item.trim() !== "");

    // 2. Filter new_photos dari null/undefined (jika input file ditambahkan tapi tidak diisi)
    form.new_photos = form.new_photos.filter((file) => file);

    // 3. Kirim data menggunakan form.post bawaan Inertia.js
    // Inertia akan secara otomatis membuat FormData dan menambahkan semua file
    form.post(`/admin/mobil/${props.mobil.id_mobil}`, {
        // Karena ada file, kita harus memaksa Inertia menggunakan FormData
        forceFormData: true,
        onSuccess: () => {
            // Reset array file baru dan deleted photos setelah berhasil
            form.new_photos = [];
            form.deleted_photos = [];

            // Tampilkan notifikasi
            Swal.fire({
                title: "Mobil Berhasil Diperbarui!",
                icon: "success",
            });
        },
        onError: (errors) => {
            console.error("❌ Error:", errors);
        },
    });
};

// --- Fungsi Utility ---
// Fungsi untuk menghasilkan URL gambar
const getImageUrl = (path) => {
    return path.startsWith("storage") ? `/${path}` : `/storage/${path}`;
};
</script>
