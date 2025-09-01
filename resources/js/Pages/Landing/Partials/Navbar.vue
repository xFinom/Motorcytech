<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue'

import { Icon } from '@iconify/vue'

import { Button } from '@/Components/ui/button/index'
import { isDark, toggleDarkMode } from '@/lib/darkMode'

const isScrolled = ref(false)

const menu = ['Inicio', 'Servicios', 'Seguimiento', 'Contacto']

const TOP_BAR_HEIGHT = 48

function handleScroll() {
    isScrolled.value = window.scrollY > TOP_BAR_HEIGHT
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})
</script>

<template>
    <div
        class="hidden w-full items-center justify-between overflow-hidden bg-primary px-4 py-2 text-sm text-white transition-all duration-300 ease-in-out md:flex"
        :class="[isScrolled ? 'pointer-events-none opacity-0' : 'opacity-100']"
        :style="{ height: isScrolled ? '0px' : `${TOP_BAR_HEIGHT}px` }"
    >
        <div class="flex space-x-6">
            <span class="flex items-center">
                <Icon
                    icon="line-md:map-marker-radius-filled"
                    class="mr-2"
                    width="24"
                    height="24"
                ></Icon>
                Calle Sin Nombre 123
            </span>
            <span class="flex items-center">
                <Icon icon="line-md:phone-call-loop" class="mr-2" width="24" height="24"></Icon>
                +52 333 123 123 1
            </span>
            <span class="flex items-center">
                <Icon
                    icon="material-symbols:nest-clock-farsight-analog-outline-rounded"
                    class="mr-2"
                    width="24"
                    height="24"
                ></Icon>
                Mon - Sun: 08.00 - 22.00
            </span>
        </div>
        <div class="flex space-x-4">
            <a href="#" class="hover:text-gray-200">
                <Icon icon="mdi:facebook" width="24" height="24" />
            </a>
            <a href="#" class="hover:text-gray-200">
                <Icon icon="mdi:instagram" width="24" height="24" />
            </a>
        </div>
    </div>

    <header
        :class="[
            'sticky left-0 top-0 z-50 w-full transition-all duration-300',
            isScrolled ? 'bg-[#061222] shadow-sm dark:bg-primary' : 'bg-[#061222]',
        ]"
    >
        <nav class="container mx-auto flex items-center px-4 py-4">
            <div
                class="flex items-center space-x-2 text-2xl font-bold transition-colors duration-300"
                :class="isScrolled ? 'text-[#fefcf9]' : 'text-white'"
            >
                <transition name="slide-left" appear>
                    <Icon
                        icon="mdi:tools"
                        class="text-3xl"
                        :class="
                            isScrolled ? 'text-primary dark:text-[#061222]' : 'text-primary'
                        "
                    />
                </transition>
                <div class="text-2xl font-black uppercase tracking-wide">
                    <transition name="slide-left" appear>
                        <span> Motorcy </span>
                    </transition>
                    <transition name="slide-left" appear>
                        <span
                            class="font-semibold"
                            :class="
                                isScrolled ? 'text-primary dark:text-[#061222]' : 'text-primary'
                            "
                        >
                            tech
                        </span>
                    </transition>
                </div>
            </div>

            <ul class="hidden flex-grow justify-center space-x-6 md:flex">
                <li v-for="item in menu" :key="item">
                    <a
                        href="#"
                        :class="[
                            'text-lg transition-colors duration-300 hover:underline hover:decoration-[3px] hover:underline-offset-[10px]',
                            isScrolled
                                ? 'text-[#fefcf9] hover:decoration-primary dark:hover:text-[#061222] dark:hover:decoration-[#061222]'
                                : 'text-white hover:decoration-primary',
                        ]"
                    >
                        {{ item }}
                    </a>
                </li>
            </ul>

            <a :href="route('login')">
                <button
                    class="ml-auto hidden rounded-md px-4 py-2 font-semibold transition duration-300 md:block"
                    :class="
                        isScrolled
                            ? 'border border-primary text-white hover:bg-primary dark:border-white'
                            : 'border border-primary text-white hover:bg-primary hover:text-[#fefcf9]'
                    "
                >
                    Iniciar Sesión
                </button>
            </a>

            <Button
                variant="ghost"
                class="ml-4 rounded-md p-2 transition-colors duration-300 focus:outline-none focus:ring-2"
                :class="[
                    isScrolled
                        ? 'text-[#fefcf9] focus:ring-indigo-500 dark:text-gray-200 dark:focus:ring-gray-400'
                        : 'text-white focus:ring-white',
                ]"
                @click="toggleDarkMode"
            >
                <Icon
                    :icon="
                        isDark
                            ? 'line-md:moon-alt-to-sunny-outline-loop-transition'
                            : 'line-md:sunny-outline-to-moon-loop-transition'
                    "
                    class="text-2xl"
                />
            </Button>

            <Button
                class="rounded-md p-2 focus:outline-none focus:ring-2 md:hidden"
                :class="
                    isScrolled
                        ? 'text-gray-600 focus:ring-indigo-500'
                        : 'text-white focus:ring-white'
                "
            >
                <Icon icon="line-md:menu" width="24" height="24" />
            </Button>
        </nav>
    </header>
</template>
