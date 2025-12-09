<template>
    <section class="bg-white py-16 px-6 md:px-12 lg:px-18">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="faq-title text-3xl font-bold mb-2 opacity-0">FAQ</h2>
            <p class="faq-desc text-black text-lg mb-12 opacity-0">
                Pertanyaan yang sering diajukan
            </p>

            <!-- Grid dua kolom -->
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-6 text-left">
                <!-- Kolom kiri -->
                <div>
                    <div
                        v-for="(faq, index) in leftFaqs"
                        :key="faq.id_faq"
                        class="faq-item bg-[#0E1A47] text-white mb-2.5 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl opacity-0"
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
                                    class="cke_editable px-6 py-5 text-gray-700 text-base leading-relaxed bg-white"
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
                        class="faq-item bg-[#0E1A47] text-white mb-2.5 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl opacity-0"
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
                                    class="cke_editable px-6 py-5 text-gray-700 text-base leading-relaxed bg-white"
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
import { ref, computed, onMounted } from "vue";
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

const props = defineProps({
    faqs: {
        type: Array,
        default: () => [],
    },
});

// Split FAQ data
const leftFaqs = computed(() =>
    props.faqs.slice(0, Math.ceil(props.faqs.length / 2))
);
const rightFaqs = computed(() =>
    props.faqs.slice(Math.ceil(props.faqs.length / 2))
);

// Expand state
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

// Height transition
const onEnter = (el) => {
    el.style.height = "0";
    el.offsetHeight;
    el.style.height = el.scrollHeight + "px";
};
const onAfterEnter = (el) => (el.style.height = "auto");
const onLeave = (el) => {
    el.style.height = el.scrollHeight + "px";
    el.offsetHeight;
    el.style.height = "0";
};

// GSAP animations
onMounted(() => {
    // Title animation
    gsap.fromTo(
        ".faq-title",
        { opacity: 0, y: 40 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: ".faq-title",
                start: "top 85%",
                toggleActions: "restart none none reset",
            },
        }
    );

    // Description animation
    gsap.fromTo(
        ".faq-desc",
        { opacity: 0, y: 40 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            delay: 0.15,
            ease: "power3.out",
            scrollTrigger: {
                trigger: ".faq-desc",
                start: "top 85%",
                toggleActions: "restart none none reset",
            },
        }
    );

    // FAQ items animation
    gsap.utils.toArray(".faq-item").forEach((item, i) => {
        gsap.fromTo(
            item,
            { opacity: 0, y: 50 },
            {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: i * 0.15,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: item,
                    start: "top 95%",
                    toggleActions: "restart none none reset",
                },
            }
        );
    });
});
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

/* CKEditor Content Styling - Scoped hanya untuk konten FAQ */
/* Override Tailwind CSS reset untuk list styles */
:deep(.cke_editable) {
    color: #374151;

    /* Text formatting */
    strong,
    b {
        font-weight: 700;
        color: #1f2937;
    }

    em,
    i {
        font-style: italic;
    }

    u {
        text-decoration: underline;
    }

    s,
    strike {
        text-decoration: line-through;
    }

    /* Lists - Override Tailwind reset */
    ul,
    ol {
        display: block;
        margin: 1rem 0;
        padding-left: 2rem;
    }

    ul {
        list-style-type: disc;
        list-style-position: outside;
    }

    ol {
        list-style-type: decimal;
        list-style-position: outside;
    }

    li {
        display: list-item;
        margin: 0.5rem 0;
        line-height: 1.6;
    }

    /* Nested lists */
    ul ul {
        list-style-type: circle;
        margin: 0.5rem 0;
    }

    ol ol {
        list-style-type: lower-alpha;
        margin: 0.5rem 0;
    }

    ul ol {
        list-style-type: lower-roman;
        margin: 0.5rem 0;
    }

    /* Paragraphs */
    p {
        margin: 0.75rem 0;
        line-height: 1.6;
    }

    p:first-child {
        margin-top: 0;
    }

    p:last-child {
        margin-bottom: 0;
    }
}
</style>
