<template>
    <MainLayouts>
        <FaqSection :faqs="faqs" />
    </MainLayouts>
</template>

<script setup>
import MainLayouts from "./Layouts/MainLayouts.vue";
import FaqSection from "./FAQ/FaqSection.vue";

const props = defineProps({
    faqs: Array,
});
</script>
