<template>
    <section class="bg-white py-16 px-6 md:px-12 lg:px-20">
        <div class="max-w-7xl mx-auto text-center">
            <!-- Judul -->
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-3">
                Testimoni Pelanggan
            </h2>

            <!-- Deskripsi -->
            <p class="text-gray-700 text-lg max-w-3xl mx-auto mb-10">
                Lihatlah apa yang pelanggan kami katakan tentang layanan kami.
                Kepuasan Anda adalah prioritas utama kami.
            </p>

            <!-- Wrapper -->
            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-10">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
                >
                    <div
                        v-for="item in props.testimonials"
                        :key="item.id_testimoni"
                        class="bg-gradient-to-t from-[#101B4E] to-[#173A84] p-4 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition transform hover:-translate-y-1"
                    >
                        <img
                            :src="`storage/${item.url_gambar}`"
                            :alt="item.desk_testimoni"
                            class="w-full h-48 object-cover rounded-lg"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// import reviews from "../data/testimoni.js";

const props = defineProps({
    testimonials: {
        type: Array,
        default: () => [],
    },
});

// Helper function untuk resolve path gambar dengan Vite
const getImage = (path) => {
    return new URL(path, import.meta.url).href;
};
</script>
