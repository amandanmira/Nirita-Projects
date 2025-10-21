<template>
    <div class="flex h-screen bg-gray-100 text-gray-800">
        <!-- Sidebar -->
        <aside
            class="w-64 bg-white shadow-lg flex flex-col justify-between fixed md:relative z-10"
        >
            <div>
                <!-- Logo -->
                <div
                    class="flex items-center justify-center gap-3 py-5 px-5 border-b"
                >
                    <img :src="logo" alt="Logo" class="h-auto w-56" />
                </div>

                <!-- Menu -->
                <nav class="mt-6">
                    <ul class="space-y-1">
                        <li>
                            <a
                                href="#"
                                class="flex items-center gap-3 px-6 py-3 hover:bg-[#0E1A47] hover:text-white transition rounded-md"
                            >
                                <i class="fas fa-car-side w-5"></i>
                                Kendaraan
                            </a>
                        </li>
                        <li>
                            <a
                                href="#"
                                class="flex items-center gap-3 px-6 py-3 hover:bg-[#0E1A47] hover:text-white transition rounded-md"
                            >
                                <i class="fas fa-comment-dots w-5"></i>
                                Testimoni
                            </a>
                        </li>
                        <li>
                            <a
                                href="#"
                                class="flex items-center gap-3 px-6 py-3 hover:bg-[#0E1A47] hover:text-white transition rounded-md"
                            >
                                <i class="fas fa-question-circle w-5"></i>
                                FAQ
                            </a>
                        </li>
                        <li>
                            <a
                                href="#"
                                class="flex items-center gap-3 px-6 py-3 hover:bg-[#0E1A47] hover:text-white transition rounded-md"
                            >
                                <i class="fas fa-file-invoice w-5"></i>
                                Invoice
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Logout -->
            <div class="p-6 border-t">
                <button
                    class="w-full flex items-center justify-center gap-2 bg-red-100 text-red-600 hover:bg-red-200 py-2 rounded-lg transition"
                >
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header
                class="flex justify-between items-center bg-white shadow-md px-6 py-6"
            >
                <h2 class="text-lg font-semibold">Manajemen Kendaraan</h2>
                <div class="flex items-center gap-5">
                    <button
                        class="flex items-center gap-2 bg-[#0E1A47] text-white px-4 py-2 rounded-md hover:bg-[#1c2b6c] transition"
                    >
                        <i class="fas fa-plus"></i> Tambah Kendaraan
                    </button>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-bell text-gray-600 text-lg"></i>
                        <div class="flex items-center gap-2">
                            <div
                                class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-white"
                            >
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Admin</p>
                                <p class="text-xs text-gray-500">
                                    admin@niriliza.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-8 overflow-y-auto">
                <!-- Nanti isi di sini -->
                <div
                    class="h-full border-2 border-dashed border-gray-300 rounded-xl flex items-center justify-center text-gray-400"
                >
                    Konten Dashboard di sini
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import logo from "../Assets/Logo Nirita Rentals.png";
</script>

<style scoped>
@import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css";
</style>
