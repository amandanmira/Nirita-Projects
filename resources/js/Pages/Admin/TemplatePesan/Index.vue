<template>
    <DashLayout>
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div
                class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-6 gap-3"
            >
                <h1 class="text-3xl font-bold text-gray-800">
                    Daftar Template Pesan
                </h1>
                <Link
                    href="/admin/template-pesan/create"
                    class="cursor-pointer inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>
                    Tambah Template Pesan
                </Link>
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
                <table class="min-w-full text-sm text-gray-700 border-collapse">
                    <thead
                        class="bg-[#15224F] text-white text-left sticky top-0"
                    >
                        <tr>
                            <th
                                class="py-3 px-4 font-semibold whitespace-nowrap"
                            >
                                No
                            </th>
                            <th
                                class="py-3 px-4 font-semibold whitespace-nowrap"
                            >
                                Jenis Template
                            </th>
                            <th
                                class="py-3 px-4 font-semibold whitespace-nowrap"
                            >
                                No Tujuan
                            </th>
                            <th
                                class="py-3 px-4 font-semibold whitespace-nowrap"
                            >
                                Isi Pesan
                            </th>
                            <th
                                class="py-3 px-4 font-semibold text-center whitespace-nowrap"
                            >
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="(template, idx) in paginatedTemplates"
                            :key="template.id_template"
                            class="border-b hover:bg-gray-50 transition"
                        >
                            <td class="py-3 px-4 text-center">
                                {{ startIndex + idx + 1 }}
                            </td>

                            <td class="py-3 px-4 whitespace-nowrap font-medium">
                                {{ template.jenis_template }}
                            </td>

                            <td class="py-3 px-4 whitespace-nowrap">
                                {{ template.no_telp_tujuan }}
                            </td>

                            <td class="py-3 px-4 max-w-[300px]">
                                <p class="line-clamp-2">
                                    {{ template.isi }}
                                </p>
                            </td>

                            <td class="py-3 px-4 text-center">
                                <div
                                    class="flex items-center justify-center gap-3 rounded-full flex-wrap"
                                >
                                    <!-- Detail -->
                                    <Link
                                        :href="`/admin/template-pesan/${template.id_template}`"
                                        class="text-blue-600 hover:text-blue-800 transition flex items-center gap-1"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                            />
                                        </svg>
                                        Detail
                                    </Link>

                                    <!-- Edit -->
                                    <EditBtn
                                        :href="`/admin/template-pesan/${template.id_template}/edit`"
                                    />

                                    <!-- Hapus -->
                                    <HapusBtn
                                        @click="hapus(template.id_template)"
                                    />
                                </div>
                            </td>
                        </tr>

                        <!-- Jika data kosong -->
                        <tr v-if="paginatedTemplates.length === 0">
                            <td
                                colspan="5"
                                class="text-center py-6 text-gray-500"
                            >
                                Tidak ada template pesan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div
                v-if="totalPages > 1"
                class="flex justify-between items-center mt-6 bg-white p-4 rounded-xl shadow-sm"
            >
                <p class="text-gray-600 text-sm">
                    Menampilkan
                    <span class="font-semibold">{{ startIndex + 1 }}</span>
                    -
                    <span class="font-semibold">{{
                        Math.min(endIndex, faqs.length)
                    }}</span>
                    dari
                    <span class="font-semibold">{{ faqs.length }}</span> data
                </p>

                <div class="flex gap-2">
                    <button
                        @click="prevPage"
                        :disabled="currentPage === 1"
                        class="px-3 py-1 border rounded-lg text-sm hover:bg-gray-100 disabled:opacity-50"
                    >
                        ‹
                    </button>
                    <span
                        v-for="page in totalPages"
                        :key="page"
                        @click="goToPage(page)"
                        :class="[
                            'px-3 py-1 border rounded-lg text-sm cursor-pointer transition',
                            page === currentPage
                                ? 'bg-blue-600 text-white border-blue-600'
                                : 'hover:bg-gray-100',
                        ]"
                    >
                        {{ page }}
                    </span>
                    <button
                        @click="nextPage"
                        :disabled="currentPage === totalPages"
                        class="px-3 py-1 border rounded-lg text-sm hover:bg-gray-100 disabled:opacity-50"
                    >
                        ›
                    </button>
                </div>
            </div>
        </div>
    </DashLayout>
</template>

<script setup>
import DashLayout from "../../Layouts/DashboardLayouts.vue";
import HapusBtn from "../../Components/HapusBtn.vue";
import EditBtn from "../../Components/EditBtn.vue";
import { Link, router } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    templates: Array,
});

const hapus = (id) => {
    Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/admin/template-pesan/${id}`, {
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        title: "Template Pesan Berhasil Dihapus!",
                    });
                },
            });
        }
    });
};

// const faqs = props.faqs;
const itemsPerPage = 10;
const currentPage = ref(1);

// total halaman (gunakan length yang aman)
const totalPages = computed(() =>
    Math.max(1, Math.ceil((props.templates?.length ?? 0) / itemsPerPage))
);

// membantu template: array halaman [1,2,3,...]
const pagesArray = computed(() => {
    return Array.from({ length: totalPages.value }, (_, i) => i + 1);
});

// indeks awal & akhir (angka bulat)
const startIndex = computed(() => (currentPage.value - 1) * itemsPerPage);
const endIndex = computed(() => startIndex.value + itemsPerPage);

// paginasi (slice aman)
const paginatedTemplates = computed(() => {
    const arr = props.templates ?? [];
    const start = Number.isFinite(startIndex.value) ? startIndex.value : 0;
    const end = Number.isFinite(endIndex.value) ? endIndex.value : itemsPerPage;
    return arr.slice(start, end);
});

const nextPage = () => {
    if (currentPage.value < totalPages.value) currentPage.value++;
};
const prevPage = () => {
    if (currentPage.value > 1) currentPage.value--;
};
const goToPage = (page) => {
    if (page >= 1 && page <= totalPages.value) currentPage.value = page;
};
</script>
