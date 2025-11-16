<script setup>
import { computed } from "vue";

const props = defineProps({
    templates: Array, // dari inertia global
    templateId: Number, // template yang dipilih
    label: {
        type: String,
        default: "Contact Us",
    },
});
console.log("template", props.templates);

const selected = computed(() => {
    return props.templates.find((t) => t.id === props.templateId);
});
</script>

<template>
    <a
        v-if="selected"
        :href="selected.link"
        target="_blank"
        class="cursor-pointer inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full"
    >
        {{ label }}
    </a>

    <span v-else class="text-red-600">
        Template ID {{ templateId }} tidak ditemukan!
    </span>
</template>
