<script lang="ts" setup>
import { z } from 'zod'

import { reactive, watch } from 'vue'

import { router } from '@inertiajs/vue3'

import { Button } from '@/Components/ui/button'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import {
    Sheet,
    SheetClose,
    SheetContent,
    SheetDescription,
    SheetFooter,
    SheetHeader,
    SheetTitle,
} from '@/Components/ui/sheet'

type WorkerRow = {
    id: number
    name: string
    email: string
    address: string
    phone: string
}

const props = defineProps<{ worker: WorkerRow | null }>()

// Datos del formulario
const formData = reactive<WorkerRow>({
    id: 0,
    name: '',
    email: '',
    address: '',
    phone: '',
})

// Errores de validación
const errors = reactive<Record<string, string>>({})

// Esquema Zod
const schema = z.object({
    name: z.string().min(3, { message: 'El nombre debe tener al menos 3 caracteres' }),
    email: z.string().email({ message: 'El correo no es válido' }),
    address: z.string().min(5, { message: 'La dirección es obligatoria' }),
    phone: z.string().regex(/^[0-9]{10}$/, { message: 'El teléfono debe tener 10 dígitos' }),
})

// Copiamos los datos del prop al formData
watch(
    () => props.worker,
    (newWorker) => {
        if (newWorker) Object.assign(formData, newWorker)
    },
    { immediate: true }
)

function guardarCambios() {
    // Resetear errores
    Object.keys(errors).forEach((k) => (errors[k] = ''))

    // Validación frontend con Zod
    const result = schema.safeParse(formData)

    if (!result.success) {
        result.error.errors.forEach((e) => {
            errors[e.path[0]] = e.message
        })
        return // No mandar al backend si falla
    }

    // Si pasa, mandamos al backend
    router.put(route('dashboard.workers.update', formData.id), formData, {
        preserveScroll: true,
        onSuccess: () => {
            console.log('Trabajador actualizado correctamente ✅')
        },
        onError: (serverErrors) => {
            for (const field in serverErrors) {
                errors[field] = serverErrors[field][0]
            }
        },
    })
}
</script>

<template>
    <Sheet>
        <SheetContent>
            <SheetHeader>
                <SheetTitle>Editar trabajador</SheetTitle>
                <SheetDescription class="mb-6">
                    Realiza los cambios necesarios y guarda antes de salir.
                </SheetDescription>
            </SheetHeader>

            <div class="grid flex-1 auto-rows-min gap-8 px-4">
                <div class="grid gap-3">
                    <Label>Nombre</Label>
                    <Input v-model="formData.name" placeholder="Nombre del trabajador" />
                    <p v-if="errors.name" class="text-sm text-red-500">{{ errors.name }}</p>
                </div>

                <div class="grid gap-3">
                    <Label>Correo electrónico</Label>
                    <Input v-model="formData.email" type="email" placeholder="ejemplo@correo.com" />
                    <p v-if="errors.email" class="text-sm text-red-500">{{ errors.email }}</p>
                </div>

                <div class="grid gap-3">
                    <Label>Dirección</Label>
                    <Input v-model="formData.address" placeholder="Dirección del trabajador" />
                    <p v-if="errors.address" class="text-sm text-red-500">{{ errors.address }}</p>
                </div>

                <div class="grid gap-3">
                    <Label>Teléfono</Label>
                    <Input v-model="formData.phone" type="tel" placeholder="Número de teléfono" />
                    <p v-if="errors.phone" class="text-sm text-red-500">{{ errors.phone }}</p>
                </div>
            </div>

            <SheetFooter class="mt-6">
                <!-- Guardar sin cerrar si hay errores -->
                <Button type="button" @click="guardarCambios">Guardar cambios</Button>
                <SheetClose asChild>
                    <Button variant="outline">Cerrar</Button>
                </SheetClose>
            </SheetFooter>
        </SheetContent>
    </Sheet>
</template>
