<template>
    <section
        class="h-screen flex items-center justify-center bg-gradient-to-t from-blue-700 to-[#101B4E]"
    >
        <div class="container mx-auto px-4">
            <form
                @submit.prevent="submit"
                class="max-w-md mx-auto bg-gray-100 p-10 rounded-lg shadow-md"
            >
                <div class="mb-6">
                    <img
                        :src="Logo"
                        alt="Logo Nirita Rentals"
                        class="w-[18rem] h-auto mx-auto"
                    />
                </div>
                <div class="mb-6">
                    <label
                        for="email"
                        class="block text-gray-700 font-semibold mb-2"
                        >Email</label
                    >
                    <input
                        v-model="form.email"
                        type="email"
                        id="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="niritaadmin@gmail.com"
                    />
                </div>
                <div class="mb-6">
                    <label
                        for="password"
                        class="block text-gray-700 font-semibold mb-2"
                        >Password</label
                    >
                    <input
                        v-model="form.password"
                        type="password"
                        id="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="masukkan kata sandi Anda"
                    />
                </div>
                <button
                    type="submit"
                    class="cursor-pointer w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300"
                    :disabled="form.processing"
                >
                    Login
                </button>
            </form>
        </div>
    </section>
</template>

<script setup>
import Logo from "./Assets/Logo Nirita Rentals.png";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post("/login", {
        onSuccess: () => {
            // Redirect handled by Laravel controller
        },
    });
};
</script>
