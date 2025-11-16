<template>
    <MainLayout>
        <Testimoni :testimonials="testimonials" />
    </MainLayout>
</template>

<script setup>
import MainLayout from "./Layouts/MainLayouts.vue";
import Testimoni from "./Review/Testimoni.vue";

const props = defineProps({
    testimonials: {
        type: Array,
        default: () => [],
    },
});
</script>
