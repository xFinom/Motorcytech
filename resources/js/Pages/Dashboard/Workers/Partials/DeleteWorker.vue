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

type WorkerRow = {
    id: number
    name: string
    email: string
    address: string
    phone: string
}

const props = defineProps<{ worker: WorkerRow | null }>()

const deleteUser = () => {
    router.delete(route('dashboard.workers.destroy', props.worker!.id), {
        onSuccess: () => console.log('Trabajador eliminado correctamente'),
        onError: (errors) => console.error(errors),
    })
}
</script>

<template>
    <AlertDialog>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>¿Estás completamente seguro?</AlertDialogTitle>
                <AlertDialogDescription>
                    Esta acción no se puede deshacer. Se eliminará permanentemente al usuario
                    {{ props.worker?.name }}.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel>Cancelar</AlertDialogCancel>
                <AlertDialogAction @click="deleteUser">Continuar</AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
