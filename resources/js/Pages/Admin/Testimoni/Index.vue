<template>
    <DashLayout>
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div
                class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-6 gap-3"
            >
                <h1 class="text-3xl font-bold text-gray-800">
                    Daftar Testimoni
                </h1>
                <Link
                    href="/admin/testimoni/create"
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
                    Tambah Testimoni
                </Link>
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
                <table class="min-w-full text-sm text-gray-700">
                    <thead
                        class="bg-[#15224F] text-white text-left sticky top-0"
                    >
                        <tr>
                            <th class="py-3 px-4 font-semibold">No</th>
                            <th class="py-3 px-4 font-semibold">Gambar</th>
                            <th class="py-3 px-4 font-semibold">Deskripsi</th>
                            <th class="py-3 px-4 font-semibold text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(testimonial, idx) in paginatedTestimonials"
                            :key="testimonial.id_testimoni"
                            class="border-b hover:bg-gray-50"
                        >
                            <td class="py-3 px-4">
                                {{ startIndex + idx + 1 }}
                            </td>
                            <td class="py-3 px-4">
                                <img
                                    :src="`/storage/${testimonial.url_gambar}`"
                                    alt="foto tidak bisa muncul"
                                    class="w-30 h-22 object-cover rounded-md"
                                />
                            </td>
                            <td
                                class="py-3 px-4"
                                v-html="testimonial.desk_testimoni"
                            ></td>
                            <td class="py-3 px-4 text-center">
                                <div
                                    class="flex justify-center gap-3 rounded-full"
                                >
                                    <!-- Edit -->
                                    <EditBtn
                                        :href="`/admin/testimoni/${testimonial.id_testimoni}/edit`"
                                    ></EditBtn>

                                    <!-- Hapus -->
                                    <HapusBtn
                                        @click="hapus(testimonial.id_testimoni)"
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
    testimonials: Array,
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
            router.delete(`/admin/testimoni/${id}`, {
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        title: "Testimoni telah dihapus.",
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
    Math.max(1, Math.ceil((props.testimonials?.length ?? 0) / itemsPerPage))
);

// membantu template: array halaman [1,2,3,...]
const pagesArray = computed(() => {
    return Array.from({ length: totalPages.value }, (_, i) => i + 1);
});

// indeks awal & akhir (angka bulat)
const startIndex = computed(() => (currentPage.value - 1) * itemsPerPage);
const endIndex = computed(() => startIndex.value + itemsPerPage);

// paginasi (slice aman)
const paginatedTestimonials = computed(() => {
    const arr = props.testimonials ?? [];
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
