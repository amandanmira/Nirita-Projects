<template>
    <section class="bg-white py-16 px-6 md:px-12 lg:px-20">
        <div class="max-w-7xl mx-auto text-center">
            <!-- Judul -->
            <h2
                class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-3 opacity-0 translate-y-5 titleAnim"
            >
                Testimoni Pelanggan
            </h2>

            <!-- Deskripsi -->
            <p
                class="text-gray-700 text-lg max-w-3xl mx-auto mb-10 opacity-0 translate-y-5 descAnim"
            >
                Lihatlah apa yang pelanggan kami katakan tentang layanan kami.
                Kepuasan Anda adalah prioritas utama kami.
            </p>

            <!-- Wrapper -->
            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-10">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
                >
                    <div
                        v-for="(item, index) in props.testimonials"
                        :key="item.id_testimoni"
                        class="testiCard bg-gradient-to-t from-[#101B4E] to-[#173A84] p-4 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition transform hover:-translate-y-1 cursor-pointer"
                        @click="openPreview(`storage/${item.url_gambar}`)"
                    >
                        <img
                            :src="`storage/${item.url_gambar}`"
                            :alt="item.desk_testimoni"
                            class="w-full h-48 object-cover rounded-lg"
                        />
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Preview -->
        <div
            v-if="previewImage"
            class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4"
            @click="closePreview"
        >
            <div @click.stop class="relative">
                <img
                    :src="previewImage"
                    class="rounded-lg max-h-[90vh] max-w-[90vw] object-contain"
                />
                <button
                    @click="closePreview"
                    class="absolute top-4 right-4 bg-black/60 hover:bg-black/80 text-white rounded-full p-2 transition"
                    aria-label="Tutup preview"
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
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
import { onMounted } from "vue";
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);
import { ref } from "vue";

const props = defineProps({
    testimonials: {
        type: Array,
        default: () => [],
    },
});

onMounted(() => {
    // Judul animasi
    gsap.fromTo(
        ".titleAnim",
        { opacity: 0, y: 30 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: ".titleAnim",
                start: "top 85%",
                toggleActions: "restart none none reset",
            },
        }
    );

    // Deskripsi animasi
    gsap.fromTo(
        ".descAnim",
        { opacity: 0, y: 30 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            delay: 0.2,
            ease: "power3.out",
            scrollTrigger: {
                trigger: ".descAnim",
                start: "top 85%",
                toggleActions: "restart none none reset",
            },
        }
    );

    // Card testimonial animasi stagger
    gsap.utils.toArray(".testiCard").forEach((card, i) => {
        gsap.fromTo(
            card,
            { opacity: 0, scale: 0.9 },
            {
                opacity: 1,
                scale: 1,
                duration: 1,
                delay: i * 0.15,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: card,
                    start: "top 90%",
                    toggleActions: "restart none none reset",
                },
            }
        );
    });
});
const previewImage = ref(null);

const openPreview = (imageUrl) => {
    previewImage.value = imageUrl;
    document.body.classList.add("overflow-hidden");
};

const closePreview = () => {
    previewImage.value = null;
    document.body.classList.remove("overflow-hidden");
};

// Helper function untuk resolve path gambar dengan Vite
const getImage = (path) => {
    return new URL(path, import.meta.url).href;
};
</script>

<style scoped>
section {
    scroll-margin-top: 80px;
}
</style>
