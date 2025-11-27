<script setup>
import { ref, onMounted } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { gsap } from "gsap";
import logo from "../Assets/Logo Nirita Rentals.png";
import NavContactUsBtn from "./NavContactUsBtn.vue";

const page = usePage();
const waTemplates = page.props.waTemplates;

// const page = usePage();
// const waLink = page.props.waLink;
// const template = page.props.template;

// console.log("WA LINK:", page.props.waLink);

const menuOpen = ref(false);

const menus = [
    {
        label: "Home",
        Link: "/",
    },
    {
        label: "About",
        Link: "/about",
    },
    { label: "Units", Link: "/units" },
    { label: "Review", Link: "/review" },
    { label: "Terms and Condition", Link: "/tnc" },
    {
        label: "FAQ",
        Link: "/faq",
    },
];

// Function sederhana untuk cek active halaman
const isActive = (path) => page.url === path;

const navbar = ref(null);
onMounted(() => {
    gsap.from(navbar.value, {
        duration: 1,
        opacity: 0,
        y: -100,
        ease: "power3.out",
    });
});

const toggleMenu = () => (menuOpen.value = !menuOpen.value);
</script>

<template>
    <header
        ref="navbar"
        class="sticky top-0 z-50 bg-white shadow-md md:px-16 lg:px-18"
    >
        <div
            class="max-w-7xl mx-auto flex justify-between items-center py-3 px-4 md:px-0"
        >
            <!-- Logo -->
            <div class="flex-shrink-0">
                <img :src="logo" alt="Nirita Transport" class="h-10 w-auto" />
            </div>

            <!-- Nav Links (center di desktop) -->
            <nav
                class="hidden md:flex flex-1 justify-center space-x-6 text-gray-800 font-medium"
            >
                <Link
                    v-for="link in menus"
                    :key="link.Link"
                    :href="link.Link"
                    class="relative group py-2"
                    :class="{
                        'text-blue-600 font-semibold after:content-[\'\'] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[3px] after:bg-blue-600 after:rounded-full':
                            isActive(link.Link),
                    }"
                >
                    {{
                        link.label.charAt(0).toUpperCase() + link.label.slice(1)
                    }}
                </Link>
            </nav>

            <!-- Contact Button (kanan desktop) -->
            <div class="hidden md:block">
                <NavContactUsBtn
                    :templates="waTemplates"
                    :templateId="3"
                    label="Contact Us"
                />
            </div>

            <!-- Mobile Menu Button -->
            <button @click="toggleMenu" class="md:hidden text-gray-700">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <transition name="slide-left">
            <div
                v-if="menuOpen"
                class="md:hidden bg-white border-t border-gray-200 px-5 pb-4"
            >
                <Link
                    v-for="link in menus"
                    :key="link.Link"
                    :href="link.Link"
                    class="block py-2 font-semibold transition"
                    :class="[
                        selected === link.Link || isActive(link.Link)
                            ? 'text-blue-600'
                            : 'text-gray-700 hover:text-blue-600',
                    ]"
                    @click="
                        selected = link.Link;
                        menuOpen = false;
                    "
                >
                    {{
                        link.label.charAt(0).toUpperCase() + link.label.slice(1)
                    }}
                </Link>

                <NavContactUsBtn
                    class="mt-2 w-full text-center"
                    :templates="waTemplates"
                    :templateId="3"
                    label="Contact Us"
                />
            </div>
        </transition>
    </header>
</template>

<style scoped>
header {
    font-family: Poppins, sans-serif;
}
/* MENU MASUK */
.slide-left-enter-from {
    transform: translateX(-100%);
    opacity: 0;
}

.slide-left-enter-active {
    transition: all 0.3s ease;
}

.slide-left-enter-to {
    transform: translateX(0);
    opacity: 1;
}

/* MENU KELUAR */
.slide-left-leave-from {
    transform: translateX(0);
    opacity: 1;
}

.slide-left-leave-active {
    transition: all 0.3s ease;
}

.slide-left-leave-to {
    transform: translateX(-100%);
    opacity: 0;
}

/* Underline animasi modern */
nav .group::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 2px;
    width: 0;
    background: transparent;
    transition: all 0.3s ease;
}

/* Hover muncul underline */
nav .group:hover::after {
    width: 100%;
    background: #2563eb; /* biru tailwind */
}

/* Jika active route */
nav .group.after\:w-full::after {
    width: 100%;
}
</style>
