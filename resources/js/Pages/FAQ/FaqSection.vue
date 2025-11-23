<template>
    <section class="bg-white py-16 px-6 md:px-12 lg:px-18">
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
                        :key="faq.id_faq"
                        class="bg-[#0E1A47] text-white mb-2.5 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                    >
                        <button
                            class="w-full flex justify-between items-center text-left px-6 py-5 font-semibold text-lg"
                            @click="toggleLeft(index)"
                        >
                            <div class="flex items-start gap-3 mr-3">
                                <span
                                    class="text-blue-600 font-bold text-xl min-w-[40px]"
                                >
                                    {{
                                        (index + 1).toString().padStart(2, "0")
                                    }}
                                </span>
                                <span>{{ faq.pertanyaan }}</span>
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
                                    v-html="faq.jawaban"
                                    class="px-6 py-5 text-gray-700 text-base leading-relaxed bg-white"
                                ></div>
                            </div>
                        </transition>
                    </div>
                </div>

                <!-- Kolom kanan -->
                <div>
                    <div
                        v-for="(faq, index) in rightFaqs"
                        :key="faq.id_faq"
                        class="bg-[#0E1A47] text-white mb-2.5 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                    >
                        <button
                            class="w-full flex justify-between items-center text-left px-6 py-5 font-semibold text-lg"
                            @click="toggleRight(index)"
                        >
                            <div class="flex items-start gap-3 mr-3">
                                <span
                                    class="text-blue-600 font-bold text-xl min-w-[40px]"
                                >
                                    {{
                                        (index + leftFaqs.length + 1)
                                            .toString()
                                            .padStart(2, "0")
                                    }}
                                </span>
                                <span>{{ faq.pertanyaan }}</span>
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
                                    v-html="faq.jawaban"
                                    class="px-6 py-5 text-gray-700 text-base leading-relaxed bg-white"
                                ></div>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps({
    faqs: {
        type: Array,
        default: () => [],
    },
});

// Bagi data asli menjadi 2 kolom
const leftFaqs = computed(() =>
    props.faqs.slice(0, Math.ceil(props.faqs.length / 2))
);
const rightFaqs = computed(() =>
    props.faqs.slice(Math.ceil(props.faqs.length / 2))
);

// State untuk expand
const activeLeft = ref(null);
const activeRight = ref(null);

const toggleLeft = (index) => {
    activeRight.value = null;
    activeLeft.value = activeLeft.value === index ? null : index;
};

const toggleRight = (index) => {
    activeLeft.value = null;
    activeRight.value = activeRight.value === index ? null : index;
};

// Animasi transisi tinggi
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
