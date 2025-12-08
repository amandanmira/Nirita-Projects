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
        class="bg-blue-600 px-5 py-3 rounded-lg flex items-center justify-center hover:bg-blue-700"
    >
        <i class="fa-solid fa-phone text-2xl mr-2"></i>
        Hubungi
    </a>

    <span v-else class="text-red-600">
        Template ID {{ templateId }} tidak ditemukan!
    </span>
</template>
