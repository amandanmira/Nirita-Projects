<template>
    <MainLayout>
        <CarsDetail :cars="cars" />
        <DaftarPaket :cars="cars" />
        <Kalkulasi :cars="cars" />
        <CarsRekom :units="props.carsRekom" />
    </MainLayout>
</template>

<script setup>
import MainLayout from "./Layouts/MainLayouts.vue";
import CarsDetail from "./CarsDetail/CarsDetails.vue";
import DaftarPaket from "./CarsDetail/DaftarPaket.vue";
import Kalkulasi from "./CarsDetail/Kalkulasi.vue";
import CarsRekom from "./CarsDetail/CarsRekom.vue";

const props = defineProps({
    cars: Array,
    carsRekom: Array,
});
</script>
