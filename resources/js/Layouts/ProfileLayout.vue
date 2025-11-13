<script setup lang="ts">
import { Head } from '@inertiajs/vue3'

import Navbar from '@/Pages/Landing/Partials/Navbar.vue'
import SidebarProfile from '../Pages/Landing/Profile/Partials/SidebarProfile.vue'
import Chatbot from '../Pages/Landing/Chatbot/Chatbot.vue'
import Footer from '../Pages/Landing/Partials/Footer.vue'
</script>

<template>
    <Head title="Perfil" />
    <div class="min-h-screen font-sans antialiased flex flex-col bg-gray-50 dark:bg-[#0B1320]">
        <!-- Navbar -->
        <Navbar />

        <div class="flex flex-1">
            <!-- Sidebar -->
            <SidebarProfile />

            <!-- Contenido principal -->
            <main
                class="flex-1 p-10 bg-white text-gray-800
                       dark:bg-[#0E1A2B] dark:text-gray-300
                       transition-colors duration-300"
            >
                <slot></slot>
            </main>
        </div>

        <Footer />
        <Chatbot />
    </div>
</template>

<style>
/* Animaciones opcionales */
.slide-left-enter-active,
.slide-right-enter-active,
.slide-up-enter-active {
    transition: all 0.7s ease;
}

.slide-left-enter-from {
    opacity: 0;
    transform: translateX(-50px);
}
.slide-left-enter-to {
    opacity: 1;
    transform: translateX(0);
}

.slide-right-enter-from {
    opacity: 0;
    transform: translateX(50px);
}
.slide-right-enter-to {
    opacity: 1;
    transform: translateX(0);
}

.slide-up-enter-from {
    opacity: 0;
    transform: translateY(50px);
}
.slide-up-enter-to {
    opacity: 1;
    transform: translateY(0);
}
</style>
