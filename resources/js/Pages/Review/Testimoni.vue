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
                        class="testiCard bg-gradient-to-t from-[#101B4E] to-[#173A84] p-4 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition transform hover:-translate-y-1 opacity-0 scale-90"
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
    </section>
</template>

<script setup>
import { onMounted } from "vue";
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

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
</script>

<style scoped>
section {
    scroll-margin-top: 80px;
}
</style>
