<script setup lang="ts">
import { ref, onMounted, onUnmounted, computed } from 'vue'
import { Icon } from "@iconify/vue";
import Button from "@/components/ui/button/Button.vue"

const isScrolled = ref(false)
const isDarkMode = ref(true)

function toggleDarkMode() {
    isDarkMode.value = !isDarkMode.value
}

const computedClasses = computed(() => {
    if (isScrolled.value) {
        return isDarkMode.value
            ? 'text-gray-200 focus:ring-gray-400'
            : 'text-gray-600 focus:ring-indigo-500'
    }
    return 'text-white focus:ring-white'
})

const menu = ['Inicio', 'Servicios', 'Seguimiento', 'Contacto']

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
        <nav class="container mx-auto px-4 py-4 flex items-center">
            <div
                :class="[
                  'text-2xl font-bold transition-colors duration-300',
                  isScrolled ? 'text-indigo-600' : 'text-white'
                ]"
            >
                Motorcytech
            </div>
            <ul class="hidden md:flex flex-grow justify-center space-x-6">
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
                class="hidden md:block ml-auto px-4 py-2 rounded-md font-semibold transition duration-300"
                :class="isScrolled
                    ? 'bg-indigo-600 text-white hover:bg-indigo-700'
                    : 'border border-white text-white hover:bg-white hover:text-indigo-600'"
            >
                Iniciar Sesión
            </button>

            <Button
                variant="ghost"
                class="ml-4 p-2 rounded-md focus:outline-none focus:ring-2 transition-colors duration-300"
                :class="computedClasses"
                @click="toggleDarkMode"
            >
                <Icon
                    :icon="isDarkMode ? 'line-md:moon-alt-to-sunny-outline-loop-transition' : 'line-md:sunny-outline-to-moon-loop-transition'"
                    class="text-2xl"
                />
            </Button>

            <Button
                class="md:hidden p-2 rounded-md focus:outline-none focus:ring-2"
                :class="isScrolled ? 'text-gray-600 focus:ring-indigo-500' : 'text-white focus:ring-white'"
            >
                <Icon icon="line-md:menu" width="24" height="24" />
            </Button>
        </nav>
    </header>
</template>

