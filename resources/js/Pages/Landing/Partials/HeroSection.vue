<script setup lang="ts">
import { ref } from 'vue'

import { Icon } from '@iconify/vue'

const imageSrc = ref(
    'https://img.freepik.com/premium-photo/man-repairing-bike-confident-young-man-repairing-motorcycle-repair-shop_425904-17659.jpg'
)
</script>

<template>
    <section
        class="relative flex justify-center overflow-hidden bg-white px-4 text-white dark:bg-[#061222] md:min-h-screen"
    >
        <Icon
            icon="line-md:cog-filled-loop"
            class="absolute left-0 top-0 -translate-x-1/4 rotate-12 text-[400px] text-[#fb5607]"
        />

        <Icon
            icon="line-md:cog-filled-loop"
            class="translate-y-1/8 absolute left-1/2 top-1/2 z-0 -translate-x-1/2 text-[500px] text-[#fb5607]"
        />

        <Icon
            icon="line-md:cog-filled-loop"
            class="pointer-events-none absolute bottom-8 left-8 z-0 -translate-y-1/3 rotate-12 select-none text-[280px] text-[#fb5607]"
        />

        <div
            class="container mx-auto flex w-full flex-col items-center justify-center text-center md:flex-row lg:pb-48"
        >
            <div class="mb-8 md:mb-0 md:w-3/4 md:pr-8">
                <transition name="slide-left" appear>
                    <h1
                        class="mb-6 text-5xl font-extrabold leading-tight text-[#061222] dark:text-white md:text-6xl"
                    >
                        Expert Motorcycle Repair
                        <span class="mt-2 block text-[#fb5607]">Get Back on the Road Fast!</span>
                    </h1>
                </transition>

                <transition name="slide-right" appear>
                    <p
                        class="mx-auto mb-10 max-w-2xl text-xl text-[#061222] dark:text-white md:text-2xl"
                    >
                        Reliable service, experienced technicians, and genuine parts for all your
                        motorcycle needs.
                    </p>
                </transition>

                <transition name="slide-up" appear>
                    <div class="space-x-4">
                        <button
                            class="transform rounded-full bg-[#fb5607] px-8 py-3 font-bold shadow-lg transition duration-300 hover:scale-105 hover:bg-[#fb5607]/90 dark:bg-white dark:text-[#fb5607] dark:hover:bg-gray-100"
                        >
                            Cotización
                        </button>
                        <button
                            class="transform rounded-full border border-[#fb5607] px-8 py-3 font-bold text-[#fb5607] shadow-lg transition duration-300 hover:scale-105 hover:bg-[#fb5607] hover:text-[#fefcf9]"
                        >
                            Nuestros Servicios
                        </button>
                    </div>
                </transition>
            </div>

            <div class="relative w-full max-w-xl md:z-10">
                <transition name="slide-up" appear>
                    <div
                        class="absolute left-6 top-6 z-0 h-[100%] w-[100%] rotate-3 rounded-3xl bg-[#fb5607]"
                    ></div>
                </transition>

                <transition name="slide-right" appear>
                    <img
                        :src="imageSrc"
                        class="relative z-10 w-full rounded-3xl shadow-2xl"
                        alt=""
                    />
                </transition>
            </div>
        </div>
    </section>
</template>
