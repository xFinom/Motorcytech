<script lang="ts" setup>
import { ArrowUpDown, ChevronDown, MoreVertical } from 'lucide-vue-next'

import { computed, defineProps, ref } from 'vue'

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

// Recibir trabajadores desde el backend (paginados)
const props = defineProps<{
    // workers: {
    //     data: Array<{
    //         id: number
    //         name: string
    //         email: string
    //         role: string
    //         address: string
    //         phone: string
    //     }>
    //     current_page: number
    //     last_page: number
    // }
    serviceOrders: any
}>()

type WorkerRow = {
    id: number
    name: string
    email: string
    role: string
    address: string
    phone: string
}

// Estado para guardar el usuario seleccionado
const selectedWorker = ref<WorkerRow | null>(null)

// (Opcional para el siguiente paso) bandera para abrir/cerrar modal/hoja de edición
const isEditOpen = ref(false)
const isDeleteOpen = ref(false)

function onClickDelete(worker: WorkerRow) {
    selectedWorker.value = { ...worker} // guardamos la fila
    isDeleteOpen.value = true             // abrimos el modal
}

function onClickEdit(worker: WorkerRow) {
    selectedWorker.value = { ...worker }
    isEditOpen.value = true
}

// Barra de filtrado
const filter = ref('')

// Lista filtrada (por varias columnas)
const filteredWorkers = computed(() => {
    if (!filter.value) return props.serviceOrders.data
    const f = filter.value.toLowerCase()
    return props.serviceOrders.data.filter(
        (serviceOrder) =>
            serviceOrder.client.name.toLowerCase().includes(f) ||
            serviceOrder.email.toLowerCase().includes(f) ||
            serviceOrder.address.toLowerCase().includes(f)
    )
})

// utils/date.ts
function formatDate(value: string, locale = "es-MX") {
    if (!value) return ""
    return new Intl.DateTimeFormat(locale, {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
    }).format(new Date(value))
}



// Columnas visuales
const columns = [
    { name: 'Cliente', sortable: true },
    { name: 'Marca', sortable: false },
    { name: 'Placa', sortable: false },
    { name: 'Estatus', sortable: false },
    { name: 'Servicio', sortable: false },
    { name: 'Fecha de Entrada', sortable: false },
]
</script>

<template>
    <DashboardLayout>
        <div class="pl-20 pr-20 pt-2">
            <div class="pl-20 pr-20">
                <!-- Barra de filtrado -->
                <div class="flex items-center py-4">
                    <Input
                        v-model="filter"
                        class="max-w-sm"
                        placeholder="Buscar motocicleta"
                    />
                </div>

                <!-- Tabla -->
                <div class="rounded-md border">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead v-for="col in columns" :key="col.name" class="text-left">
                                    <div class="flex items-center text-primary">
                                        <span v-if="!col.hideHeader">{{ col.name }}</span>
                                    </div>
                                </TableHead>
                            </TableRow>
                        </TableHeader>

                        <TableBody>
                            <!-- Mostrar trabajadores filtrados -->
                            <TableRow v-for="worker in filteredWorkers" :key="worker.email">
                                <TableCell>{{ worker.client.name }}</TableCell>
                                <TableCell>{{ worker.motorcycle.brand.name }}</TableCell>
                                <TableCell>{{ worker.motorcycle.placa }}</TableCell>
                                <TableCell>{{ worker.status }}</TableCell>
                                <TableCell>{{ formatDate(worker.entry_date) }}</TableCell>
                                <TableCell>{{ 'Mantenimiento' }}</TableCell>
                                <TableCell>
                                    <DropdownMenu>
                                        <DropdownMenuTrigger as-child>
                                            <Button variant="ghost" size="sm" class="h-8 w-8 p-0">
                                                <MoreVertical class="h-4 w-4" />
                                            </Button>
                                        </DropdownMenuTrigger>
                                        <DropdownMenuContent align="end">
                                            <DropdownMenuItem @click="onClickEdit(worker)"
                                            >Editar</DropdownMenuItem
                                            >
                                            <DropdownMenuItem @click="onClickDelete(worker)"
                                            >Eliminar</DropdownMenuItem
                                            >
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                </TableCell>
                            </TableRow>

                            <!-- Fila vacía si no hay coincidencias -->
                            <TableRow v-if="filteredWorkers.length === 0">
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
                        :disabled="props.serviceOrders.current_page === 1"
                        @click="
                            $inertia.get(route('service.order.index'), {
                                page: props.serviceOrders.current_page - 1,
                            })
                        "
                    >
                        Anterior
                    </Button>

                    <Button
                        class="text-primary"
                        variant="outline"
                        size="sm"
                        :disabled="props.serviceOrders.current_page === props.serviceOrders.last_page"
                        @click="
                            $inertia.get(route('service.order.index'), {
                                page: props.serviceOrders.current_page + 1,
                            })
                        "
                    >
                        Siguiente
                    </Button>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
