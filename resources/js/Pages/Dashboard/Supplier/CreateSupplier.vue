<script lang="ts" setup>
import { reactive } from 'vue'
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

// Props y emits para controlar apertura desde padre
const props = defineProps<{ open: boolean }>()
const emit = defineEmits(['update:open', 'success'])

// Definimos tipo para el formulario
type SupplierForm = {
  company: string
  representative: string
  address: string
  email: string
  phone: string
  product: string
}

// Formulario reactivo
const formData = reactive<SupplierForm>({
  company: '',
  representative: '',
  address: '',
  email: '',
  phone: '',
  product: '',
})

// Función para crear proveedor
function crearProveedor() {
  router.post(route('suppliers.store'), formData, {
    preserveScroll: true,
    onSuccess: () => {
      console.log('Proveedor creado correctamente')
      emit('success')             // notifica al padre que recargue
      emit('update:open', false)  // cierra el Sheet

      // Limpiar formulario de manera segura
      const keys = Object.keys(formData) as Array<keyof SupplierForm>
      keys.forEach((key) => (formData[key] = ''))
    },
    onError: (errors) => {
      console.error(errors)
    },
  })
}
</script>

<template>
  <Sheet v-model:open="props.open"  @update:open="(val) => emit('update:open', val)">
    <SheetContent class="w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl p-6 flex flex-col h-full sm:h-auto">
      <SheetHeader>
        <SheetTitle>Crear nuevo proveedor</SheetTitle>
        <SheetDescription class="mb-4">
          Ingresa los datos del nuevo proveedor y guárdalos.
        </SheetDescription>
      </SheetHeader>

      <div class="w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl p-6 flex flex-col h-full sm:h-auto">
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
        <Button type="button" @click="crearProveedor">Crear</Button>
        <Button variant="outline" @click="emit('update:open', false)">Cerrar</Button>
      </SheetFooter>
    </SheetContent>
  </Sheet>
</template>
