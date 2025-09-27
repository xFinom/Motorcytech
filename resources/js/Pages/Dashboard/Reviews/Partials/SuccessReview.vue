<script setup lang="ts">

import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from '@/Components/ui/alert-dialog'

import { router } from '@inertiajs/vue3'

</script>

<template>
    <AlertDialog>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Muchas gracias por comentar</AlertDialogTitle>
                <AlertDialogDescription>
                    Tu opinion nos importa mucho, vuelve pronto!!!
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogAction @click="router.get('/')">Regresar al inicio</AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
