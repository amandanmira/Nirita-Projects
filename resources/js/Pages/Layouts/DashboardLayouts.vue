<template>
    <div class="flex h-screen bg-gray-100 text-gray-800">
        <!-- Sidebar -->
        <aside
            :class="[
                'fixed md:relative z-20 bg-white shadow-lg flex flex-col justify-between transition-all duration-300',
                sidebarOpen
                    ? 'translate-x-0 w-64 h-full'
                    : '-translate-x-full md:translate-x-0 md:w-64 h-full',
            ]"
        >
            <div>
                <!-- Logo -->
                <div class="flex items-center justify-center gap-3 py-5 px-5">
                    <img :src="logo" alt="Logo" class="h-auto w-56" />
                </div>

                <!-- Menu -->
                <nav class="mx-4 mt-4">
                    <ul class="space-y-1">
                        <li v-for="menu in menus" :key="menu.label">
                            <Link
                                :href="menu.Link"
                                class="flex items-center gap-3 px-6 py-3 transition rounded-md"
                                :class="{
                                    'bg-[#0E1A47] text-white shadow-md':
                                        isActive(menu.Link),
                                    'text-gray-800 hover:bg-[#0E1A47] hover:text-white':
                                        !isActive(menu.Link),
                                }"
                            >
                                <i :class="menu.icon + ' w-5'"></i>
                                {{ menu.label }}
                            </Link>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Overlay untuk mobile -->
        <div
            v-if="sidebarOpen"
            class="fixed inset-0 bg-black opacity-40 md:hidden z-10"
            @click="sidebarOpen = false"
        ></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header
                class="flex justify-between items-center bg-white shadow-md px-6 py-4 sticky top-0 z-10"
            >
                <!-- Tombol toggle sidebar di mobile -->
                <button
                    class="md:hidden text-gray-700 text-2xl"
                    @click="sidebarOpen = !sidebarOpen"
                >
                    <i class="fas fa-bars"></i>
                </button>

                <h2 class="text-lg font-semibold hidden md:block">
                    Manajemen Kendaraan
                </h2>

                <div class="flex items-center gap-4">
                    <!-- Notifikasi -->
                    <i class="fas fa-bell text-gray-600 text-lg"></i>

                    <!-- Profil dropdown -->
                    <div class="relative">
                        <button
                            @click="toggleDropdown"
                            class="flex items-center gap-2 focus:outline-none"
                        >
                            <div
                                class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-white"
                            >
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="sm:block text-left">
                                <p class="text-sm font-medium">Admin</p>
                                <p class="text-xs text-gray-500">
                                    admin@niriliza.com
                                </p>
                            </div>
                            <i
                                class="fas fa-chevron-down text-xs text-gray-500"
                            ></i>
                        </button>

                        <!-- Dropdown menu (dengan animasi) -->
                        <transition name="fade-slide">
                            <div
                                v-if="dropdownOpen"
                                class="absolute right-0 mt-2 w-44 bg-white rounded-md shadow-lg z-20 overflow-hidden"
                            >
                                <button
                                    @click="logout"
                                    class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:text-white hover:bg-red-500 hover:shadow-lg hover:shadow-red-300 transition-all duration-300 ease-out"
                                >
                                    <i class="fas fa-sign-out-alt"></i> Keluar
                                </button>
                            </div>
                        </transition>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <slot></slot>
                <!-- <router-view /> -->
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import logo from "../Assets/Logo Nirita Rentals.png";

const sidebarOpen = ref(false);
const dropdownOpen = ref(false);

const page = usePage();

const isActive = (path) => page.url.startsWith(path); // cocok juga untuk sub-route

const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
};

const menus = [
    {
        label: "Kendaraan",
        icon: "fas fa-car-side",
        Link: "/admin/mobil",
    },
    {
        label: "Testimoni",
        icon: "fas fa-comment-dots",
        Link: "/admin/testimoni",
    },
    { label: "Invoice", icon: "fas fa-file-invoice", Link: "/admin/invoice" },
    { label: "FAQ", icon: "fas fa-question-circle", Link: "/admin/faq" },
    { label: "S&K", icon: "fas fa-file-contract", Link: "/admin/snk" },
    {
        label: "Template Pesan",
        icon: "fas fa-brands fa-whatsapp",
        Link: "/admin/template-pesan",
    },
];

const logout = () => {
    router.post("/logout");
};
</script>

<style scoped>
@import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css";

/* Animasi smooth fade-slide untuk dropdown logout */
.fade-slide-enter-active,
.fade-slide-leave-active {
    transition: all 0.3s ease;
}
.fade-slide-enter-from {
    opacity: 0;
    transform: translateY(-10px);
}
.fade-slide-enter-to {
    opacity: 1;
    transform: translateY(0);
}
.fade-slide-leave-from {
    opacity: 1;
    transform: translateY(0);
}
.fade-slide-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}

/* Hilangkan scrollbar di sidebar mobile */
::-webkit-scrollbar {
    display: none;
}
</style>
