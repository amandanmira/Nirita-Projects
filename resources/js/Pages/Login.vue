<template>
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">
                Masuk ke Akun Anda
            </h2>
            <form class="max-w-md mx-auto bg-gray-100 p-8 rounded-lg shadow-md">
                <div class="mb-6">
                    <label
                        for="email"
                        class="block text-gray-700 font-semibold mb-2"
                        >Email</label
                    >
                    <input
                        type="email"
                        id="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="masukkan email Anda"
                    />
                </div>
                <div class="mb-6">
                    <label
                        for="password"
                        class="block text-gray-700 font-semibold mb-2"
                        >Kata Sandi</label
                    >
                    <input
                        type="password"
                        id="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="masukkan kata sandi Anda"
                    />
                </div>
                <button
                    type="submit"
                    class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300"
                >
                    Masuk
                </button>
            </form>
        </div>
    </section>
</template>
