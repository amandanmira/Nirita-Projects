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
                        ref="editorDeskripsi"
                        rows="5"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
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
import { ref, onMounted, onBeforeUnmount } from "vue";

const props = defineProps({
    tncs: Object,
});

// Form awal dari database
const form = useForm({
    judul: props.tncs?.judul || "",
    deskripsi: props.tncs?.deskripsi || "",
});

// CKEDITOR INSTANCE
const editorDeskripsi = ref(null);
let editorInstance = null;

onMounted(() => {
    initializeCKEditor();
});

const initializeCKEditor = () => {
    if (editorDeskripsi.value && window.CKEDITOR) {
        editorInstance = window.CKEDITOR.replace("jawaban", {
            extraPlugins: "indent,removeformat",
            toolbar: [
                {
                    name: "basicstyles",
                    items: [
                        "RemoveFormat",
                        "-",
                        "Bold",
                        "Italic",
                        "Underline",
                        "Strike",
                    ],
                },
                {
                    name: "paragraph",
                    items: [
                        "NumberedList",
                        "BulletedList",
                        "-",
                        "Outdent",
                        "Indent",
                    ],
                },
                { name: "clipboard", items: ["Undo", "Redo"] },
            ],
            removePlugins:
                "image,link,table,about,styles,sourcearea,update-notifier",
        });

        // Isi CKEditor dengan data dari database
        editorInstance.setData(form.deskripsi);

        // Sync perubahan ke form
        editorInstance.on("change", () => {
            form.deskripsi = editorInstance.getData();
        });

        // Hilangkan notifikasi bawaan CKEditor
        const observer = new MutationObserver(() => {
            const notif = document.getElementById(
                "cke_notifications_area_jawaban"
            );
            if (notif) notif.remove();
        });
        observer.observe(document.body, { childList: true, subtree: true });
    }
};

onBeforeUnmount(() => {
    if (editorInstance) {
        editorInstance.destroy();
    }
});

// SUBMIT DATA
const updateSnk = () => {
    if (editorInstance) {
        form.deskripsi = editorInstance.getData();
    }

    form.put(`/admin/snk/${props.tncs.id_snk}`, {
        preserveScroll: true,
        onSuccess: () => {
            Swal.fire({
                title: "SNK Berhasil Diperbarui!",
                icon: "success",
            });
        },
        onError: (errors) => {
            console.error("Error saat update:", errors);
        },
    });
};
</script>

<style scoped>
form {
    transition: all 0.2s ease-in-out;
}
form:focus-within {
    transform: scale(1.01);
}
</style>

<style scoped>
/* sedikit styling tambahan agar tampak profesional */
form {
    transition: all 0.2s ease-in-out;
}
form:focus-within {
    transform: scale(1.01);
}
</style>
