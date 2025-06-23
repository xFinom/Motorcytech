<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { Icon } from "@iconify/vue";

const isScrolled = ref(false)
const menu = ['Inicio', 'Servicios', 'Acerca de Nosotros', 'Contacto']

function handleScroll() {
    isScrolled.value = window.scrollY > 10
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})
</script>

<template>
    <header
        :class="[
          'fixed top-0 left-0 w-full z-50 transition-all duration-300',
          isScrolled ? 'bg-white shadow-sm' : 'bg-transparent'
        ]"
    >
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div
                :class="[
                  'text-2xl font-bold transition-colors duration-300',
                  isScrolled ? 'text-indigo-600' : 'text-white'
                ]"
            >
                Logo
            </div>
            <ul class="hidden md:flex space-x-6">
                <li v-for="item in menu" :key="item">
                    <a
                        href="#"
                        :class="[
                          'transition-colors duration-300 hover:text-indigo-600',
                          isScrolled ? 'text-gray-600' : 'text-white'
                        ]"
                    >
                        {{ item }}
                    </a>
                </li>
            </ul>
            <button
                class="md:hidden p-2 rounded-md focus:outline-none focus:ring-2"
                :class="isScrolled ? 'text-gray-600 focus:ring-indigo-500' : 'text-white focus:ring-white'"
            >
                <Icon icon="line-md:menu" width="24" height="24" />
            </button>
        </nav>
    </header>
</template>

