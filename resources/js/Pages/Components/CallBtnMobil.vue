<script setup>
import { computed } from "vue";

const props = defineProps({
    car : Object,
    templates: Array, // dari inertia global
    templateId: Number, // template yang dipilih
    label: {
        type: String,
        default: "Contact Us",
    },
});

const selected = computed(() => {
    return props.templates.find((t) => t.id === props.templateId);
});
</script>

<template>
    <a
        v-if="selected"
        :href="selected.link"
        target="_blank"
        class="flex items-center justify-center bg-blue-600 text-white rounded-r-md px-4 py-4 hover:bg-black transition"
    >
        <i class="fa-solid fa-phone"></i>
    </a>

    <span v-else class="text-red-600">
        Template ID {{ templateId }} tidak ditemukan!
    </span>
</template>
