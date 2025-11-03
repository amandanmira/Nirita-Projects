<template>
    <section class="bg-white py-20 px-6 md:px-12 lg:px-24">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-2">FAQ</h2>
            <p class="text-black text-lg mb-12">
                Pertanyaan yang sering diajukan
            </p>

            <!-- Grid dua kolom -->
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-6 text-left">
                <!-- Kolom kiri -->
                <div>
                    <div
                        v-for="(faq, index) in leftFaqs"
                        :key="'left-' + index"
                        class="bg-[#0E1A47] text-white mb-2.5 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                    >
                        <button
                            class="w-full flex justify-between items-center text-left px-6 py-5 font-semibold text-lg"
                            @click="toggleLeft(index)"
                        >
                            <div class="flex items-start gap-3">
                                <span
                                    class="text-blue-600 font-bold text-xl min-w-[40px]"
                                >
                                    {{
                                        (index + 1).toString().padStart(2, "0")
                                    }}
                                </span>
                                <span>{{ faq.question }}</span>
                            </div>
                            <span
                                class="text-2xl font-bold transform transition-transform duration-300 text-blue-600"
                                :class="{ 'rotate-45': activeLeft === index }"
                                >+</span
                            >
                        </button>

                        <transition
                            name="faq-slide"
                            @enter="onEnter"
                            @after-enter="onAfterEnter"
                            @leave="onLeave"
                        >
                            <div
                                v-if="activeLeft === index"
                                class="overflow-hidden border-t border-gray-200"
                            >
                                <div
                                    class="px-6 py-5 text-gray-700 text-base leading-relaxed bg-white"
                                >
                                    {{ faq.answer }}
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>

                <!-- Kolom kanan -->
                <div>
                    <div
                        v-for="(faq, index) in rightFaqs"
                        :key="'right-' + index"
                        class="bg-[#0E1A47] text-white mb-2.5 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                    >
                        <button
                            class="w-full flex justify-between items-center text-left px-6 py-5 font-semibold text-lg"
                            @click="toggleRight(index)"
                        >
                            <div class="flex items-start gap-3">
                                <span
                                    class="text-blue-600 font-bold text-xl min-w-[40px]"
                                >
                                    {{
                                        (index + leftFaqs.length + 1)
                                            .toString()
                                            .padStart(2, "0")
                                    }}
                                </span>
                                <span>{{ faq.question }}</span>
                            </div>
                            <span
                                class="text-2xl font-bold transform transition-transform duration-300 text-blue-600"
                                :class="{ 'rotate-45': activeRight === index }"
                                >+</span
                            >
                        </button>

                        <transition
                            name="faq-slide"
                            @enter="onEnter"
                            @after-enter="onAfterEnter"
                            @leave="onLeave"
                        >
                            <div
                                v-if="activeRight === index"
                                class="overflow-hidden border-t border-gray-200"
                            >
                                <div
                                    class="px-5 py-4 text-gray-700 text-base leading-relaxed bg-white"
                                >
                                    {{ faq.answer }}
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>

            <!-- Tombol bantuan -->
            <div class="mt-14">
                <a
                    href="https://wa.me/6281393604105"
                    target="_blank"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-full transition"
                >
                    Butuh Bantuan Lainnya? Hubungi Kami
                </a>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from "vue";

// bagi FAQ jadi dua kolom
const leftFaqs = [
    {
        question: "Bagaimana cara melakukan pemesanan?",
        answer: "Anda dapat melakukan pemesanan melalui WhatsApp atau formulir kontak kami.",
    },
    {
        question: "Apakah bisa sewa mobil tanpa sopir?",
        answer: "Untuk saat ini hanya tersedia sewa mobil dengan sopir profesional.",
    },
    {
        question: "Apakah harga sudah termasuk BBM?",
        answer: "Harga sudah termasuk sopir, tapi belum termasuk BBM dan tol.",
    },
];

const rightFaqs = [
    {
        question: "Apakah bisa antar jemput di luar kota?",
        answer: "Tentu saja bisa, kami melayani berbagai kota di Jawa Tengah dan sekitarnya.",
    },
    {
        question: "Apakah tersedia layanan 24 jam?",
        answer: "Ya, layanan pelanggan kami aktif 24 jam setiap hari.",
    },
    {
        question: "Bagaimana metode pembayarannya?",
        answer: "Pembayaran bisa melalui transfer bank atau e-wallet.",
    },
];

// masing-masing kolom punya active sendiri
const activeLeft = ref(null);
const activeRight = ref(null);

const toggleLeft = (index) => {
    // Tutup kolom kanan saat kiri dibuka
    activeRight.value = null;
    activeLeft.value = activeLeft.value === index ? null : index;
};

const toggleRight = (index) => {
    // Tutup kolom kiri saat kanan dibuka
    activeLeft.value = null;
    activeRight.value = activeRight.value === index ? null : index;
};

// animasi transisi tinggi
const onEnter = (el) => {
    el.style.height = "0";
    el.offsetHeight;
    el.style.height = el.scrollHeight + "px";
};
const onAfterEnter = (el) => {
    el.style.height = "auto";
};
const onLeave = (el) => {
    el.style.height = el.scrollHeight + "px";
    el.offsetHeight;
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
