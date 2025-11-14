<script lang="ts" setup>
import { router } from '@inertiajs/vue3'

import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from '@/Components/ui/alert-dialog'

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

const deleteSupplier = () => {
    if (!props.supplier) return

    router.delete(route('dashboard.suppliers.destroy', props.supplier.id), {
        onSuccess: () => {
            console.log('Proveedor eliminado correctamente')
        },
        onError: (errors) => {
            console.error(errors)
        },
    })
}
</script>

<template>
    <AlertDialog>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>¿Estás completamente seguro?</AlertDialogTitle>
                <AlertDialogDescription>
                    Esta acción no se puede deshacer. Se eliminará permanentemente al proveedor
                    <strong>{{ props.supplier?.company }}</strong>
                    y no podrás recuperar la información.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel>Cancelar</AlertDialogCancel>
                <AlertDialogAction @click="deleteSupplier">Eliminar</AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
