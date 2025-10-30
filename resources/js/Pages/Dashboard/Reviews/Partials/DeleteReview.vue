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
import { Review } from '@/interfaces/Review'

// Props: la review a eliminar y el estado de apertura del modal
const props = defineProps<{
    open: boolean
    review: Review | null
}>()

// Emitir evento para cerrar el modal
const emit = defineEmits(['update:open'])

// Acción de eliminar
const deleteReview = () => {
    if (!props.review) return

    router.delete(route('reviews.destroy', props.review.id), {
        preserveScroll: true,
        onSuccess: () => {
            console.log('🗑️ Review eliminada correctamente')
            emit('update:open', false)
        },
        onError: (e) => console.error('Error al eliminar review:', e),
    })
}
</script>

<template>
    <AlertDialog :open="open" @update:open="emit('update:open', $event)">
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>¿Estás completamente seguro?</AlertDialogTitle>
                <AlertDialogDescription>
                    Esta acción no se puede deshacer. Se eliminará permanentemente la reseña de
                    <strong>{{ props.review?.client.name }}</strong>.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel @click="emit('update:open', false)">Cancelar</AlertDialogCancel>
                <AlertDialogAction @click="deleteReview">Continuar</AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
