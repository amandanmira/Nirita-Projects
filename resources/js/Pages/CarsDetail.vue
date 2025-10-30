<template>
    <MainLayout>
        <CarsDetail />
        <DaftarPaket />
        <Kalkulasi />
        <CarsRekom />
    </MainLayout>
</template>

<script setup>
import MainLayout from "../Layouts/MainLayouts.vue";
import CarsDetail from "../CarsDetail/CarsDetails.vue";
import DaftarPaket from "../CarsDetail/DaftarPaket.vue";
import Kalkulasi from "../CarsDetail/Kalkulasi.vue";
import CarsRekom from "../CarsDetail/CarsRekom.vue";
</script>
