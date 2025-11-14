<script lang="ts" setup>
import { z } from 'zod'
import { reactive, watch, ref } from 'vue'
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

type StoreItem = {
    id: number
    name: string
    description: string | null
    quantity: number
    price: number
    image: string | null
}

const props = defineProps<{ item: StoreItem | null }>()

// Datos del formulario
const formData = reactive({
    id: 0,
    name: '',
    description: '',
    quantity: 1,
    price: 0,
})

// Archivo nuevo
const imageFile = ref<File | null>(null)

// Errores
const errors = reactive<Record<string, string>>({})

// Esquema Zod
const schema = z.object({
    name: z.string().min(3, { message: 'El nombre debe tener al menos 3 caracteres' }),
    description: z.string().optional(),
    quantity: z.number().min(1, { message: 'Cantidad mínima: 1' }),
    price: z.number().min(1, { message: 'El precio debe ser mayor a 0' }),
})

// Cargar datos al entrar
watch(
    () => props.item,
    (newItem) => {
        if (newItem) {
            Object.assign(formData, {
                id: newItem.id,
                name: newItem.name,
                description: newItem.description ?? '',
                quantity: newItem.quantity,
                price: newItem.price,
            })
        }
    },
    { immediate: true }
)

const guardarCambios = () => {
    Object.keys(errors).forEach((k) => (errors[k] = ''))

    const result = schema.safeParse({
        name: formData.name,
        description: formData.description,
        quantity: Number(formData.quantity),
        price: Number(formData.price),
    })

    if (!result.success) {
        result.error.errors.forEach((e) => (errors[e.path[0]] = e.message))
        return
    }

    router.put(route('dashboard.store.items.update', props.item.id), result.data, {
        forceFormData: true,
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
                <SheetTitle>Editar artículo</SheetTitle>
                <SheetDescription class="mb-6">
                    Modifica la información del artículo en inventario.
                </SheetDescription>
            </SheetHeader>

            <div class="grid gap-6 px-4">
                <div class="grid gap-2">
                    <Label>Nombre</Label>
                    <Input v-model="formData.name" placeholder="Nombre del artículo" />
                    <p v-if="errors.name" class="text-xs text-red-500">{{ errors.name }}</p>
                </div>

                <div class="grid gap-2">
                    <Label>Descripción</Label>
                    <Input v-model="formData.description" placeholder="Descripción opcional" />
                    <p v-if="errors.description" class="text-xs text-red-500">{{ errors.description }}</p>
                </div>

                <div class="grid gap-2">
                    <Label>Cantidad</Label>
                    <Input type="number" min="1" v-model="formData.quantity" />
                    <p v-if="errors.quantity" class="text-xs text-red-500">{{ errors.quantity }}</p>
                </div>

                <div class="grid gap-2">
                    <Label>Precio</Label>
                    <Input type="number" min="1" step="0.01" v-model="formData.price" />
                    <p v-if="errors.price" class="text-xs text-red-500">{{ errors.price }}</p>
                </div>

                <div class="grid gap-2">
                    <Label>Imagen</Label>
                    <Input type="file" accept="image/*" @change="e => imageFile = e.target.files[0]" />
                    <p v-if="errors.image" class="text-xs text-red-500">{{ errors.image }}</p>
                </div>
            </div>

            <SheetFooter class="mt-6">
                <Button type="button" @click="guardarCambios">Guardar cambios</Button>
                <SheetClose asChild>
                    <Button variant="outline">Cerrar</Button>
                </SheetClose>
            </SheetFooter>
        </SheetContent>
    </Sheet>
</template>
