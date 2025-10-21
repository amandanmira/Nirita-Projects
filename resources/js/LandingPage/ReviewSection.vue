<template>
    <section
        class="bg-[#101B4E] py-12 px-3 md:px-16 lg:px-20 text-center text-white"
    >
        <div class="w-full max-w-7xl mx-auto">
            <!-- Judul -->
            <h2 class="text-2xl md:text-3xl font-semibold mb-3">
                Review Pelanggan
            </h2>
            <p class="text-gray-300 mb-10">
                Simak apa yang dikatakan para pelanggan yang telah memakai jasa
                sewa mobil Solo dari Nirita Transport.
            </p>

            <!-- Slider Wrapper -->
            <div class="overflow-hidden relative">
                <div
                    class="flex transition-transform duration-500"
                    :style="{
                        transform: `translateX(-${currentIndex * 100}%)`,
                    }"
                >
                    <!-- Setiap Slide: 1 item (mobile), 3 item (tablet), 5 item (desktop) -->
                    <div
                        v-for="(chunk, index) in chunkedReviews"
                        :key="index"
                        class="flex flex-none w-full min-w-full justify-center gap-2 md:gap-3 lg:gap-4"
                    >
                        <div
                            v-for="review in chunk"
                            :key="review.id"
                            class="bg-gray-200 rounded-xl shadow-md flex-shrink-0"
                            :class="{
                                'w-[90%] h-64': windowWidth < 640,
                                'w-56 h-56':
                                    windowWidth >= 640 && windowWidth < 1024,
                                'w-52 h-52': windowWidth >= 1024,
                            }"
                        >
                            <img
                                :src="getImage(review.path)"
                                :alt="review.desk"
                                class="w-full h-full object-cover rounded-lg"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigasi Bullets -->
            <div class="flex justify-center mt-6 space-x-3">
                <button
                    v-for="(chunk, index) in chunkedReviews"
                    :key="'dot-' + index"
                    @click="currentIndex = index"
                    class="w-3 h-3 rounded-full transition"
                    :class="
                        index === currentIndex ? 'bg-blue-400' : 'bg-gray-400'
                    "
                ></button>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import reviews from "../data/testimoni.js"; // ← file data dummy kamu

// Index aktif untuk slider
const currentIndex = ref(0);

// Reactive window width untuk responsive
const windowWidth = ref(window.innerWidth);

// Update window width on resize
const updateWidth = () => {
    windowWidth.value = window.innerWidth;
    currentIndex.value = 0; // Reset ke slide pertama saat resize
};

onMounted(() => {
    window.addEventListener("resize", updateWidth);
});

onUnmounted(() => {
    window.removeEventListener("resize", updateWidth);
});

// Menentukan jumlah item per slide berdasarkan ukuran layar
const itemsPerSlide = computed(() => {
    if (windowWidth.value < 640) return 1; // Mobile: 1 item
    if (windowWidth.value < 1024) return 3; // Tablet: 3 items
    return 5; // Desktop: 5 items
});

// Fungsi untuk membagi array menjadi kelompok (chunk) sesuai ukuran layar
const chunkedReviews = computed(() => {
    const chunkSize = itemsPerSlide.value;
    const chunks = [];
    for (let i = 0; i < reviews.length; i += chunkSize) {
        chunks.push(reviews.slice(i, i + chunkSize));
    }
    return chunks;
});

// Helper function untuk resolve path gambar (agar tidak error saat build)
const getImage = (path) => {
    return new URL(path, import.meta.url).href;
};
</script>
