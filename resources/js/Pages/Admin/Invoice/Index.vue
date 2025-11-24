<template>
    <DashLayout>
        <div class="max-w-6xl mx-auto p-3">
            <!-- Header -->
            <div
                class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-6 gap-3"
            >
                <h1 class="text-3xl font-bold text-gray-800">Daftar Invoice</h1>
                <Link
                    href="/admin/invoice/create"
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
                    Tambah Invoice
                </Link>
            </div>

            <div
                v-if="flash.success"
                class="alert-success bg-green-100 text-green-700 px-4 py-2 rounded mb-4"
            >
                {{ flash.success }}
            </div>

            <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
                <table class="min-w-full text-sm text-gray-700">
                    <thead
                        class="bg-[#15224F] text-white text-left sticky top-0"
                    >
                        <tr>
                            <th class="py-3 px-4 font-semibold">No</th>
                            <th class="py-3 px-4 font-semibold">Penyewa</th>
                            <th class="py-3 px-4 font-semibold">Driver</th>
                            <th class="py-3 px-4 font-semibold">
                                Total Pembayaran
                            </th>
                            <th class="py-3 px-4 font-semibold text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="(b, idx) in paginatedBills"
                            :key="b.id_nota"
                            class="border-b hover:bg-gray-50"
                        >
                            <td class="py-3 px-4">
                                {{ startIndex + idx + 1 }}
                            </td>
                            <td class="py-3 px-4">
                                {{ b.nama_penyewa }}
                            </td>
                            <td class="py-3 px-4">{{ b.driver }}</td>
                            <td class="py-3 px-4">
                                {{ formatCurrency(b.total_pembayaran) }}
                            </td>
                            <td class="py-3 px-4 space-x-2">
                                <div
                                    class="flex justify-center gap-3 rounded-full"
                                >
                                    <!-- Detail -->
                                    <Link
                                        :href="`/admin/invoice/${b.id_nota}`"
                                        class="text-blue-600 hover:text-blue-800 flex items-center gap-3"
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
                                        :href="`/admin/invoice/${b.id_nota}/edit`"
                                    ></EditBtn>

                                    <!-- Hapus -->
                                    <HapusBtn
                                        @click="deleteInvoice(b.id_nota)"
                                    ></HapusBtn>
                                </div>
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
                        Math.min(endIndex, bills.length)
                    }}</span>
                    dari
                    <span class="font-semibold">{{ bills.length }}</span> data
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
                        v-for="page in pagesArray"
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
import { Link, router, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    bills: Array,
});

const page = usePage();
const flash = page.props.flash ?? {};

const formatCurrency = (value) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    }).format(value);
};

const deleteInvoice = (id) => {
    Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/admin/invoice/${id}`, {
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        title: "Invoice Berhasil Dihapus!",
                    });
                },
            });
        }
    });
};

const itemsPerPage = 10;
const currentPage = ref(1);

// total halaman (gunakan bills length yang benar)
const totalPages = computed(() =>
    Math.max(1, Math.ceil((props.bills?.length ?? 0) / itemsPerPage))
);

// membantu template: array halaman [1,2,3,...]
const pagesArray = computed(() =>
    Array.from({ length: totalPages.value }, (_, i) => i + 1)
);

// indeks awal & akhir (angka bulat)
const startIndex = computed(() => (currentPage.value - 1) * itemsPerPage);
const endIndex = computed(() => startIndex.value + itemsPerPage);

// paginasi (slice aman)
const paginatedBills = computed(() => {
    const arr = props.bills ?? [];
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
