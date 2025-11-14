<template>
    <DashLayout>
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">
                Edit Testimoni
            </h1>

            <form
                @submit.prevent="updateTestimoni"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                <div>
                    <label class="block font-semibold text-gray-700 mb-2"
                        >Foto Saat Ini</label
                    >
                    <img
                        v-if="testimoni.url_gambar"
                        :src="getImageUrl(testimoni.url_gambar)"
                        alt="Foto Testimoni"
                        class="w-64 h-40 object-cover rounded-lg shadow"
                    />
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2"
                        >Ganti Foto (Opsional)</label
                    >
                    <input
                        type="file"
                        @change="handleFileChange"
                        accept="image/*"
                        class="w-full ..."
                    />
                    <p
                        v-if="errors.url_gambar"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ errors.url_gambar }}
                    </p>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2"
                        >Deskripsi Testimoni</label
                    >
                    <textarea
                        v-model="form.desk_testimoni"
                        rows="4"
                        class="w-full ..."
                        placeholder="Tulis deskripsi testimoni..."
                    ></textarea>
                    <p
                        v-if="errors.desk_testimoni"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ errors.desk_testimoni }}
                    </p>
                </div>

                <div class="flex justify-between mt-6">
                    <Link
                        href="/admin/testimoni"
                        class="px-4 py-2 bg-gray-500 ..."
                        >Kembali</Link
                    >
                    <button type="submit" class="px-6 py-2 bg-blue-600 ...">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
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
            console.log("Update berhasil");
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
