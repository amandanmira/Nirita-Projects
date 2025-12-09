<template>
    <DashLayouts>
        <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl p-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 border-b pb-4">
                🤔 Tambah FAQ Baru
            </h1>

            <form
                @submit.prevent="submit"
                enctype="multipart/form-data"
                class="space-y-10"
            >
                <section>
                    <div class="space-y-4">
                        <div>
                            <label
                                for="pertanyaan"
                                class="block text-sm font-medium text-gray-700"
                                >Pertanyaan</label
                            >
                            <div class="mt-1">
                                <textarea
                                    id="pertanyaan"
                                    v-model="form.pertanyaan"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                ></textarea>
                            </div>
                        </div>

                        <div>
                            <label
                                for="jawaban"
                                class="block text-sm font-medium text-gray-700"
                                >Jawaban</label
                            >
                            <div class="mt-1">
                                <textarea
                                    id="jawaban"
                                    ref="editorElement"
                                    rows="4"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- === BUTTON === -->
                <div class="flex justify-end mt-10 gap-4">
                    <Link
                        href="/admin/faq"
                        class="bg-gray-100 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-200 transition font-medium"
                    >
                        Kembali
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium shadow-md"
                    >
                        {{ form.processing ? "Menyimpan..." : "Simpan FAQ" }}
                    </button>
                </div>
            </form>
        </div>
    </DashLayouts>
</template>
<script setup>
import DashLayouts from "../../Layouts/DashboardLayouts.vue";
import { useForm, Link } from "@inertiajs/vue3";
import { ref, onMounted, onBeforeUnmount } from "vue";

const editorElement = ref(null);
let editorInstance = null;

const form = useForm({
    pertanyaan: "",
    jawaban: "",
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

const submit = () => {
    // Update form.jawaban with latest CKEditor content before submit
    if (editorInstance) {
        form.jawaban = editorInstance.getData();
    }

    form.post("/admin/faq", {
        forceFormData: true,
        onSuccess: () => {
            Swal.fire({
                title: "FAQ Berhasil Ditambahkan!",
                icon: "success",
            });
        },
    });
};
</script>
