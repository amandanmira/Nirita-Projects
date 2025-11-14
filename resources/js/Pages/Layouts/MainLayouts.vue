<template>
    <div class="flex flex-col min-h-screen">
        <!-- Navbar -->
        <Navbar />

        <!-- Konten dinamis -->
        <main class="flex-1">
            <slot />
        </main>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import Navbar from "../Components/Navbar.vue";
import Footer from "../Components/Footer.vue";
</script>
