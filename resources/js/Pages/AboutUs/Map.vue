<template>
    <section class="bg-gray-200 py-12 md:px-14">
        <div
            class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 items-center"
        >
            <!-- Left Side: Contact Info -->
            <div>
                <h2 class="text-2xl font-semibold mb-2 text-gray-900">
                    Contact Us
                </h2>
                <p class="text-gray-600 mb-6">
                    Siap merencanakan perjalanan Anda? Hubungi atau Temukan kami
                    untuk penawaran terbaik.
                </p>

                <div class="space-y-4 text-gray-700">
                    <!-- Phone -->
                    <div class="flex items-center gap-16">
                        <h3 class="font-semibold text-gray-900">Phone</h3>
                        <ul class="space-y-1 text-sm">
                            <li>• +62 813-9360-4105</li>
                            <li>• +62 813-3796-8626</li>
                        </ul>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center gap-18">
                        <h3 class="font-semibold text-gray-900">Email</h3>
                        <p class="text-sm">
                            Niritatransport.solution@gmail.com
                        </p>
                    </div>

                    <!-- Address -->
                    <div class="flex items-center gap-14">
                        <h3 class="font-semibold text-gray-900">Address</h3>
                        <p class="text-sm leading-relaxed">
                            Perum Gumpang Agung 1, Jl. Nuri 2B, Kel. Gumpang,
                            Kec. Kartasura,<br />
                            Kab. Sukoharjo, Jawa Tengah
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Google Maps -->
            <div
                class="w-full h-[350px] md:h-[400px] rounded-xl overflow-hidden shadow-md"
            >
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3079.5961744746246!2d110.7561023736799!3d-7.567711892446361!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a14ff6bbd1dc9%3A0xead4029d576f04e4!2sNirita%20Transport%20%26%20Bakmi%20Jowo%20bu%20Hari!5e1!3m2!1sid!2sid!4v1761795625494!5m2!1sid!2sid"
                    width="100%"
                    height="100%"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
        </div>
    </section>
</template>

<script setup>
// Tidak perlu logic khusus, ini hanya section statis
</script>

<style scoped>
/* Tambahan opsional agar tampilan lembut */
section {
    scroll-margin-top: 80px; /* jika ada navbar */
}
</style>
