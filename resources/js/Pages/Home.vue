<template>
    <MainLayout>
        <HeroSection />
        <WhyChooseUs />
        <CarsSection />
        <ReviewSection />
        <FaqSection />
    </MainLayout>
</template>

<script setup>
import MainLayout from "./Layouts/MainLayouts.vue";
import HeroSection from "./LandingPage/HeroSection.vue";
import WhyChooseUs from "./LandingPage/WhyChooseUs.vue";
import FaqSection from "./LandingPage/FaqSection.vue";
import CarsSection from "./LandingPage/CarsSection.vue";
import ReviewSection from "./LandingPage/ReviewSection.vue";
</script>
