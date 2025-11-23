<template>
    <DashLayouts>
        <div
            class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-10 border border-gray-100"
        >
            <!-- Header -->
            <div class="flex items-center justify-between mb-8 border-b pb-4">
                <h1 class="text-2xl font-bold text-gray-800">
                    🖼️ Tambah Testimoni
                </h1>
            </div>

            <!-- Form -->
            <form
                @submit.prevent="submitForm"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                <!-- Upload Gambar -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                        >Upload Gambar</label
                    >
                    <input
                        type="file"
                        accept="image/*"
                        @change="handleFileChange"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                    />
                    <p
                        v-if="errors.url_gambar"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ errors.url_gambar }}
                    </p>

                    <!-- Preview -->
                    <div v-if="preview" class="mt-4">
                        <img
                            :src="preview"
                            alt="Preview"
                            class="w-48 h-48 object-cover rounded-lg border shadow"
                        />
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                        >Deskripsi Testimoni</label
                    >
                    <textarea
                        v-model="form.desk_testimoni"
                        rows="4"
                        placeholder="Masukkan deskripsi testimoni (opsional)"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                    ></textarea>
                    <p
                        v-if="errors.desk_testimoni"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ errors.desk_testimoni }}
                    </p>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-3 mt-8">
                    <Link
                        href="/admin/testimoni"
                        class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition"
                    >
                        Batal
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition"
                    >
                        {{
                            form.processing
                                ? "Menyimpan..."
                                : "Simpan Testimoni"
                        }}
                    </button>
                </div>
            </form>
        </div>
    </DashLayouts>
</template>

<script setup>
import DashLayouts from "../../Layouts/DashboardLayouts.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    errors: Object,
});

// Form data
const form = useForm({
    url_gambar: null,
    desk_testimoni: "",
});

const preview = ref(null);

// handle file upload
const handleFileChange = (e) => {
    const file = e.target.files[0];
    form.url_gambar = file;

    if (file) {
        preview.value = URL.createObjectURL(file);
    } else {
        preview.value = null;
    }
};

// submit form
const submitForm = () => {
    form.post("/admin/testimoni", {
        forceFormData: true, // agar dikirim sebagai multipart/form-data
        onSuccess: () => {
            Swal.fire({
                title: "Testimoni Berhasil Ditambahkan!",
                icon: "success",
            });
        },
        onError: (errors) => {
            console.error(errors);
        },
    });
};
</script>
