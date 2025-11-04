<script setup lang="ts">
import { ref } from 'vue'

import { Button } from '@/Components/ui/button'
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card'
import { Input } from '@/Components/ui/input'
import MainLayout from '@/Layouts/MainLayout.vue'
import { StoreItem } from '@/interfaces/StoreItem'

const props = defineProps<{ products: StoreItem[] }>()

const showDetails = ref<{ [key: string]: boolean }>({})

const toggleDetails = (id: number) => {
    showDetails.value[id] = !showDetails.value[id]
}
</script>

<template>
    <MainLayout>


        <div
            class="flex flex-col items-center justify-center bg-gray-200 py-2 shadow-md dark:bg-gray-800"
        >
            <div class="flex items-center justify-center space-x-6">
                <h1
                    class="bg-gradient-to-r from-amber-600 via-orange-500 to-amber-400 bg-clip-text text-center text-5xl font-extrabold tracking-wide text-transparent drop-shadow-md md:text-6xl"
                >
                    MotorcyShop
                </h1>
            </div>
            <p class="mt-3 text-lg italic text-gray-700 dark:text-gray-300">
                Encuentra lo mejor para ti y tu motocicleta
            </p>
        </div>
        <div class="bg-gray-200 p-4 shadow-md dark:bg-gray-800">
            <div class="grid grid-cols-1 justify-items-center gap-6 sm:grid-cols-1 md:grid-cols-4">
                <Card
                    v-for="product in products"
                    :key="product.id"
                    class="relative flex w-full max-w-[300px] flex-col gap-3 rounded-2xl bg-gray-100 p-4 shadow-md dark:bg-gray-900"
                >
                    <div class="z-20 flex justify-end">
                        <Button
                            size="sm"
                            variant="outline"
                            @click="toggleDetails(product.id)"
                            class="self-end rounded-full bg-black/30 p-2 text-white transition hover:bg-black/70"
                        >
                            Ver detalles
                        </Button>
                    </div>

                    <div
                        v-if="showDetails[product.id]"
                        class="absolute inset-0 z-10 flex flex-col items-center justify-center rounded-2xl bg-black/90 p-4 text-center text-white transition-opacity"
                    >
                        <div class="text-lg font-medium text-black dark:text-white">Detalles</div>
                        <h2>{{ product.description }}</h2>
                        <Button
                            class="mt-2 bg-gray-200 p-4 text-black shadow-md dark:bg-gray-800 dark:text-white"
                            variant="outline"
                            size="sm"
                            @click="toggleDetails(product.id)"
                        >
                            Cerrar
                        </Button>
                    </div>

                    <CardHeader class="p-0">
                        <img
                            src="https://thereddooratrothbury.com/wp-content/uploads/2025/08/Test-Item-Grey-300x300.png"
                            :alt="product.name"
                            class="h-48 w-full rounded-lg object-contain"
                        />
                    </CardHeader>
                    <CardContent class="flex flex-col gap-1 p-0 text-center">
                        <CardTitle class="font-bold">{{ product.name }}</CardTitle>

                        <div class="text-lg">${{ product.price }}</div>
                    </CardContent>
                    <CardFooter class="mt-auto flex items-center justify-between p-0">
                        <div class="text-gray-600">Stock: {{ product.quantity }}</div>
                        <Button class="text-white"> Agregar al carrito </Button>
                    </CardFooter>
                </Card>
            </div>
        </div>
    </MainLayout>
</template>
