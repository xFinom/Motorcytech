<script setup lang="ts">
import { ref, watch } from 'vue'

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
import { ServiceOrderStatus } from '@/enums/ServiceOrderStatus'
import type { ServiceOrder } from '@/interfaces/ServiceOrder'

// Props
const props = defineProps<{
    modelValue: boolean
    serviceOrder: ServiceOrder | null
}>()

const emit = defineEmits(['update:modelValue', 'updated'])

const isOpen = ref(props.modelValue)

watch(
    () => props.modelValue,
    (val) => (isOpen.value = val)
)

watch(isOpen, (val) => emit('update:modelValue', val))

const statuses = Object.values(ServiceOrderStatus) as ServiceOrderStatus[]
const newStatus = ref<ServiceOrderStatus>(statuses[0])

const allowedStatuses = ref<ServiceOrderStatus[]>([])

const getAllowedStatuses = (currentStatus: ServiceOrderStatus) => {
    let allowed: ServiceOrderStatus[] = []

    switch (currentStatus) {
        case ServiceOrderStatus.FINALIZADO:
            allowed = []
            break
        case ServiceOrderStatus.LISTO:
            allowed = [ServiceOrderStatus.LISTO, ServiceOrderStatus.FINALIZADO]
            break
        case ServiceOrderStatus.DETENIDO:
            allowed = [
                ServiceOrderStatus.DETENIDO,
                ServiceOrderStatus.EN_PROCESO,
                ServiceOrderStatus.LISTO,
            ]
            break
        case ServiceOrderStatus.EN_PROCESO:
            allowed = [
                ServiceOrderStatus.EN_PROCESO,
                ServiceOrderStatus.DETENIDO,
                ServiceOrderStatus.LISTO,
            ]
            break
        case ServiceOrderStatus.INGRESADO:
            allowed = [ServiceOrderStatus.INGRESADO, ServiceOrderStatus.EN_PROCESO]
            break
        default:
            allowed = [currentStatus]
    }

    if (!allowed.includes(currentStatus)) allowed.unshift(currentStatus)

    return allowed
}

watch(
    () => props.serviceOrder,
    (order) => {
        if (order) {
            newStatus.value = order.status
            allowedStatuses.value = getAllowedStatuses(order.status)
        }
    },
    { immediate: true }
)

const close = () => (isOpen.value = false)

const updateStatus = async () => {
    if (!props.serviceOrder) return
    if (newStatus.value === props.serviceOrder.status) return

    try {
        router.patch(
            route('service-orders.update-status', props.serviceOrder.id),
            {
                status: newStatus.value,
            },
            {
                preserveScroll: true,
                onSuccess: () => {
                    emit('updated')
                    close()
                },
            }
        )
    } catch (error) {
        //
    }
}
</script>

<template>
    <AlertDialog v-model:open="isOpen">
        <AlertDialogContent class="my-18 mx-auto rounded-lg p-6 shadow-lg sm:max-w-[425px]">
            <AlertDialogHeader>
                <AlertDialogTitle class="text-center"
                    >Actualizar estado de la orden
                </AlertDialogTitle>
                <AlertDialogDescription class="text-center text-primary">
                    Estás modificando la orden <strong>#{{ serviceOrder?.id }}</strong
                    >.
                </AlertDialogDescription>
            </AlertDialogHeader>

            <form @submit.prevent="updateStatus" class="mt-2 space-y-4">
                <div>
                    <label for="status" class="text-sm font-medium text-muted-foreground">
                        Estado actual:
                    </label>
                    <select
                        id="status"
                        v-model="newStatus"
                        class="mt-1 w-full rounded-md border border-input bg-background p-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-primary"
                        :disabled="allowedStatuses.length === 0"
                    >
                        <option v-for="status in allowedStatuses" :key="status" :value="status">
                            {{ status }}
                        </option>
                    </select>

                    <p v-if="allowedStatuses.length === 1" class="mt-1 text-sm text-red-500">
                        Esta orden ya ha sido finalizada, no se puede cambiar el estado.
                    </p>
                </div>

                <AlertDialogFooter>
                    <AlertDialogCancel @click="close">Cancelar</AlertDialogCancel>
                    <AlertDialogAction
                        type="submit"
                        :disabled="
                            allowedStatuses.length === 0 || newStatus === serviceOrder?.status
                        "
                    >
                        Actualizar
                    </AlertDialogAction>
                </AlertDialogFooter>
            </form>
        </AlertDialogContent>
    </AlertDialog>
</template>
