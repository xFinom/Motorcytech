<script setup lang="ts">

import HeroSection from "@/Pages/Landing/Partials/HeroSection.vue";
import Navbar from "@/Pages/Landing/Partials/Navbar.vue";
import {Head} from "@inertiajs/vue3";
</script>

<template>
    <Head title="Inicio" />
    <div class="min-h-screen bg-gray-500 font-sans text-gray-800 antialiased">
        <Navbar />
        <HeroSection />
    </div>
</template>
