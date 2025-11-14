<template>
    <DashLayouts>
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8 mt-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">
                Detail Template Pesan
            </h1>

            <div class="space-y-6">
                <!-- Nama Template -->
                <div>
                    <label class="font-semibold text-gray-700"
                        >Nama Template</label
                    >
                    <p class="text-lg text-gray-900 mt-1">
                        {{ template.jenis_template }}
                    </p>
                </div>

                <!-- Nomor Tujuan -->
                <div>
                    <label class="font-semibold text-gray-700"
                        >Nomor Tujuan</label
                    >
                    <p class="text-lg text-gray-900 mt-1">
                        {{ template.no_telp_tujuan }}
                    </p>
                </div>

                <!-- Isi Pesan -->
                <div>
                    <label class="font-semibold text-gray-700">Isi Pesan</label>
                    <div
                        class="border rounded-lg p-4 bg-gray-50 text-gray-900 whitespace-pre-line mt-1"
                    >
                        {{ template.isi }}
                    </div>
                </div>

                <!-- Hasil -->
                <div>
                    <label class="font-semibold text-gray-700">Isi Pesan</label>
                    <div
                        class="border rounded-lg p-4 bg-gray-50 text-gray-900 whitespace-pre-line mt-1"
                    >
                        {{ waLink }}
                    </div>
                </div>

                <!-- Tombol WhatsApp -->
                <div>
                    <a
                        :href="waLink"
                        target="_blank"
                        class="inline-block bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition font-medium shadow"
                    >
                        Kirim via WhatsApp
                    </a>
                </div>
            </div>

            <div class="mt-8">
                <Link
                    href="/admin/template-pesan"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition"
                >
                    Kembali
                </Link>
            </div>
        </div>
    </DashLayouts>
</template>

<script setup>
import DashLayouts from "../../Layouts/DashboardLayouts.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    template: Object,
    waLink: String,
});
</script>
