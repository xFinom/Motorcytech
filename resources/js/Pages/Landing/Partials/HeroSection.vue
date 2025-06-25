<script setup lang="ts">
import { ref } from 'vue'

const imageSrc = ref('https://placehold.co/600x400/indigo/white?text=Motorcycle+Repair')
</script>

<template>
    <section
        class="relative flex justify-center overflow-hidden bg-gradient-to-r from-indigo-500 to-purple-600 px-4 text-white md:min-h-screen"
    >
        <div
            class="container mx-auto flex flex-col items-center justify-center text-center md:flex-row lg:pb-48"
        >
            <div class="mb-8 md:mb-0 md:w-1/2 md:pr-8">
                <h1 class="mb-6 text-5xl font-extrabold leading-tight md:text-6xl">
                    Expert Motorcycle Repair
                    <span class="mt-2 block">Get Back on the Road Fast!</span>
                </h1>
                <p class="mx-auto mb-10 max-w-2xl text-xl md:text-2xl">
                    Reliable service, experienced technicians, and genuine parts for all your
                    motorcycle needs.
                </p>
                <div class="space-x-4">
                    <button
                        class="transform rounded-full bg-white px-8 py-3 font-bold text-indigo-600 shadow-lg transition duration-300 hover:scale-105 hover:bg-gray-100"
                    >
                        Book Service
                    </button>
                    <button
                        class="transform rounded-full border border-white px-8 py-3 font-bold text-white shadow-lg transition duration-300 hover:scale-105 hover:bg-white hover:text-indigo-600"
                    >
                        Our Services
                    </button>
                </div>
            </div>
            <div class="flex justify-center md:w-1/2">
                <svg width="0" height="0" class="absolute">
                    <defs>
                        <clipPath id="blobShape" clipPathUnits="userSpaceOnUse">
                            <path
                                d="M0.933,0.372 C0.972,0.519,0.88,0.719,0.774,0.834 C0.672,0.941,0.542,0.97,0.416,0.945 C0.308,0.921,0.207,0.853,0.128,0.759 C0.044,0.658,0.02,0.514,0.06,0.376 C0.096,0.249,0.2,0.15,0.308,0.088 C0.42,0.024,0.547,-0.01,0.662,0.039 C0.785,0.09,0.896,0.22,0.933,0.372 Z"
                            />
                        </clipPath>
                    </defs>
                </svg>

                <img
                    :src="imageSrc"
                    alt="Motorcycle Repair Shop"
                    class="h-auto max-w-full shadow-xl"
                    :style="{ clipPath: 'url(#blobShape)' }"
                />
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full bg-transparent">
            <svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                {/* Fill with the 'to' color of the hero's gradient for a seamless transition */}
                <path
                    fill="#ffffff"
                    fill-opacity="1"
                    d="M0,192L80,186.7C160,181,320,171,480,192C640,213,800,267,960,256C1120,245,1280,171,1360,133.3L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"
                ></path>
            </svg>
        </div>
    </section>
</template>
