<template>
    <DashLayouts>
        <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-2xl p-8">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">
                ✏️ Edit FAQ (Frequently Asked Questions)
            </h1>

            <form @submit.prevent="updateFaq" class="space-y-6">
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
                        v-model="form.pertanyaan"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan pertanyaan"
                    />
                    <p
                        v-if="form.errors.pertanyaan"
                        class="text-sm text-red-500 mt-1"
                    >
                        {{ form.errors.pertanyaan }}
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
                        ref="editorElement"
                        rows="5"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan jawaban"
                    ></textarea>
                    <p
                        v-if="form.errors.jawaban"
                        class="text-sm text-red-500 mt-1"
                    >
                        {{ form.errors.jawaban }}
                    </p>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-3 pt-4">
                    <Link
                        href="/admin/faq"
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
    faq: Object,
});

const editorElement = ref(null);
let editorInstance = null;

// isi form dengan data yang dikirim dari controller inertia
const form = useForm({
    pertanyaan: props.faq?.pertanyaan || "",
    jawaban: props.faq?.jawaban || "",
});

onMounted(() => {
    // CKEditor sudah dimuat dari app.blade.php
    initializeCKEditor();
});

const initializeCKEditor = () => {
    if (editorElement.value && window.CKEDITOR) {
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

        // Set initial content from form
        editorInstance.setData(form.jawaban);

        // Sync CKEditor content with form
        editorInstance.on("change", () => {
            form.jawaban = editorInstance.getData();
        });

        // Remove notification
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
    // Cleanup CKEditor instance
    if (editorInstance) {
        editorInstance.destroy();
    }
});

// fungsi update
const updateFaq = () => {
    // Update form.jawaban with latest CKEditor content before submit
    if (editorInstance) {
        form.jawaban = editorInstance.getData();
    }

    form.put(`/admin/faq/${props.faq.id_faq}`, {
        preserveScroll: true,
        onSuccess: () => {
            Swal.fire({
                title: "FAQ Berhasil Diperbarui!",
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
/* sedikit styling tambahan agar tampak profesional */
form {
    transition: all 0.2s ease-in-out;
}
form:focus-within {
    transform: scale(1.01);
}
</style>
