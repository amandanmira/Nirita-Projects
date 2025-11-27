<template>
    <section
        class="bg-[#101B4E] py-12 px-3 md:px-16 lg:px-20 text-center text-white"
    >
        <div class="w-full max-w-7xl mx-auto">
            <!-- Judul -->
            <h2 class="review-title text-2xl md:text-3xl font-semibold mb-3">
                Review Pelanggan
            </h2>
            <p class="review-desc text-gray-300 mb-10">
                Simak apa yang dikatakan para pelanggan yang telah memakai jasa
                sewa mobil Solo dari Nirita Transport.
            </p>

            <!-- Slider Wrapper -->
            <div class="overflow-hidden relative review-slider">
                <div
                    class="flex transition-transform duration-500"
                    :style="{
                        transform: `translateX(-${currentIndex * 100}%)`,
                    }"
                >
                    <div
                        v-for="(chunk, index) in chunkedTestimonials"
                        :key="index"
                        class="flex flex-none w-full min-w-full justify-center gap-2 md:gap-3 lg:gap-4"
                    >
                        <div
                            v-for="testi in chunk"
                            :key="testi.id_testimoni"
                            class="testi-item bg-gray-200 rounded-xl shadow-md flex-shrink-0 overflow-hidden"
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

            <!-- bullets -->
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
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

const props = defineProps({
    testimonials: Array,
});

// slider index
const currentIndex = ref(0);

// screen width
const windowWidth = ref(window.innerWidth);
const updateWidth = () => {
    windowWidth.value = window.innerWidth;
    currentIndex.value = 0;
};

onMounted(() => window.addEventListener("resize", updateWidth));
onUnmounted(() => window.removeEventListener("resize", updateWidth));

// responsive per slide
const itemsPerSlide = computed(() => {
    if (windowWidth.value < 640) return 1;
    if (windowWidth.value < 1024) return 3;
    return 5;
});

// build chunk array
const chunkedTestimonials = computed(() => {
    if (!props.testimonials || !Array.isArray(props.testimonials)) return [];

    const chunkSize = itemsPerSlide.value;
    const chunks = [];
    for (let i = 0; i < props.testimonials.length; i += chunkSize) {
        chunks.push(props.testimonials.slice(i, i + chunkSize));
    }
    return chunks;
});

// GSAP
onMounted(() => {
    gsap.fromTo(
        ".review-title",
        { opacity: 0, y: 40 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: ".review-title",
                start: "top 85%",
                toggleActions: "restart none none reset",
            },
        }
    );

    gsap.fromTo(
        ".review-desc",
        { opacity: 0, y: 40 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            delay: 0.2,
            ease: "power3.out",
            scrollTrigger: {
                trigger: ".review-desc",
                start: "top 85%",
                toggleActions: "restart none none reset",
            },
        }
    );

    gsap.fromTo(
        ".review-slider",
        { opacity: 0, y: 60 },
        {
            opacity: 1,
            y: 0,
            duration: 1.2,
            ease: "power2.out",
            scrollTrigger: {
                trigger: ".review-slider",
                start: "top 80%",
                toggleActions: "restart none none reset",
            },
        }
    );

    // Each testimonial card animation
    const testiCards = gsap.utils.toArray(".testi-item");

    testiCards.forEach((card, i) => {
        gsap.fromTo(
            card,
            { opacity: 0, scale: 0.8 },
            {
                opacity: 1,
                scale: 1,
                duration: 0.8,
                delay: i * 0.12,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: card,
                    start: "top 95%",
                    toggleActions: "restart none none reset",
                },
            }
        );
    });
});
</script>
