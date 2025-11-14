<script setup lang="ts">
import { ref } from "vue"
import { z } from "zod"
import { router } from "@inertiajs/vue3"
import { Button } from "@/Components/ui/button"
import { Input } from "@/Components/ui/input"
import { Label } from "@/Components/ui/label"
import DashboardLayout from '@/Layouts/DashboardLayout.vue'

// Props
const props = defineProps<{
    service_order: { id: string }
}>()

// Zod schema
const billSchema = z.object({
    description: z.string().min(1, "La descripción es obligatoria"),
    price: z.number().min(0, "El precio debe ser positivo"),
})

const billsSchema = z.array(billSchema)

// Reactive state
const bills = ref([{ description: "", price: 0 }])
const errors = ref<Record<number, Record<string, string>>>({})

// Add bill
function addBill() {
    bills.value.push({ description: "", price: 0 })
}

// Remove bill
function removeBill(index: number) {
    bills.value.splice(index, 1)
    delete errors.value[index]
}

// Validate single row
function validateBill(index: number) {
    const result = billSchema.safeParse(bills.value[index])
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

// Submit
function submitForm() {
    const result = billsSchema.safeParse(bills.value)

    if (!result.success) {
        const allErrors: Record<number, Record<string, string>> = {}
        result.error.errors.forEach(err => {
            const idx = err.path[0] as number
            const field = err.path[1] as string
            if (!allErrors[idx]) allErrors[idx] = {}
            allErrors[idx][field] = err.message
        })
        errors.value = allErrors
        return
    }

    router.post(
        route("dashboard.service.orders.bills.store"),
        {
            service_order_id: props.service_order.id,
            bills: result.data
        }
    );
}
</script>

<template>
    <DashboardLayout>
        <div class="w-full max-w-7xl mx-auto space-y-4">

            <div class="flex justify-end">
                <Button @click="addBill" variant="outline">Agregar factura</Button>
            </div>

            <div class="space-y-4">
                <div
                    v-for="(bill, index) in bills"
                    :key="index"
                    class="p-4 border rounded-xl bg-white shadow-sm space-y-4"
                >
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label :for="`desc-${index}`">Descripción</Label>
                            <Input
                                :id="`desc-${index}`"
                                v-model="bill.description"
                                @blur="validateBill(index)"
                                :aria-invalid="!!errors[index]?.description"
                            />
                            <p v-if="errors[index]?.description" class="text-red-600 text-sm mt-1">
                                {{ errors[index].description }}
                            </p>
                        </div>

                        <div>
                            <Label :for="`price-${index}`">Precio</Label>
                            <Input
                                :id="`price-${index}`"
                                v-model.number="bill.price"
                                @blur="validateBill(index)"
                                type="number"
                                step="0.01"
                                min="0"
                            />
                            <p v-if="errors[index]?.price" class="text-red-600 text-sm mt-1">
                                {{ errors[index].price }}
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <Button
                            v-if="bills.length > 1"
                            variant="destructive"
                            @click="removeBill(index)"
                        >
                            Eliminar
                        </Button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <Button class="px-8" @click="submitForm">Generar Facturas</Button>
            </div>

        </div>
    </DashboardLayout>
</template>
