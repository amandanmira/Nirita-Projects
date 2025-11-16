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

<style scoped>
@import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css";
</style>
