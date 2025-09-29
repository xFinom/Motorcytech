<script setup lang="ts">
import MainLayout from '@/Layouts/MainLayout.vue'
import BrandSlider from '@/Pages/Landing/Partials/BrandSlider.vue'
import BulletPoints from '@/Pages/Landing/Partials/BulletPoints.vue'
import HeroSection from '@/Pages/Landing/Partials/HeroSection.vue'
import Services from '@/Pages/Landing/Partials/Services.vue'
import Numbers from '@/Pages/Landing/About/Partials/Numbers.vue'
</script>

<template>
    <MainLayout>
        <HeroSection />
        <BrandSlider />
        <BulletPoints />
        <Numbers />
        <Services />
    </MainLayout>
</template>
