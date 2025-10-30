<script setup lang="ts">
import { defineProps } from 'vue'

import { FormControl, FormField, FormItem, FormLabel, FormMessage } from '@/Components/ui/form'
import { Input } from '@/Components/ui/input'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select'

defineProps<{
    services: Record<number, string>
}>()
</script>

<template>
    <div class="flex flex-col gap-4">
        <FormField v-slot="{ componentField }" name="service_id">
            <FormItem>
                <FormLabel>Servicio</FormLabel>
                <Select v-bind="componentField">
                    <FormControl>
                        <SelectTrigger>
                            <SelectValue placeholder="Selecciona un servicio" />
                        </SelectTrigger>
                    </FormControl>
                    <SelectContent>
                        <SelectGroup>
                            <SelectItem
                                v-for="(service, index) in services"
                                :key="index"
                                :value="Number(index)"
                                >{{ service }}</SelectItem
                            >
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="note">
            <FormItem>
                <FormLabel>Mensaje (opcional)</FormLabel>
                <FormControl>
                    <Input type="text" v-bind="componentField" />
                </FormControl>
                <FormMessage />
            </FormItem>
        </FormField>
    </div>
</template>
