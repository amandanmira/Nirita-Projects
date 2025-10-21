<template>
    <section class="bg-white py-12 md:py-20 px-6 md:px-16 lg:px-20">
        <div
            class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12 items-center"
        >
            <!-- Bagian Kiri: Judul dan Deskripsi -->
            <div>
                <h2
                    class="text-2xl md:text-3xl lg:text-3xl font-extrabold text-gray-900 leading-tight mb-4"
                >
                    Mengapa Kami Menjadi <br />
                    Pilihan Terbaik?
                </h2>
                <div class="w-24 h-1 bg-blue-600 mb-6"></div>
                <p class="text-gray-700 text-base leading-relaxed">
                    <span class="text-blue-600 font-semibold"
                        >Nirita Transport</span
                    >
                    menawarkan layanan yang aman, luas, dan andal untuk memenuhi
                    kebutuhan transportasi Anda. Berikut adalah tiga alasan
                    utama mengapa Anda bisa mempercayai kami.
                </p>
            </div>

            <!-- Bagian Kanan: 3 Kartu -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 lg:col-span-2 gap-6 text-center lg:text-left"
            >
                <div
                    v-for="(item, index) in reasons"
                    :key="index"
                    class="flex xs:gap-2 lg:flex-col items-center"
                >
                    <img
                        :src="item.image"
                        :alt="item.title"
                        class="w-24 h-24 object-contain mb-4 rounded-xl shadow-md"
                    />
                    <div>
                        <h3
                            class="text-center text-lg font-bold text-gray-900 mb-2"
                        >
                            {{ item.title }}
                        </h3>
                        <p
                            class="text-center text-gray-600 text-md leading-relaxed"
                        >
                            {{ item.desc }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import icon from "@/Assets/icon.webp";

const reasons = [
    {
        title: "Jaringan Nasional",
        image: icon,
        desc: "Layanan tersebar di seluruh Indonesia, siap melayani Anda di mana pun.",
    },
    {
        title: "Cover Asuransi All Risk",
        image: icon,
        desc: "Perlindungan maksimal untuk keamanan Anda di setiap perjalanan.",
    },
    {
        title: "Fleet Management",
        image: icon,
        desc: "Kendali armada yang canggih untuk efisiensi dan kenyamanan optimal.",
    },
];
</script>

<style scoped>
/* Tambahan efek halus */
img {
    transition: transform 0.3s ease;
}
img:hover {
    transform: scale(1.05);
}
</style>
