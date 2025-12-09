<template>
    <DashLayouts>
        <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl p-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 border-b pb-4">
                🤔 Tambah Syarat dan Ketentuan Baru
            </h1>

            <form
                @submit.prevent="submit"
                enctype="multipart/form-data"
                class="space-y-10"
            >
                <section>
                    <div class="space-y-4">
                        <!-- JUDUL -->
                        <div>
                            <label
                                for="judul"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Judul
                            </label>
                            <div class="mt-1">
                                <textarea
                                    id="judul"
                                    v-model="form.judul"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                ></textarea>
                            </div>
                        </div>

                        <!-- DESKRIPSI (CKEDITOR) -->
                        <div>
                            <label
                                for="deskripsi"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Deskripsi
                            </label>
                            <div class="mt-1">
                                <textarea
                                    id="deskripsi"
                                    ref="editorDeskripsi"
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
                        href="/admin/snk"
                        class="bg-gray-100 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-200 transition font-medium"
                    >
                        Kembali
                    </Link>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium shadow-md"
                    >
                        {{ form.processing ? "Menyimpan..." : "Simpan Snk" }}
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

const form = useForm({
    judul: "",
    deskripsi: "",
});

const editorDeskripsi = ref(null);
let editorInstance = null;

onMounted(() => {
    initializeCKEditor();
});

const initializeCKEditor = () => {
    if (editorDeskripsi.value && window.CKEDITOR) {
        editorInstance = window.CKEDITOR.replace("deskripsi", {
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

        // Sync ke form
        editorInstance.on("change", () => {
            form.deskripsi = editorInstance.getData();
        });

        // Hilangkan notifikasi CKEditor yang mengganggu
        const observer = new MutationObserver(() => {
            const notif = document.getElementById(
                "cke_notifications_area_deskripsi"
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

const submit = () => {
    if (editorInstance) {
        form.deskripsi = editorInstance.getData();
    }

    form.post("/admin/snk", {
        forceFormData: true,
        onSuccess: () => {
            Swal.fire({
                title: "Syarat dan Ketentuan Berhasil Ditambahkan!",
                icon: "success",
            });
        },
    });
};
</script>
