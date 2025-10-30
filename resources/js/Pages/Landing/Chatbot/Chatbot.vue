<script setup lang="ts">
import { ref } from 'vue'

import { Icon } from '@iconify/vue'

import { Button } from '@/Components/ui/button'
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
import { Input } from '@/Components/ui/input'
import { Popover, PopoverContent, PopoverTrigger } from '@/Components/ui/popover'

const messages = ref([{ from: 'agent', text: '¿Cómo te puedo ayudar hoy?' }])

const newMessage = ref('')
const sendMessage = () => {
    if (newMessage.value.trim() !== '') {
        messages.value.push({ from: 'user', text: newMessage.value })
        newMessage.value = ''
    }
}
</script>

<template>
    <div class="fixed bottom-6 right-6">
        <Popover>
            <!-- BOTÓN DEL CHAT (ALARGADO, NO CIRCULAR) -->
            <PopoverTrigger as-child>
                <Button
                    class="flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-white shadow-lg hover:bg-primary/90"
                >
                    <span class="text-sm font-medium">Ayuda</span>
                    <Icon icon="mdi:chat-processing-outline" class="h-5 w-5" />
                </Button>
            </PopoverTrigger>

            <!-- CONTENEDOR DEL CHAT -->
            <PopoverContent
                class="mr-5 w-80 rounded-xl border border-gray-200 bg-white p-0 text-gray-900 shadow-xl dark:border-gray-800 dark:bg-[#061222] dark:text-white"
            >
                <Card class="border-none bg-transparent">
                    <!-- HEADER -->
                    <CardHeader
                        class="flex items-center gap-2 border-b border-gray-200 dark:border-gray-800"
                    >
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500"
                        >
                            <Icon icon="mdi:robot-outline" class="h-6 w-6 text-white" />
                        </div>
                        <div>
                            <CardTitle class="text-center text-sm">Motorcybot</CardTitle>
                            <CardDescription class="text-xs text-gray-500 dark:text-gray-400">
                                Asistente virtual
                            </CardDescription>
                        </div>
                    </CardHeader>

                    <!-- MENSAJES -->
                    <CardContent class="h-64 space-y-3 overflow-y-auto p-4">
                        <div v-for="(msg, i) in messages" :key="i" class="flex">
                            <div
                                :class="
                                    msg.from === 'user'
                                        ? 'ml-auto max-w-[75%] rounded-lg bg-primary px-3 py-2 text-white'
                                        : 'mr-auto max-w-[75%] rounded-lg bg-gray-100 px-3 py-2 text-gray-900 dark:bg-gray-800 dark:text-gray-200'
                                "
                            >
                                {{ msg.text }}
                            </div>
                        </div>
                    </CardContent>

                    <!-- INPUT -->
                    <CardFooter
                        class="flex items-center gap-2 border-t border-gray-200 p-3 dark:border-gray-800"
                    >
                        <Input
                            v-model="newMessage"
                            placeholder="Escribe tu mensaje..."
                            class="border border-gray-200 bg-gray-100 text-gray-900 focus-visible:ring-1 focus-visible:ring-primary dark:border-0 dark:bg-gray-800 dark:text-white"
                        />
                        <Button
                            size="icon"
                            class="rounded-full bg-primary text-white hover:bg-primary/90"
                            @click="sendMessage"
                        >
                            <Icon icon="mdi:send" class="h-5 w-5" />
                        </Button>
                    </CardFooter>
                </Card>
            </PopoverContent>
        </Popover>
    </div>
</template>


