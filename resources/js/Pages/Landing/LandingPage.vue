<script setup lang="ts">
import { Head } from '@inertiajs/vue3'

import HeroSection from '@/Pages/Landing/Partials/HeroSection.vue'
import Navbar from '@/Pages/Landing/Partials/Navbar.vue'
</script>

<template>
    <Head title="Inicio" />
    <div class="min-h-screen bg-gray-500 font-sans text-gray-800 antialiased">
        <Navbar />
        <HeroSection />
    </div>
</template>
