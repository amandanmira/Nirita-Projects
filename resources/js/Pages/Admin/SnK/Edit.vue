<template>
    <DashLayouts>
        <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-2xl p-8">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">
                ✏️ Edit Snk (Syarat dan Ketentuan)
            </h1>

            <form @submit.prevent="updateSnk" class="space-y-6">
                <!-- Pertanyaan -->
                <div>
                    <label
                        for="pertanyaan"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Pertanyaan
                    </label>
                    <input
                        id="pertanyaan"
                        type="text"
                        v-model="form.judul"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan pertanyaan"
                    />
                    <p
                        v-if="form.errors.judul"
                        class="text-sm text-red-500 mt-1"
                    >
                        {{ form.errors.judul }}
                    </p>
                </div>

                <!-- Jawaban -->
                <div>
                    <label
                        for="jawaban"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Jawaban
                    </label>
                    <textarea
                        id="jawaban"
                        v-model="form.deskripsi"
                        rows="5"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan jawaban"
                    ></textarea>
                    <p
                        v-if="form.errors.deskripsi"
                        class="text-sm text-red-500 mt-1"
                    >
                        {{ form.errors.deskripsi }}
                    </p>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-3 pt-4">
                    <Link
                        href="/admin/snk"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition"
                    >
                        Batal
                    </Link>
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                        :disabled="form.processing"
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
import { useForm, Link } from "@inertiajs/vue3";
import DashLayouts from "../../Layouts/DashboardLayouts.vue";

const props = defineProps({
    tncs: Object,
});

// isi form dengan data yang dikirim dari controller inertia
const form = useForm({
    judul: props.tncs?.judul || "",
    deskripsi: props.tncs?.deskripsi || "",
});

// fungsi update
const updateSnk = () => {
    form.put(`/admin/snk/${props.tncs.id_snk}`, {
        preserveScroll: true,
        onSuccess: () => {
            console.log("Update berhasil:", form);
            alert("SnK berhasil diperbarui!");
        },
        onError: (errors) => {
            console.error("Error saat update:", errors);
        },
    });
};
</script>

<style scoped>
/* sedikit styling tambahan agar tampak profesional */
form {
    transition: all 0.2s ease-in-out;
}
form:focus-within {
    transform: scale(1.01);
}
</style>
