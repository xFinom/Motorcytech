<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card'
import { LucideIcon } from 'lucide-vue-next'

defineProps<{
    title: string
    value: string | number
    description?: string
    icon?: LucideIcon
}>()
</script>

<template>
    <Card class="w-full">
        <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="font-bold text-primary">{{ title }}</CardTitle>
            <component v-if="icon" :is="icon" class="h-4 w-4 text-muted-foreground" />
        </CardHeader>
        <CardContent>
            <div class="text-xl font-bold">{{ value }}</div>
            <p class="mt-2 text-xs text-muted-foreground">
                <span v-if="description"> {{ description }}</span>
            </p>
        </CardContent>
    </Card>
</template>
