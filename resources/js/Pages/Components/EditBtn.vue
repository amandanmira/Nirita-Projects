<template>
    <Link
        :href="href"
        class="cursor-pointer text-yellow-600 hover:text-yellow-800 transition flex items-center gap-1"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-4 w-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M11 17l-4 4m0 0l-4-4m4 4V3"
            />
        </svg>
        Edit
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>
