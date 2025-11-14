<template>
    <DashLayouts>
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-3"
            >
                <h1 class="text-3xl font-bold text-gray-800">Daftar Mobil</h1>
                <Link
                    href="/admin/mobil/create"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition"
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
                    Tambah Mobil
                </Link>
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
                <table class="min-w-full text-sm text-gray-700">
                    <thead
                        class="bg-[#15224F] text-white text-left sticky top-0"
                    >
                        <tr>
                            <th class="py-3 px-4 font-semibold">Foto Mobil</th>
                            <th class="py-3 px-4 font-semibold">Nama Mobil</th>
                            <th class="py-3 px-4 font-semibold text-center">
                                Plat Nomor
                            </th>
                            <th class="py-3 px-4 font-semibold text-center">
                                Ketersediaan
                            </th>
                            <th class="py-3 px-4 font-semibold text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="mobil in paginatedCars"
                            :key="mobil.id_mobil"
                            class="border-b hover:bg-gray-50 transition"
                        >
                            <td class="py-3 px-4">
                                <img
                                    :src="getFirstPhoto(mobil.url_foto_mobil)"
                                    alt="Foto Mobil"
                                    class="w-20 h-12 object-cover rounded-md"
                                />
                            </td>
                            <td class="py-3 px-4 font-medium">
                                {{ mobil.nama_mobil }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                {{ mobil.plat_nomor }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span
                                    :class="[
                                        'px-2 py-1 rounded-full text-xs font-semibold',
                                        mobil.ketersediaan > 0
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-red-100 text-red-700',
                                    ]"
                                >
                                    {{
                                        mobil.ketersediaan > 0
                                            ? mobil.ketersediaan + " Unit"
                                            : "Tidak Tersedia"
                                    }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div
                                    class="flex justify-center gap-3 bg-gray-300/50 py-2 rounded-full"
                                >
                                    <!-- Detail -->
                                    <Link
                                        :href="`/admin/mobil/${mobil.id_mobil}`"
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
                                                d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>
                                        Detail
                                    </Link>

                                    <!-- Edit -->
                                    <EditBtn
                                        :href="`/admin/mobil/${mobil.id_mobil}/edit`"
                                    ></EditBtn>

                                    <!-- Hapus -->
                                    <HapusBtn
                                        @click="hapus(mobil.id_mobil)"
                                    ></HapusBtn>
                                </div>
                            </td>
                        </tr>

                        <!-- Jika kosong -->
                        <tr v-if="cars.length === 0">
                            <td
                                colspan="4"
                                class="text-center py-6 text-gray-500"
                            >
                                Tidak ada data mobil tersedia.
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
                        Math.min(endIndex, cars.length)
                    }}</span>
                    dari
                    <span class="font-semibold">{{ cars.length }}</span> data
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
    </DashLayouts>
</template>

<script setup>
import DashLayouts from "../../Layouts/DashboardLayouts.vue";
import HapusBtn from "../../Components/HapusBtn.vue";
import EditBtn from "../../Components/EditBtn.vue";
import { Link, router } from "@inertiajs/vue3";
import { ref, computed } from "vue";

// pastikan props tersimpan di variabel
const props = defineProps({
    cars: {
        type: Array,
        default: () => [],
    },
});

// Parsing data foto yang awalnya string JSON menjadi array
const getFirstPhoto = (fotoData) => {
    try {
        // Jika berupa JSON array
        const parsed = JSON.parse(fotoData);
        if (Array.isArray(parsed) && parsed.length > 0) {
            // Jika path sudah mengandung /storage/, langsung return
            return parsed[0].startsWith("/storage/")
                ? parsed[0]
                : `/storage/${parsed[0]}`;
        }
    } catch (e) {
        // Jika bukan JSON array, return langsung
        if (typeof fotoData === "string") {
            return fotoData.startsWith("/storage/")
                ? fotoData
                : `/storage/${fotoData}`;
        }
    }
    // fallback jika tidak ada foto
    return "/placeholder_image/placeholder_mobil.png";
};

const itemsPerPage = 10;
const currentPage = ref(1);

// total halaman (gunakan length yang aman)
const totalPages = computed(() =>
    Math.max(1, Math.ceil((props.cars?.length ?? 0) / itemsPerPage))
);

// membantu template: array halaman [1,2,3,...]
const pagesArray = computed(() => {
    return Array.from({ length: totalPages.value }, (_, i) => i + 1);
});

// indeks awal & akhir (angka bulat)
const startIndex = computed(() => (currentPage.value - 1) * itemsPerPage);
const endIndex = computed(() => startIndex.value + itemsPerPage);

// paginasi (slice aman)
const paginatedCars = computed(() => {
    const arr = props.cars ?? [];
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

const hapus = (id) => {
    if (confirm("Yakin ingin menghapus mobil ini?")) {
        router.delete(`/admin/mobil/${id}`);
    }
};
</script>
