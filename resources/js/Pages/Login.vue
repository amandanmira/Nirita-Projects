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

                <!-- Alert error umum (jika ada) -->
                <div
                    v-if="form.errors.email || form.errors.password"
                    class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg"
                >
                    <p class="font-semibold">Login Gagal!</p>
                    <p class="text-sm">
                        Email atau password yang Anda masukkan salah.
                    </p>
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
                        :class="[
                            'w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2',
                            form.errors.email
                                ? 'border-red-500 focus:ring-red-500'
                                : 'border-gray-300 focus:ring-blue-500',
                        ]"
                        placeholder="niritaadmin@gmail.com"
                    />
                    <p
                        v-if="form.errors.email"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.email }}
                    </p>
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
                        :class="[
                            'w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2',
                            form.errors.password
                                ? 'border-red-500 focus:ring-red-500'
                                : 'border-gray-300 focus:ring-blue-500',
                        ]"
                        placeholder="masukkan kata sandi Anda"
                    />
                    <p
                        v-if="form.errors.password"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.password }}
                    </p>
                </div>
                <button
                    type="submit"
                    class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 disabled:bg-gray-400 disabled:cursor-not-allowed"
                    :disabled="form.processing"
                >
                    {{ form.processing ? "Processing..." : "Login" }}
                </button>
            </form>
        </div>
    </section>
</template>

<script setup>
import Logo from "./Assets/Logo Nirita Rentals.png";
import { useForm, router } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post("/login", {
        onSuccess: () => {
            router.push("/admin/mobil");
        },
    });
};
</script>
