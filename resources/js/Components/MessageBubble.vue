<script setup lang="ts">
import { Clock } from 'lucide-vue-next'

import { PrivateMessage } from '@/interfaces/PrivateMessage'
import { formatHour24 } from '@/utils/date'
import { User } from '@/interfaces/User'

const props = defineProps<{
    message: PrivateMessage
    currentUser: User
}>()

const isCurrentUser = props.currentUser.id === props.message.user.id
const displayName = isCurrentUser ? 'You' : props.message.user.name
</script>

<template>
    <div class="flex items-start gap-2.5" :class="isCurrentUser ? 'justify-end' : 'justify-start'">
        <div
            class="leading-1.5 flex max-w-xs flex-col p-4"
            :class="[
                isCurrentUser
                    ? 'self-end rounded-t-xl rounded-es-xl bg-primary text-[#FAFAFA]'
                    : 'self-start rounded-e-xl rounded-es-xl bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white',
            ]"
        >
            <div class="flex items-center space-x-2">
                <span class="text-sm font-semibold">{{ displayName }}</span>
            </div>

            <p class="py-2.5 text-sm font-normal">{{ message.message }}</p>

            <div
                class="mt-1 flex items-center justify-end text-xs"
                :class="isCurrentUser ? 'text-[#E5E5E5]' : 'text-gray-500 dark:text-gray-400'"
            >
                <Clock class="mr-1 h-3 w-3" />
                <span>{{ formatHour24(message.created_at) }}</span>
            </div>
        </div>
    </div>
</template>
