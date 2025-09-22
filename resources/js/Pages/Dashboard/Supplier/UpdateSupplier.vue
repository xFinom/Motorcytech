<script lang="ts" setup>
import { reactive, watch, defineEmits } from 'vue'
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
import { router } from "@inertiajs/vue3"

type SupplierRow = {
  id: number
  company: string
  representative: string 
  address: string 
  email: string 
  phone: string 
  product: string
}


const props = defineProps<{
  supplier: SupplierRow | null
}>()


// Objeto reactivo para el formulario
const formData = reactive<SupplierRow>({
  id: 0,
  company: '',
  representative: '',
  address: '',
  email: '',
  phone: '',
  product: '',
})

// Copiar datos del prop al formData
watch(
  () => props.supplier,
  (newSupplier) => {
    if (newSupplier) {
      Object.assign(formData, newSupplier)
    }
  },
  { immediate: true }
)

function guardarCambios() {
  router.put(route("suppliers.update", formData.id), formData, {
    preserveScroll: true,
    onSuccess: () => {
      console.log("Proveedor actualizado correctamente")
    },
    onError: (errors) => {
      console.error(errors)
    }
  })
}
</script>

<template>
  <Sheet>
    <SheetContent class="w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl p-6 flex flex-col h-full sm:h-auto">
      <SheetHeader>
        <SheetTitle>Editar proveedor</SheetTitle>
        <SheetDescription class="mb-4">
          Realiza los cambios necesarios y guarda antes de salir.
        </SheetDescription>
      </SheetHeader>

      <div class="flex-1 overflow-y-auto grid auto-rows-min gap-4 px-2 sm:px-4">
        <div class="grid gap-2">
          <Label>Nombre de la empresa</Label>
          <Input v-model="formData.company" placeholder="Nombre de la empresa" />
        </div>

        <div class="grid gap-2">
          <Label>Nombre del representante</Label>
          <Input v-model="formData.representative" placeholder="Nombre del representante" />
        </div>

        <div class="grid gap-2">
          <Label>Dirección</Label>
          <Input v-model="formData.address" placeholder="Dirección de la empresa" />
        </div>

        <div class="grid gap-2">
          <Label>Correo electrónico</Label>
          <Input v-model="formData.email" type="email" placeholder="ejemplo@correo.com" />
        </div>

        <div class="grid gap-2">
          <Label>Teléfono</Label>
          <Input v-model="formData.phone" type="tel" placeholder="Número de teléfono" />
        </div>

        <div class="grid gap-2">
          <Label>Producto</Label>
          <Input v-model="formData.product" placeholder="Producto" />
        </div>
      </div>

      <SheetFooter class="mt-4 flex justify-end gap-2">
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
