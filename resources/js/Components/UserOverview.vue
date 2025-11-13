<script setup lang="ts">
import { Avatar, AvatarFallback } from '@/Components/ui/avatar'
import { generateInitials } from '@/utils/name'

defineProps<{
    name: string
    email: string
}>();
</script>

<template>
    <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
        <Avatar class="h-8 w-8 rounded-lg">
            <AvatarFallback class="rounded-lg text-primary">
                {{ generateInitials(name) }}
            </AvatarFallback>
        </Avatar>
        <div class="grid flex-1 text-left text-sm leading-tight">
            <span class="truncate font-semibold">{{ name }}</span>
            <span class="truncate text-xs">{{ email }}</span>
        </div>
    </div>
</template>
