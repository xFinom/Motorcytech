<script lang="ts" setup>
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

const formData = reactive<WorkerRow>({
    id: 0,
    name: '',
    email: '',
    address: '',
    phone: '',
})

// Copiamos los datos del prop al formData
watch(
    () => props.worker,
    (newUser) => {
        if (newUser) Object.assign(formData, newUser)
    },
    { immediate: true }
)

function guardarCambios() {
  router.put(route("workers.update", formData.id), formData, {
    preserveScroll: true,
    onSuccess: () => console.log("Trabajador actualizado correctamente"),
    onError: (errors) => console.error(errors),
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
                </div>

                <div class="grid gap-3">
                    <Label>Correo electrónico</Label>
                    <Input v-model="formData.email" type="email" placeholder="ejemplo@correo.com" />
                </div>

                <div class="grid gap-3">
                    <Label>Dirección</Label>
                    <Input v-model="formData.address" placeholder="Dirección del trabajador" />
                </div>

                <div class="grid gap-3">
                    <Label>Teléfono</Label>
                    <Input v-model="formData.phone" type="tel" placeholder="Número de teléfono" />
                </div>
            </div>

            <SheetFooter class="mt-6">
                <SheetClose asChild>
                    <Button type="button" @click="guardarCambios">Guardar cambios</Button>
                </SheetClose>
                <SheetClose asChild>
                    <Button variant="outline">Cerrar</Button>
                </SheetClose>
            </SheetFooter>
        </SheetContent>
    </Sheet>
</template>
