<script setup>
import Logo from "../Assets/Logo Nirita Rentals.png";
</script>

<template>
    <footer class="bg-[#0f172a] text-gray-300 py-10">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8">
            <!-- Logo & Description -->
            <div>
                <div class="flex items-center space-x-3 mb-3">
                    <img
                        :src="Logo"
                        alt="Nirita Transport"
                        class="h-10 w-auto"
                    />
                </div>
                <p class="text-sm">
                    Jasa Pelayanan Sewa Mobil,<br />
                    Biro Pariwisata Dan Bus Pariwisata
                </p>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-white font-semibold mb-3">Kontak Kami</h3>
                <p class="text-sm leading-relaxed">
                    Jl. Nuri 2B, Perumahan Gumpang Agung 1,<br />
                    Kec. Kartasura, Kabupaten Sukoharjo
                </p>
                <p class="mt-2 text-sm">
                    WhatsApp:
                    <a
                        href="https://wa.me/6281393604105"
                        class="text-blue-400 hover:underline"
                        >+62 813-9360-4105</a
                    ><br />
                    Email:
                    <a
                        href="mailto:Niritatransport.solution@gmail.com"
                        class="text-blue-400 hover:underline"
                        >Niritatransport.solution@gmail.com</a
                    >
                </p>
            </div>

            <!-- Navigation -->
            <div>
                <h3 class="text-white font-semibold mb-3">Navigasi</h3>
                <ul class="space-y-1 text-sm">
                    <li>
                        <RouterLink to="#" class="hover:text-blue-400"
                            >Beranda</RouterLink
                        >
                    </li>
                    <li>
                        <RouterLink to="#" class="hover:text-blue-400"
                            >Tentang Kami</RouterLink
                        >
                    </li>
                    <li>
                        <RouterLink to="#" class="hover:text-blue-400"
                            >Unit</RouterLink
                        >
                    </li>
                    <li>
                        <RouterLink to="#" class="hover:text-blue-400"
                            >Review</RouterLink
                        >
                    </li>
                    <li>
                        <RouterLink to="#" class="hover:text-blue-400"
                            >FAQ</RouterLink
                        >
                    </li>
                </ul>
            </div>
        </div>

        <hr class="border-gray-700 my-6 max-w-7xl mx-auto" />

        <div class="text-center text-xs text-gray-500">
            © 2025 Nirita Transport. Didesain oleh 404 Founders.
        </div>
    </footer>
</template>
