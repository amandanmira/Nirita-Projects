<template>
    <DashLayout>
        <div class="max-w-3xl mx-auto mt-4">
            <div
                class="bg-white/60 backdrop-blur-xl p-10 rounded-3xl shadow-xl border border-gray-200/70 transition-all"
            >
                <!-- Header -->
                <div class="mb-10">
                    <h1
                        class="text-3xl font-bold text-gray-900 flex items-center gap-2"
                    >
                        <i class="fa-solid fa-pen-to-square text-blue-600"></i>
                        Edit Testimoni
                    </h1>
                    <p class="text-gray-500 text-sm mt-1">
                        Perbarui foto atau deskripsi testimoni pelanggan.
                    </p>
                </div>

                <!-- Form -->
                <form
                    @submit.prevent="updateTestimoni"
                    enctype="multipart/form-data"
                    class="space-y-8"
                >
                    <!-- Gambar saat ini -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Foto Saat Ini
                        </label>

                        <div
                            class="rounded-xl overflow-hidden shadow-md border border-gray-200"
                        >
                            <img
                                v-if="testimoni.url_gambar"
                                :src="getImageUrl(testimoni.url_gambar)"
                                alt="Foto Testimoni"
                                class="w-full max-h-60 object-cover"
                            />
                        </div>
                    </div>

                    <!-- Upload baru -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Ganti Foto (Opsional)
                        </label>

                        <div
                            class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center hover:border-blue-500 hover:bg-blue-50/40 transition cursor-pointer"
                        >
                            <input
                                type="file"
                                accept="image/*"
                                @change="handleFileChange"
                                class="w-full text-sm text-gray-700"
                            />
                            <p class="text-gray-400 text-sm mt-2">
                                Format: JPG, PNG — Max 5MB
                            </p>
                        </div>

                        <p
                            v-if="errors.url_gambar"
                            class="text-red-500 text-sm mt-2"
                        >
                            {{ errors.url_gambar }}
                        </p>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Deskripsi Testimoni
                        </label>

                        <textarea
                            v-model="form.desk_testimoni"
                            rows="4"
                            placeholder="Tulis deskripsi testimoni..."
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
                            Kembali
                        </Link>

                        <button
                            type="submit"
                            class="px-7 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-md transition"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </DashLayout>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import DashLayout from "../../Layouts/DashboardLayouts.vue";

const props = defineProps({
    testimoni: Object,
    errors: Object,
});

const form = {
    desk_testimoni: props.testimoni?.desk_testimoni || "",
    url_gambar: null,
};

const handleFileChange = (e) => {
    const file = e.target.files[0];
    form.url_gambar = file || null;
};

const updateTestimoni = () => {
    const data = new FormData();
    data.append("_method", "PUT");
    data.append("desk_testimoni", form.desk_testimoni);

    if (form.url_gambar) {
        data.append("url_gambar", form.url_gambar);
    }

    router.post(`/admin/testimoni/${props.testimoni.id_testimoni}`, data, {
        preserveState: false,
        onSuccess: () => {
            Swal.fire({
                title: "Testimoni Berhasil Diperbarui!",
                icon: "success",
            });
        },
        onError: (errs) => {
            console.error("Error update", errs);
        },
    });
};

const getImageUrl = (path) => {
    if (!path) return "";
    let url = path.startsWith("storage/") ? `/${path}` : `/storage/${path}`;
    return `${url}?v=${Date.now()}`;
};
</script>
