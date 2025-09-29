<script setup lang="ts">
import { Send } from 'lucide-vue-next'

import { useForm, usePage } from '@inertiajs/vue3'

import MessageBubble from '@/Components/MessageBubble.vue'
import { Button } from '@/Components/ui/button'
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
import { Textarea } from '@/Components/ui/textarea'
import { PrivateMessage } from '@/interfaces/PrivateMessage'

defineProps<{
    privateMessages: Array<PrivateMessage>
}>()

const form = useForm({
    message: '',
    service_order_id: '01K69316CE5P89NDGDQ65910VP',
})

function submit() {
    form.post(route('service.order.message.store'), {
        onSuccess() {
            form.message = ''
        },
    })
}

const currentUser = usePage().props.auth.user
</script>

<template>
    <Card v-if="currentUser">
        <CardHeader>
            <CardTitle class="text-xl text-primary">Conversación</CardTitle>
        </CardHeader>

        <CardContent>
            <CardDescription v-if="privateMessages.length === 0">
                No hay mensajes aún...
            </CardDescription>

            <MessageBubble
                v-else
                v-for="msg in privateMessages"
                :key="msg.id"
                :message="msg"
                :current-user="currentUser"
                class="relative mb-4 flex items-start gap-2.5"
            />
        </CardContent>

        <CardFooter class="flex gap-2">
            <Textarea
                v-model="form.message"
                class="flex-1 resize-none rounded-l-md bg-gray-100 p-2 dark:bg-gray-700"
                placeholder="Escribe tu mensaje aquí."
            />
            <Button
                class="rounded-r-md bg-primary p-2 text-white transition-colors hover:bg-primary/90 active:bg-primary/80"
                @click="submit"
            >
                <Send class="h-4 w-4" />
            </Button>
        </CardFooter>
    </Card>
</template>
