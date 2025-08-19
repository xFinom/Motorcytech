<script setup>
import { FormControl, FormField, FormItem, FormLabel, FormMessage } from '@/Components/ui/form'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select'
</script>

<template>
    <div class="flex flex-col gap-4">
        <FormField v-slot="{ componentField }" name="favoriteDrink">
            <FormItem>
                <FormLabel>Drink</FormLabel>
                <Select v-bind="componentField">
                    <FormControl>
                        <SelectTrigger>
                            <SelectValue placeholder="Select a drink" />
                        </SelectTrigger>
                    </FormControl>
                    <SelectContent>
                        <SelectGroup>
                            <SelectItem value="coffee">Coffe</SelectItem>
                            <SelectItem value="tea">Tea</SelectItem>
                            <SelectItem value="soda">Soda</SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <FormMessage />
            </FormItem>
        </FormField>
    </div>
</template>
