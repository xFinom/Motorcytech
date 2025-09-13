<script lang="ts" setup>
import { reactive, watch } from 'vue'
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
  SheetTrigger,
} from '@/Components/ui/sheet'

import { router } from "@inertiajs/vue3"

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

// Creamos un objeto reactivo para edición
const formData = reactive<UserRow>({
  id: 0,
  name: '',
  email: '',
  rfc: '',
  role: '',
  address: '',
  phone: '',
})

// Copiamos los datos del prop al formData cuando cambie
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
  router.put(route("users.update", formData.id), formData, {
    preserveScroll: true,
    onSuccess: () => {
      console.log("Usuario actualizado correctamente")
    },
    onError: (errors) => {
      console.error(errors)
    }
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
        </div>

        <div class="grid gap-3">
          <Label>Correo electrónico</Label>
          <Input v-model="formData.email" type="email" placeholder="ejemplo@correo.com" />
        </div>

        <div class="grid gap-3">
          <Label>RFC</Label>
          <Input v-model="formData.rfc" placeholder="RFC del cliente" />
        </div>

        <div class="grid gap-3">
          <Label>Dirección</Label>
          <Input v-model="formData.address" placeholder="Dirección del cliente" />
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
