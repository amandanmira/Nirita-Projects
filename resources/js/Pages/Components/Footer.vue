<script setup>
import { Link } from "@inertiajs/vue3";
import Logo from "../Assets/Logo Nirita Rentals.png";
</script>

<template>
    <footer class="bg-[#0f172a] text-gray-300 py-10 md:px-14">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-8">
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
                    Jl. Nuri 2B, Perumahan Gumpang Agung 1, Kec. Kartasura,
                    Kabupaten Sukoharjo
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

            <!-- Jam Operasional -->
            <div>
                <h3 class="text-white font-semibold mb-3">Jam Operasional</h3>
                <p class="mt-2 text-sm">
                    Senin - Minggu: 08.00 - 12.00 WIB & 17.00 - 24.00 WIB
                    (Offline)
                </p>
                <p class="mt-2 text-sm">
                    Senin - Minggu: 05.00 - 22.30 WIB (Via Wa)
                </p>
            </div>

            <!-- Navigation -->
            <div>
                <h3 class="text-white font-semibold mb-3">Navigasi</h3>
                <ul class="space-y-1 text-sm flex gap-3 md:flex-col md:gap-0">
                    <li>
                        <Link href="/" class="hover:text-blue-400">Home</Link>
                    </li>
                    <li>
                        <Link href="/about" class="hover:text-blue-400"
                            >About</Link
                        >
                    </li>
                    <li>
                        <Link href="/units" class="hover:text-blue-400"
                            >Units</Link
                        >
                    </li>
                    <li>
                        <Link href="/review" class="hover:text-blue-400"
                            >Review</Link
                        >
                    </li>
                    <li>
                        <Link href="/tnc" class="hover:text-blue-400"
                            >Term and Condition</Link
                        >
                    </li>
                    <li>
                        <Link href="/faq" class="hover:text-blue-400">FAQ</Link>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="border-gray-700 my-6 max-w-7xl mx-auto" />

        <div class="text-center text-xs text-gray-500">
            © 2025 Nirita Transport.
        </div>
    </footer>
</template>
