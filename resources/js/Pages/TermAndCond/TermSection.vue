<script setup>
import MainLayout from "../Layouts/MainLayouts.vue";

const props = defineProps({
    tncs: Array,
});
</script>

<template>
    <MainLayout>
        <section class="py-16 px-4 bg-gray-50 text-gray-800">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-3 text-gray-900">
                    Syarat & Ketentuan
                </h2>
                <p class="text-gray-600 leading-relaxed">
                    Selamat datang di layanan rental mobil kami. Sebelum
                    melakukan pemesanan, harap membaca dan memahami syarat serta
                    ketentuan berikut ini. Dengan melakukan pemesanan, Anda
                    dianggap telah menyetujui seluruh ketentuan yang berlaku.
                </p>
            </div>

            <div
                class="space-y-6 max-w-4xl mx-auto bg-gradient-to-t from-[#101B4E] to-[#173A84] p-12 rounded-2xl"
            >
                <div
                    v-for="term in props.tncs"
                    class="efek-hover bg-white rounded-xl p-6"
                >
                    <h3 class="text-lg md:text-xl font-bold mb-3">
                        {{ term.judul }}
                    </h3>
                    <div
                        v-html="term.deskripsi"
                        class="text-gray-700 leading-relaxed"
                    ></div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style scoped>
.efek-hover:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
}
</style>
