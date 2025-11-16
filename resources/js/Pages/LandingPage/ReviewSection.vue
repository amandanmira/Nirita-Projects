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
                        v-for="(chunk, index) in chunkedTestimonials"
                        :key="index"
                        class="flex flex-none w-full min-w-full justify-center gap-2 md:gap-3 lg:gap-4"
                    >
                        <div
                            v-for="testi in chunk"
                            :key="testi.id_testimoni"
                            class="bg-gray-200 rounded-xl shadow-md flex-shrink-0"
                            :class="{
                                'w-[90%] h-64': windowWidth < 640,
                                'w-56 h-56':
                                    windowWidth >= 640 && windowWidth < 1024,
                                'w-52 h-52': windowWidth >= 1024,
                            }"
                        >
                            <img
                                :src="`/storage/${testi.url_gambar}`"
                                :alt="`Foto dari ${testi.desk_testimoni}`"
                                class="w-full h-full object-cover rounded-lg"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigasi Bullets -->
            <div class="flex justify-center mt-6 space-x-3">
                <button
                    v-for="(chunk, index) in chunkedTestimonials"
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

const props = defineProps({
    testimonials: Array,
});

// slider index
const currentIndex = ref(0);

// lebar layar
const windowWidth = ref(window.innerWidth);

const updateWidth = () => {
    windowWidth.value = window.innerWidth;
    currentIndex.value = 0;
};

onMounted(() => window.addEventListener("resize", updateWidth));
onMounted(() => {
    console.log("TESTI:", props.testimonials);
});
onUnmounted(() => window.removeEventListener("resize", updateWidth));

// jumlah item per slide
const itemsPerSlide = computed(() => {
    if (windowWidth.value < 640) return 1;
    if (windowWidth.value < 1024) return 3;
    return 5;
});

// membuat chunk array
const chunkedTestimonials = computed(() => {
    if (!props.testimonials || !Array.isArray(props.testimonials)) {
        return [];
    }

    const chunkSize = itemsPerSlide.value;
    const chunks = [];

    for (let i = 0; i < props.testimonials.length; i += chunkSize) {
        chunks.push(props.testimonials.slice(i, i + chunkSize));
    }

    return chunks;
});
</script>
