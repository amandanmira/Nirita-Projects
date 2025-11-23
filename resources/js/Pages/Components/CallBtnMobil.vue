<script setup>
import { computed } from "vue";

const props = defineProps({
    templates: {
        type: Array,
        required: true,
        default: () => [],
    },
    templateId: [Number, String],
    label: {
        type: String,
    },
    carName: {
        type: String,
        default: "",
    },
});

// Ambil template sesuai ID
const selected = computed(() => {
    if (!Array.isArray(props.templates)) return null;
    const idToFind = Number(props.templateId);
    return props.templates.find((t) => Number(t.id) === idToFind);
});

// ===============================
// Tambahkan carName ke dalam link
// ===============================
const finalLink = computed(() => {
    if (!selected.value?.link) return "";

    const url = new URL(selected.value.link);
    const currentText = decodeURIComponent(url.searchParams.get("text") || "");

    // tambahkan nama mobil
    const newText = `${currentText} ${props.carName}`;

    url.searchParams.set("text", newText);

    return url.toString();
});
</script>

<template>
    <a
        v-if="selected"
        :href="finalLink"
        target="_blank"
        class="cursor-pointer flex items-center justify-center bg-blue-600 text-white rounded-r-md px-3 py-2 border border-transparent hover:bg-white hover:text-black hover:border-black transition"
    >
        <i class="fa-solid fa-phone"></i>
    </a>

    <span v-else class="text-red-600">
        Template ID {{ templateId }} tidak ditemukan!
    </span>
</template>
