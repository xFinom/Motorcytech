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

type UserRow = {
    id: number
    name: string
    email: string
    rfc: string
    role: string
    address: string
    phone: string
}

const props = defineProps<{
    user: UserRow | null
}>()

// Datos del formulario
const formData = reactive<UserRow>({
    id: 0,
    name: '',
    email: '',
    rfc: '',
    role: '',
    address: '',
    phone: '',
})

// Errores de validación (Zod + Laravel)
const errors = reactive<Record<string, string>>({})

// Zod schema
const schema = z.object({
    name: z.string().min(3, { message: 'El nombre debe tener al menos 3 caracteres' }),
    email: z.string().email({ message: 'El correo no es válido' }),
    rfc: z
        .string()
        .min(12, { message: 'El RFC debe tener al menos 12 caracteres' })
        .max(13, { message: 'El RFC no puede tener más de 13 caracteres' }),
    address: z.string().min(5, { message: 'La dirección es obligatoria' }),
    phone: z.string().regex(/^[0-9]{10}$/, { message: 'El teléfono debe tener 10 dígitos' }),
    role: z.string().optional(),
})

// Copiamos los datos cuando cambie el prop
watch(
    () => props.user,
    (newUser) => {
        if (newUser) {
            Object.assign(formData, newUser)
        }
    },
    { immediate: true }
)

function guardarCambios() {
    // Resetear errores
    Object.keys(errors).forEach((k) => (errors[k] = ''))

    // Validar con Zod
    const result = schema.safeParse(formData)

    if (!result.success) {
        result.error.errors.forEach((e) => {
            errors[e.path[0]] = e.message
        })
        return
    }

    // Si pasa, enviar al backend
    router.put(route('dashboard.client.update', formData.id), formData, {
        preserveScroll: true,
        onSuccess: () => {
            console.log('Usuario actualizado correctamente ✅')
        },
        onError: (serverErrors) => {
            // Mapear errores de Laravel al mismo objeto
            for (const field in serverErrors) {
                errors[field] = serverErrors[field][0] // tomamos el primer mensaje
            }
        },
    })
}
</script>

<template>
    <Sheet>
        <SheetContent>
            <SheetHeader>
                <SheetTitle>Editar cliente</SheetTitle>
                <SheetDescription class="mb-6">
                    Realiza los cambios necesarios y guarda antes de salir.
                </SheetDescription>
            </SheetHeader>

            <div class="grid flex-1 auto-rows-min gap-8 px-4">
                <div class="grid gap-3">
                    <Label>Nombre</Label>
                    <Input v-model="formData.name" placeholder="Nombre del cliente" />
                    <p v-if="errors.name" class="text-sm text-red-500">{{ errors.name }}</p>
                </div>

                <div class="grid gap-3">
                    <Label>Correo electrónico</Label>
                    <Input v-model="formData.email" type="email" placeholder="ejemplo@correo.com" />
                    <p v-if="errors.email" class="text-sm text-red-500">{{ errors.email }}</p>
                </div>

                <div class="grid gap-3">
                    <Label>RFC</Label>
                    <Input v-model="formData.rfc" placeholder="RFC del cliente" />
                    <p v-if="errors.rfc" class="text-sm text-red-500">{{ errors.rfc }}</p>
                </div>

                <div class="grid gap-3">
                    <Label>Dirección</Label>
                    <Input v-model="formData.address" placeholder="Dirección del cliente" />
                    <p v-if="errors.address" class="text-sm text-red-500">{{ errors.address }}</p>
                </div>

                <div class="grid gap-3">
                    <Label>Teléfono</Label>
                    <Input v-model="formData.phone" type="tel" placeholder="Número de teléfono" />
                    <p v-if="errors.phone" class="text-sm text-red-500">{{ errors.phone }}</p>
                </div>
            </div>

            <SheetFooter class="mt-6">
                <!-- No cierres el modal si hay errores -->
                <Button type="button" @click="guardarCambios">Guardar cambios</Button>
                <SheetClose asChild>
                    <Button variant="outline">Cerrar</Button>
                </SheetClose>
            </SheetFooter>
        </SheetContent>
    </Sheet>
</template>
