<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue'

const sponsorLogos = [
    { id: 1, name: 'BMW', url: 'https://i.ibb.co/RksF4nmT/bmw.png' },
    { id: 2, name: 'KTM', url: 'https://i.ibb.co/TMVVXcpJ/KTM.png' },
    { id: 3, name: 'Yamaha', url: 'https://i.ibb.co/8gbkVKS4/Yamaha-logo.png' },
    { id: 4, name: 'Kawasaki', url: 'https://i.ibb.co/zV0bngwK/Kawasaki-logo.png' },
    { id: 5, name: 'Suzuki', url: 'https://i.ibb.co/wNYBp3Z4/Suzuki-logo-2025.png' },
    { id: 6, name: 'Honda', url: 'https://i.ibb.co/0yk8Mp3n/Honda-logo.png' },
    { id: 7, name: 'Triumph', url: 'https://i.ibb.co/wNnrKV8Z/Logo-Triumph.png' },
    // { id: 8, name: 'MV Augusta', url: 'https://i.ibb.co/5gt832j6/mv-augusta.png' },
]

const duplicatedLogos = computed(() =>
    [...sponsorLogos, ...sponsorLogos].map((logo, i) => ({ ...logo, key: `${logo.id}-${i}` }))
)

const position = ref(0)
const isResetting = ref(false)
const speed = 0.5
let sliderWidth = 0
let animationFrameId

const slider = ref(null)

function animate() {
    position.value += speed
    if (position.value >= sliderWidth / 2) {
        isResetting.value = true
        position.value = 0
        requestAnimationFrame(() => (isResetting.value = false))
    }
    animationFrameId = requestAnimationFrame(animate)
}

onMounted(() => {
    sliderWidth = slider.value.scrollWidth
    animationFrameId = requestAnimationFrame(animate)
})

onUnmounted(() => cancelAnimationFrame(animationFrameId))

const handleImageError = (e) => {
    e.target.src = 'https://placehold.co/150x80/CCCCCC/666666?text=Error'
}
</script>

<template>
    <div class="relative w-full overflow-hidden bg-[#061222]">
        <h1 class="text-center mb-4 mt-3 text-4xl font-extrabold tracking-tight leading-none text-[#fb5607] md:text-5xl lg:text-6xl">We invest in the world’s potential</h1>
        <p class="text-center mb-8 text-lg font-normal text-white lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
        <div class="relative mx-auto h-full overflow-hidden mb-4" style="width: 50%">
            <div
                class="pointer-events-none absolute left-0 top-0 z-10 h-full w-5"
                style="background: linear-gradient(to right, #061222, transparent)"
            ></div>
            <div
                class="pointer-events-none absolute right-0 top-0 z-10 h-full w-16"
                style="background: linear-gradient(to left, #061222, transparent)"
            ></div>

            <div
                class="flex h-full items-center"
                :style="{
                    transform: `translateX(-${position}px)`,
                    transition: isResetting ? 'none' : 'transform 0.05s linear',
                }"
                ref="slider"
            >
                <div
                    v-for="logo in duplicatedLogos"
                    :key="logo.key"
                    class="flex flex-shrink-0 items-center justify-center px-4"
                    :style="{ width: '150px', height: '80px' }"
                >
                    <img
                        :src="logo.url"
                        :alt="logo.name"
                        class="max-h-full max-w-full object-contain transition-transform duration-300 hover:scale-110 filter brightness-0 invert"
                        @error="handleImageError"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
