<template>
    <section class="bg-white py-18 px-6 md:px-16 lg:px-24">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Header -->
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                FAQ
            </h2>
            <p class="text-gray-900 text-lg mb-8">
                Pertanyaan yang sering diajukan
            </p>

            <!-- FAQ List -->
            <div class="border rounded-md text-left">
                <div
                    v-for="(faq, index) in faqs"
                    :key="faq.id"
                    class="border-t first:border-t-0 overflow-hidden transition-all duration-300"
                >
                    <!-- Pertanyaan -->
                    <button
                        class="w-full flex justify-between items-center px-4 py-3 text-left text-gray-800 font-medium hover:bg-gray-50"
                        @click="toggleFAQ(index)"
                    >
                        <span>{{ faq.question }}</span>
                        <span
                            class="text-xl font-bold transform transition-transform duration-300"
                            :class="{
                                'rotate-45 text-blue-600':
                                    activeIndex === index,
                            }"
                        >
                            +
                        </span>
                    </button>

                    <!-- Jawaban -->
                    <transition
                        name="faq-slide"
                        @enter="onEnter"
                        @after-enter="onAfterEnter"
                        @leave="onLeave"
                    >
                        <div
                            v-if="activeIndex === index"
                            class="overflow-hidden border-t"
                        >
                            <div
                                class="px-4 py-4 text-gray-600 text-sm bg-gray-50"
                            >
                                {{ faq.answer }}
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
            <div class="mt-10">
                <a
                    href="https://wa.me/6281393604105"
                    target="_blank"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-full transition"
                >
                    Butuh Bantuan Lainnya? Hubungi Kami
                </a>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from "vue";

// Data dummy FAQ
const faqs = [
    {
        id: 1,
        question: "Bagaimana cara melakukan pemesanan?",
        answer: "Anda dapat melakukan pemesanan melalui WhatsApp atau mengisi formulir kontak pada halaman kami.",
    },
    {
        id: 2,
        question: "Apakah bisa sewa mobil tanpa sopir?",
        answer: "Untuk saat ini layanan kami hanya menyediakan sewa mobil dengan sopir profesional demi keamanan dan kenyamanan Anda.",
    },
    {
        id: 3,
        question: "Apakah harga sudah termasuk BBM?",
        answer: "Harga yang kami tawarkan sudah termasuk jasa sopir namun belum termasuk BBM dan biaya tol.",
    },
    {
        id: 4,
        question: "Apakah bisa antar jemput di luar kota?",
        answer: "Tentu bisa! Kami melayani antar-jemput dari dan ke berbagai kota di wilayah Jawa Tengah dan sekitarnya.",
    },
    {
        id: 5,
        question: "Apakah tersedia layanan 24 jam?",
        answer: "Ya, layanan pelanggan kami siap membantu Anda selama 24 jam setiap hari.",
    },
];

// Menyimpan index FAQ yang sedang dibuka
const activeIndex = ref(null);

const toggleFAQ = (index) => {
    activeIndex.value = activeIndex.value === index ? null : index;
};

// Fungsi untuk animasi smooth
const onEnter = (el) => {
    el.style.height = "0";
    el.offsetHeight; // trigger reflow
    el.style.height = el.scrollHeight + "px";
};

const onAfterEnter = (el) => {
    el.style.height = "auto";
};

const onLeave = (el) => {
    el.style.height = el.scrollHeight + "px";
    el.offsetHeight; // trigger reflow
    el.style.height = "0";
};
</script>

<style scoped>
.faq-slide-enter-active,
.faq-slide-leave-active {
    transition: height 0.3s ease-in-out;
    overflow: hidden;
}

.faq-slide-enter-from,
.faq-slide-leave-to {
    height: 0;
}
</style>
