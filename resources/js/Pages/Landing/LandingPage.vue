<script setup lang="ts">
import { Head } from '@inertiajs/vue3'

import BrandSlider from '@/Pages/Landing/Partials/BrandSlider.vue'
import BulletPoints from '@/Pages/Landing/Partials/BulletPoints.vue'
import HeroSection from '@/Pages/Landing/Partials/HeroSection.vue'
import Navbar from '@/Pages/Landing/Partials/Navbar.vue'
import Services from '@/Pages/Landing/Partials/Services.vue'

import Footer from './Partials/Footer.vue'
</script>

<style>
/* Common transition style */
.slide-left-enter-active,
.slide-right-enter-active,
.slide-up-enter-active {
    transition: all 0.7s ease;
}

/* Slide from left */
.slide-left-enter-from {
    opacity: 0;
    transform: translateX(-50px);
}
.slide-left-enter-to {
    opacity: 1;
    transform: translateX(0);
}

/* Slide from right */
.slide-right-enter-from {
    opacity: 0;
    transform: translateX(50px);
}
.slide-right-enter-to {
    opacity: 1;
    transform: translateX(0);
}

/* Slide from bottom */
.slide-up-enter-from {
    opacity: 0;
    transform: translateY(50px);
}
.slide-up-enter-to {
    opacity: 1;
    transform: translateY(0);
}
</style>

<template>
    <Head title="Inicio" />
    <div class="min-h-screen font-sans antialiased">
        <Navbar />
        <HeroSection />
        <BrandSlider />
        <BulletPoints />
        <Services />
        <Footer />
    </div>
</template>
