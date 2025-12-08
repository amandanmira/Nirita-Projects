<template>
    <DashLayouts>
        <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl p-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 border-b pb-4">
                🤔 Tambah Template Pesan Baru
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
                                for="jenis_template"
                                class="block text-sm font-medium text-gray-700"
                                >Jenis Template</label
                            >
                            <input
                                id="jenis_template"
                                v-model="form.jenis_template"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            />
                        </div>

                        <div>
                            <label
                                for="no_telp_tujuan"
                                class="block text-sm font-medium text-gray-700"
                                >No Telepon Tujuan</label
                            >
                            <input
                                id="no_telp_tujuan"
                                v-model="form.no_telp_tujuan"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            />
                        </div>

                        <div>
                            <label
                                for="isi"
                                class="block text-sm font-medium text-gray-700"
                                >Isi Pesan</label
                            >
                            <div class="mt-1">
                                <textarea
                                    id="isi"
                                    v-model="form.isi"
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
                        href="/admin/template-pesan"
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
                            form.processing ? "Menyimpan..." : "Simpan Template"
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

const form = useForm({
    jenis_template: "",
    no_telp_tujuan: "",
    isi: "",
});

const submit = () => {
    form.post("/admin/template-pesan", {
        forceFormData: true,
        onSuccess: () => {
            Swal.fire({
                title: "Template Pesan Berhasil Ditambahkan!",
                icon: "success",
            });
        },
    });
};
</script>
