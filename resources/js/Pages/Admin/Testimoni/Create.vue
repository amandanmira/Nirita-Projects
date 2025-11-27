<template>
    <DashLayouts>
        <div class="max-w-3xl mx-auto mt-4">
            <div
                class="bg-white/60 backdrop-blur-xl p-10 rounded-3xl shadow-xl border border-gray-200/70 transition-all"
            >
                <!-- Header -->
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h1
                            class="text-3xl font-bold text-gray-900 flex items-center gap-2"
                        >
                            <i class="fa-solid fa-plus text-blue-600"></i>
                            Tambah Testimoni
                        </h1>
                        <p class="text-gray-500 text-sm mt-1">
                            Tambahkan testimoni baru dari pelanggan.
                        </p>
                    </div>
                </div>

                <!-- Form -->
                <form
                    @submit.prevent="submitForm"
                    enctype="multipart/form-data"
                    class="space-y-8"
                >
                    <!-- Upload Gambar -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Upload Gambar
                        </label>

                        <div
                            class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center hover:border-blue-500 hover:bg-blue-50/40 transition cursor-pointer"
                        >
                            <input
                                type="file"
                                accept="image/*"
                                @change="handleFileChange"
                                class="w-full text-sm text-gray-600"
                            />

                            <p class="text-gray-400 text-sm mt-2">
                                Format: JPG, PNG — Max 5MB
                            </p>
                        </div>

                        <!-- Error -->
                        <p
                            v-if="errors.url_gambar"
                            class="text-red-500 text-sm mt-2"
                        >
                            {{ errors.url_gambar }}
                        </p>

                        <!-- Preview -->
                        <div v-if="preview" class="mt-5 flex justify-center">
                            <img
                                :src="preview"
                                alt="Preview"
                                class="w-48 h-48 object-cover rounded-xl shadow-md border"
                            />
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Deskripsi Testimoni
                        </label>

                        <textarea
                            v-model="form.desk_testimoni"
                            rows="4"
                            placeholder="Masukkan deskripsi testimoni (opsional)"
                            class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition shadow-sm"
                        ></textarea>

                        <p
                            v-if="errors.desk_testimoni"
                            class="text-red-500 text-sm mt-2"
                        >
                            {{ errors.desk_testimoni }}
                        </p>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end gap-4 pt-4">
                        <Link
                            href="/admin/testimoni"
                            class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-xl transition shadow-sm"
                        >
                            Batal
                        </Link>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-7 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-md transition disabled:opacity-50 disabled:cursor-not-allowed"
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

const form = useForm({
    url_gambar: null,
    desk_testimoni: "",
});

const preview = ref(null);

const handleFileChange = (e) => {
    const file = e.target.files[0];
    form.url_gambar = file;

    if (file) {
        preview.value = URL.createObjectURL(file);
    } else {
        preview.value = null;
    }
};

const submitForm = () => {
    form.post("/admin/testimoni", {
        forceFormData: true,
        onSuccess: () => {
            Swal.fire({
                title: "Berhasil!",
                text: "Testimoni berhasil ditambahkan.",
                icon: "success",
            });
        },
    });
};
</script>
