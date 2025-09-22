<script lang="ts" setup>
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
} from "@/Components/ui/alert-dialog"
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

const deleteUser = () => {
  if (!props.user) return

  router.delete(route("users.destroy", props.user.id), {
    onSuccess: () => {
      console.log("Usuario eliminado correctamente")
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
          Esta acción no se puede deshacer. Se eliminará permanentemente al
          usuario {{ props.user?.name }}.
        </AlertDialogDescription>
      </AlertDialogHeader>
      <AlertDialogFooter>
        <AlertDialogCancel>Cancelar</AlertDialogCancel>
        <AlertDialogAction @click="deleteUser">Continuar</AlertDialogAction>
      </AlertDialogFooter>
    </AlertDialogContent>
  </AlertDialog>
</template>
