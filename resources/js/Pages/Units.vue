<template>
    <MainLayout>
        <!-- <CarsUnits /> -->
        <CarsUnits2 :cars="cars" />
    </MainLayout>
</template>

<script setup>
import MainLayout from "./Layouts/MainLayouts.vue";
import CarsUnits2 from "./Units/CarsUnits2.vue";

const props = defineProps({
    cars: Array,
});
</script>
