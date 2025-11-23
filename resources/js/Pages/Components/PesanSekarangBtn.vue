<script setup>
import { computed } from "vue";

const props = defineProps({
    templates: Array, // dari inertia global
    templateId: Number, // template yang dipilih
    label: {
        type: String,
        default: "Pesan Sekarang",
    },
});
// console.log("template", props.templates);

const selected = computed(() => {
    return props.templates.find((t) => t.id === props.templateId);
});
</script>

<template>
    <a
        v-if="selected"
        :href="selected.link"
        target="_blank"
        class="bg-blue-500 text-white font-semibold px-6 py-2 rounded-full hover:bg-blue-600 transition"
    >
        {{ label }}
    </a>

    <span v-else class="text-red-600">
        Template ID {{ templateId }} tidak ditemukan!
    </span>
</template>
