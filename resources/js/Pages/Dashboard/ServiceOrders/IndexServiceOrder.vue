<script lang="ts" setup>
import { ArrowUpDown, ChevronDown, MoreVertical } from 'lucide-vue-next'

import { computed, defineProps, ref } from 'vue'

import { router } from '@inertiajs/vue3'

import { Avatar, AvatarFallback, AvatarImage } from '@/Components/ui/avatar'
import { Badge } from '@/Components/ui/badge'
import { Button } from '@/Components/ui/button'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'
import { Input } from '@/Components/ui/input'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import {
    ServiceOrderStatus,
    ServiceOrderStatusBadges,
    ServiceOrderStatusIcons,
    ServiceOrderStatusLabels,
} from '@/enums/ServiceOrderStatus'
import { PaginatedServiceOrderList, ServiceOrder } from '@/interfaces/ServiceOrder'
import { formatDate } from '@/utils/date'
import { generateInitials } from '@/utils/name'

import UpdateServiceOrder from './Partials/UpdateServiceOrder.vue'

const props = defineProps<{
    serviceOrders: PaginatedServiceOrderList
}>()

// Estado para guardar el usuario seleccionado
const selectedOrder = ref<ServiceOrder | null>(null)

// (Opcional para el siguiente paso) bandera para abrir/cerrar modal/hoja de edición
const isEditOpen = ref(false)

function onClickEdit(order: ServiceOrder) {
    selectedOrder.value = { ...order }
    isEditOpen.value = true
}

function onUpdated() {
    router.reload()
}

// Barra de filtrado
const filter = ref('')

// Lista filtrada (por varias columnas)
const fitleredServiceOrders = computed(() => {
    if (!filter.value) return props.serviceOrders.data
    const f = filter.value.toLowerCase()
    return props.serviceOrders.data.filter(
        (serviceOrder: ServiceOrder) =>
            serviceOrder.client.name.toLowerCase().includes(f) ||
            serviceOrder.motorcycle.placa.toLowerCase().includes(f) ||
            serviceOrder.motorcycle.type.name.toLowerCase().includes(f)
    )
})

// Columnas visuales
const columns = [
    { name: 'Cliente', sortable: true },
    { name: 'Motocicleta', sortable: false },
    { name: 'Fecha de Entrada', sortable: false },
    { name: 'Servicio', sortable: false },
    { name: 'Estatus', sortable: false },
    { name: 'Acciones', sortable: false },
]

function goToTracking(order: ServiceOrder) {
    router.get(route('service-orders.show', { serviceOrder: order.id }))
}
</script>

<template>
    <DashboardLayout>
        <div class="pl-20 pr-20 pt-2">
            <div class="pl-20 pr-20">
                <!-- Barra de filtrado -->

                <div class="flex items-center py-4">
                    <Input v-model="filter" class="max-w-sm" placeholder="Buscar motocicleta" />
                </div>

                <!-- Tabla -->
                <div class="rounded-md border">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead v-for="col in columns" :key="col.name" class="text-left">
                                    <div class="flex items-center text-primary">
                                        <span>{{ col.name }}</span>
                                    </div>
                                </TableHead>
                            </TableRow>
                        </TableHeader>

                        <TableBody>
                            <!-- Mostrar trabajadores filtrados -->
                            <TableRow v-for="order in fitleredServiceOrders" :key="order.id">
                                <TableCell
                                    ><div
                                        class="flex items-center gap-2 px-1 py-1.5 text-left text-sm"
                                    >
                                        <Avatar class="h-8 w-8 rounded-lg">
                                            <AvatarFallback class="rounded-lg text-primary">
                                                {{ generateInitials(order.client.name) }}
                                            </AvatarFallback>
                                        </Avatar>
                                        <div class="grid flex-1 text-left text-sm leading-tight">
                                            <span class="truncate font-semibold">{{
                                                order.client.name
                                            }}</span>
                                            <span class="truncate text-xs">{{
                                                order.client.email
                                            }}</span>
                                        </div>
                                    </div></TableCell
                                >
                                <TableCell>
                                    <div
                                        class="flex items-center gap-2 px-1 py-1.5 text-left text-sm"
                                    >
                                        <div class="grid flex-1 text-left text-sm leading-tight">
                                            <span class="truncate font-semibold">{{
                                                order.motorcycle.type.brand.name +
                                                ': ' +
                                                order.motorcycle.type.name
                                            }}</span>
                                            <span class="truncate text-xs"
                                                >Placas: {{ order.motorcycle.placa }}</span
                                            >
                                        </div>
                                    </div></TableCell
                                >
                                <TableCell>{{ formatDate(order.entry_date) }}</TableCell>
                                <TableCell
                                    ><Badge
                                        class="bg-neutral-100 text-neutral-800 dark:bg-neutral-800 dark:text-neutral-200"
                                        >{{ order.service.name }}</Badge
                                    ></TableCell
                                >
                                <TableCell
                                    ><Badge :class="['', ServiceOrderStatusBadges[order.status]]">
                                        <component
                                            :is="ServiceOrderStatusIcons[order.status]"
                                            class="mr-1 h-3.5 w-3.5"
                                        />

                                        <span>{{ ServiceOrderStatusLabels[order.status] }}</span>
                                    </Badge>
                                </TableCell>
                                <TableCell>
                                    <DropdownMenu>
                                        <DropdownMenuTrigger as-child>
                                            <Button variant="ghost" size="sm" class="h-8 w-8 p-0">
                                                <MoreVertical class="h-4 w-4" />
                                            </Button>
                                        </DropdownMenuTrigger>
                                        <DropdownMenuContent align="end">
                                            <DropdownMenuItem @click="onClickEdit(order)">
                                                Cambiar estatus
                                            </DropdownMenuItem>
                                            <DropdownMenuItem @click="goToTracking(order)">
                                                Seguimiento de orden
                                            </DropdownMenuItem>
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                </TableCell>
                            </TableRow>

                            <!-- Fila vacía si no hay coincidencias -->
                            <TableRow v-if="fitleredServiceOrders.length === 0">
                                <TableCell
                                    :colspan="columns.length"
                                    class="h-24 text-center text-muted-foreground"
                                >
                                    No se encontraron resultados.
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>

                <!-- Paginación -->
                <div class="mt-4 flex justify-end space-x-2">
                    <Button
                        class="text-primary"
                        variant="outline"
                        size="sm"
                        :disabled="serviceOrders.current_page === 1"
                        @click="
                            $inertia.get(route('service.order.index'), {
                                page: serviceOrders.current_page - 1,
                            })
                        "
                    >
                        Anterior
                    </Button>

                    <Button
                        class="text-primary"
                        variant="outline"
                        size="sm"
                        :disabled="serviceOrders.current_page === serviceOrders.last_page"
                        @click="
                            $inertia.get(route('service.order.index'), {
                                page: serviceOrders.current_page + 1,
                            })
                        "
                    >
                        Siguiente
                    </Button>
                </div>
            </div>
        </div>
        <UpdateServiceOrder
            :model-value="isEditOpen"
            @update:model-value="(val) => (isEditOpen = val)"
            :service-order="selectedOrder"
            @updated="onUpdated"
        />
    </DashboardLayout>
</template>
