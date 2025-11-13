<script setup lang="ts">
import { ref } from "vue"
import { z } from "zod"
import { Button } from "@/Components/ui/button"
import { Input } from "@/Components/ui/input"
import { Card, CardContent } from "@/Components/ui/card"
import { Label } from "@/Components/ui/label"
import { Trash2, Plus } from "lucide-vue-next"
import DashboardLayout from '@/Layouts/DashboardLayout.vue'

// --- Zod validation schema ---
const quoteSchema = z.object({
    name: z.string().min(1, "El nombre es obligatorio"),
    quantity: z.number().min(1, "La cantidad debe ser mayor a 0"),
    price: z.number().min(0, "El precio debe ser positivo"),
})

// Array schema for validation of all quotes
const quotesSchema = z.array(quoteSchema)

// Reactive state
const quotes = ref([{ name: "", quantity: 1, price: 0 }])
const errors = ref<Record<number, Record<string, string>>>({})

// --- Methods ---
function addQuote() {
    quotes.value.push({ name: "", quantity: 1, price: 0 })
}

function removeQuote(index: number) {
    quotes.value.splice(index, 1)
    delete errors.value[index]
}

function validateQuote(index: number) {
    const result = quoteSchema.safeParse(quotes.value[index])
    if (!result.success) {
        const fieldErrors: Record<string, string> = {}
        for (const err of result.error.errors) {
            fieldErrors[err.path[0]] = err.message
        }
        errors.value[index] = fieldErrors
    } else {
        delete errors.value[index]
    }
}

function submitForm() {
    const result = quotesSchema.safeParse(quotes.value)
    if (!result.success) {
        // Build errors for all items
        const allErrors: Record<number, Record<string, string>> = {}
        result.error.errors.forEach((err) => {
            const idx = err.path[0] as number
            const field = err.path[1] as string
            if (!allErrors[idx]) allErrors[idx] = {}
            allErrors[idx][field] = err.message
        })
        errors.value = allErrors
        return
    }

    // Submit (emit or handle API call)
    console.log("✅ Datos válidos:", result.data)
}
</script>

<template>
    <DashboardLayout>
        <div class="w-full max-w-5xl mx-auto space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold">Cotización de repuestos</h2>
                <Button
                    type="button"
                    variant="outline"
                    class="flex items-center gap-2"
                    @click="addQuote"
                >
                    <Plus class="w-4 h-4" />
                    Agregar repuesto
                </Button>
            </div>

            <transition-group
                name="fade"
                tag="div"
                class="space-y-4"
            >
                <Card
                    v-for="(quote, index) in quotes"
                    :key="index"
                    class="p-4 border rounded-2xl shadow-sm bg-white"
                >
                    <CardContent class="space-y-3">
                        <div class="flex justify-end">
                            <Button
                                v-if="quotes.length > 1"
                                type="button"
                                variant="destructive"
                                size="sm"
                                class="flex items-center gap-1"
                                @click="removeQuote(index)"
                            >
                                <Trash2 class="w-4 h-4" />

                            </Button>
                        </div>
                        <div class="grid grid-cols-3 gap-4 items-end">
                            <div>
                                <Label :for="`name-${index}`">Nombre</Label>
                                <Input
                                    :id="`name-${index}`"
                                    v-model="quote.name"
                                    @blur="validateQuote(index)"
                                    :aria-invalid="!!errors[index]?.name"
                                    placeholder="Ej. Bujía NGK"
                                />
                                <p
                                    v-if="errors[index]?.name"
                                    class="text-sm text-red-600 mt-1"
                                >
                                    {{ errors[index]?.name }}
                                </p>
                            </div>

                            <div>
                                <Label :for="`quantity-${index}`">Cantidad</Label>
                                <Input
                                    :id="`quantity-${index}`"
                                    v-model.number="quote.quantity"
                                    @blur="validateQuote(index)"
                                    type="number"
                                    min="1"
                                />
                                <p
                                    v-if="errors[index]?.quantity"
                                    class="text-sm text-red-600 mt-1"
                                >
                                    {{ errors[index]?.quantity }}
                                </p>
                            </div>

                            <div>
                                <Label :for="`price-${index}`">Precio</Label>
                                <Input
                                    :id="`price-${index}`"
                                    v-model.number="quote.price"
                                    @blur="validateQuote(index)"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    placeholder="0.00"
                                />
                                <p
                                    v-if="errors[index]?.price"
                                    class="text-sm text-red-600 mt-1"
                                >
                                    {{ errors[index]?.price }}
                                </p>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </transition-group>

            <div class="flex justify-end">
                <Button @click="submitForm" class="px-6">
                    Guardar cotización
                </Button>
            </div>
        </div>
    </DashboardLayout>

</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(-5px);
}
</style>
