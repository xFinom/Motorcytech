<script setup>
import { FormControl, FormField, FormItem, FormLabel, FormMessage } from '@/Components/ui/form'
import { Input } from '@/Components/ui/input'
</script>

<template>
    <div class="flex flex-col gap-4">
        <FormField v-slot="{ componentField }" name="email">
            <FormItem>
                <FormLabel>Correo electrónico <span class="text-red-500" aria-hidden="true">*</span>
                    <span class="sr-only">required</span></FormLabel>
                <FormControl>
                    <Input type="email" v-bind="componentField" />
                </FormControl>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="name">
            <FormItem>
                <FormLabel>Nombre Completo <span class="text-red-500" aria-hidden="true">*</span>
                    <span class="sr-only">required</span></FormLabel>
                <FormControl>
                    <Input type="text" v-bind="componentField" />
                </FormControl>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="phone">
            <FormItem>
                <FormLabel>Teléfono <span class="text-red-500" aria-hidden="true">*</span>
                    <span class="sr-only">required</span></FormLabel>
                <FormControl>
                    <Input type="text" v-bind="componentField" />
                </FormControl>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="address">
            <FormItem>
                <FormLabel>Dirección <span class="text-red-500" aria-hidden="true">*</span>
                    <span class="sr-only">required</span></FormLabel>
                <FormControl>
                    <Input type="text" v-bind="componentField" />
                </FormControl>
                <FormMessage />
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="rfc">
            <FormItem>
                <FormLabel>RFC</FormLabel>
                <FormControl>
                    <Input type="text" v-bind="componentField" />
                </FormControl>
                <FormMessage />
            </FormItem>
        </FormField>
    </div>
</template>
