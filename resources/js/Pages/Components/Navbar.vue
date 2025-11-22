<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
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
    { label: "Term and Condition", Link: "/tnc" },
    {
        label: "FAQ",
        Link: "/faq",
    },
];

const toggleMenu = () => (menuOpen.value = !menuOpen.value);
</script>

<template>
    <header class="sticky top-0 z-50 bg-white shadow-md md:px-16 lg:px-18">
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
                    class="hover:text-blue-600 font-medium transition"
                    active-class="text-blue-600 font-medium"
                >
                    {{
                        link.label.charAt(0).toUpperCase() + link.label.slice(1)
                    }}
                </Link>
            </nav>

            <!-- Contact Button (kanan desktop) -->
            <div class="hidden md:block">
                <!-- <a
                    :href="waLink"
                    target="_blank"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium px-5 py-2 rounded-full transition inline-flex items-center gap-2"
                >
                    Contact Us
                </a> -->
                <NavContactUsBtn
                    :templates="waTemplates"
                    :templateId="1"
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
        <transition name="fade">
            <div
                v-if="menuOpen"
                class="md:hidden bg-white border-t border-gray-200 px-6 pb-4 space-y-2"
            >
                <RouterLink
                    v-for="link in links"
                    :key="link.path"
                    :to="link.path"
                    class="block py-2 text-gray-800 hover:text-blue-600"
                    active-class="text-blue-600 font-semibold"
                    @click="menuOpen = false"
                >
                    {{ link.name.charAt(0).toUpperCase() + link.name.slice(1) }}
                </RouterLink>

                <!-- <a
                    :href="waLink"
                    target="_blank"
                    class="block bg-green-600 hover:bg-green-700 text-white text-center font-medium px-4 py-2 rounded-full mt-2"
                >
                    Contact Us
                </a> -->
                <NavContactUsBtn
                    :templates="waTemplates"
                    :templateId="1"
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
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
