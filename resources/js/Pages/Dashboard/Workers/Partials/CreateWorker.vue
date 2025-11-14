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

type WorkerForm = {
    name: string
    email: string
    address: string
    phone: string
}

const formData = reactive<WorkerForm>({
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
    router.post(route('dashboard.workers.store'), formData, {
        preserveScroll: true,
        onSuccess: () => {
            console.log('Trabajador creado correctamente')
            // Limpiar formulario
            formData.name = ''
            formData.email = ''
            formData.address = ''
            formData.phone = ''
        },
    })
}
</script>

<template>
    <Sheet>
        <SheetContent>
            <SheetHeader>
                <SheetTitle>Crear</SheetTitle>
                <SheetDescription class="mb-6">
                    Rellena los datos necesarios y da clic en "Crear".
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
                <Button type="button" @click="guardarCambios">Crear</Button>
                <SheetClose asChild>
                    <Button variant="outline">Cerrar</Button>
                </SheetClose>
            </SheetFooter>
        </SheetContent>
    </Sheet>
</template>
