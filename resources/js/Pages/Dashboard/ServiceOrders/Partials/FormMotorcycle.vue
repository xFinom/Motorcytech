<script setup lang="ts">
import { defineProps, ref } from 'vue'

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
import { MotorcycleType } from '@/interfaces/MotorcycleType'

defineProps<{
    types: Record<number, MotorcycleType[]>
    brands: Record<number, string>
}>()

const selectedBrandId = ref<number | null>(null)
</script>

<template>
    <div class="flex flex-col gap-4">
        <FormField v-slot="{ componentField }" name="serial_num">
            <FormItem>
                <FormLabel>Número de Serie <span class="text-red-500" aria-hidden="true">*</span>
                    <span class="sr-only">required</span></FormLabel>
                <FormControl>
                    <Input type="text" v-bind="componentField" />
                </FormControl>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="motor_num">
            <FormItem>
                <FormLabel>Número de Motor <span class="text-red-500" aria-hidden="true">*</span>
                    <span class="sr-only">required</span></FormLabel>
                <FormControl>
                    <Input type="text" v-bind="componentField" />
                </FormControl>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="placa">
            <FormItem>
                <FormLabel>Placas <span class="text-red-500" aria-hidden="true">*</span>
                    <span class="sr-only">required</span></FormLabel>
                <FormControl>
                    <Input type="text" v-bind="componentField" />
                </FormControl>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="brand_id">
            <FormItem>
                <FormLabel>Marca <span class="text-red-500" aria-hidden="true">*</span>
                    <span class="sr-only">required</span></FormLabel>
                <Select v-bind="componentField" v-model="selectedBrandId">
                    <FormControl>
                        <SelectTrigger>
                            <SelectValue placeholder="Selecciona una marca" />
                        </SelectTrigger>
                    </FormControl>
                    <SelectContent>
                        <SelectGroup>
                            <SelectItem
                                v-for="(brand, index) in brands"
                                :key="index"
                                :value="index"
                            >
                                {{ brand }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-if="selectedBrandId" v-slot="{ componentField }" name="type_id">
            <FormItem>
                <FormLabel>Tipo <span class="text-red-500" aria-hidden="true">*</span>
                    <span class="sr-only">required</span></FormLabel>
                <Select v-bind="componentField">
                    <FormControl>
                        <SelectTrigger>
                            <SelectValue placeholder="Selecciona un tipo" />
                        </SelectTrigger>
                    </FormControl>
                    <SelectContent>
                        <SelectGroup>
                            <SelectItem
                                v-for="type in types[selectedBrandId]"
                                :key="type.id"
                                :value="type.id"
                            >
                                {{ type.name }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="year">
            <FormItem>
                <FormLabel>Año <span class="text-red-500" aria-hidden="true">*</span>
                    <span class="sr-only">required</span></FormLabel>
                <FormControl>
                    <Input type="number" v-bind="componentField" />
                </FormControl>
                <FormMessage />
            </FormItem>
        </FormField>
    </div>
</template>
