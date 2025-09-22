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
import UpdateWorker from '@/Pages/Dashboard/Workers/Partials/UpdateWorker.vue'

import CreateWorker from './Partials/CreateWorker.vue'
import DeleteWorker from './Partials/DeleteWorker.vue'

// Recibir trabajadores desde el backend (paginados)
const props = defineProps<{
    workers: {
        data: Array<{
            id: number
            name: string
            email: string
            role: string
            address: string
            phone: string
        }>
        current_page: number
        last_page: number
    }
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
const isCreateOpen = ref(false)

function onClickDelete(worker: WorkerRow) {
    selectedWorker.value = { ...worker } // guardamos la fila
    isDeleteOpen.value = true // abrimos el modal
}

function onClickEdit(worker: WorkerRow) {
    selectedWorker.value = { ...worker }
    isEditOpen.value = true
}

// Barra de filtrado
const filter = ref('')

// Lista filtrada (por varias columnas)
const filteredWorkers = computed(() => {
    if (!filter.value) return props.workers.data
    const f = filter.value.toLowerCase()
    return props.workers.data.filter(
        (worker) =>
            worker.name.toLowerCase().includes(f) ||
            worker.email.toLowerCase().includes(f) ||
            worker.address.toLowerCase().includes(f)
    )
})

// Columnas visuales
const columns = [
    { name: 'Nombre', sortable: true },
    { name: 'Correo electrónico', sortable: false },
    { name: 'Rol', sortable: false },
    { name: 'Dirección', sortable: false },
    { name: 'Teléfono', sortable: false },
    { name: 'Acciones', sortable: false, hideHeader: true },
]
</script>

<template>
    <DashboardLayout>
        <div class="pl-20 pr-20 pt-2">
            <div class="pl-20 pr-20">
                <!-- Barra de filtrado -->
                <div class="flex items-center justify-between py-4">
                    <Input
                        v-model="filter"
                        class="max-w-sm"
                        placeholder="Filtrar trabajadores..."
                    />
                    <Button @click="isCreateOpen = true"> Crear </Button>
                </div>

                <!-- Tabla -->
                <div class="rounded-md border">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead v-for="col in columns" :key="col.name" class="text-left">
                                    <div class="flex items-center text-primary">
                                        <span v-if="!col.hideHeader">{{ col.name }}</span>
                                        <ArrowUpDown v-if="col.sortable" class="ml-2 h-4 w-4" />
                                    </div>
                                </TableHead>
                            </TableRow>
                        </TableHeader>

                        <TableBody>
                            <!-- Mostrar trabajadores filtrados -->
                            <TableRow v-for="worker in filteredWorkers" :key="worker.email">
                                <TableCell>{{ worker.name }}</TableCell>
                                <TableCell>{{ worker.email }}</TableCell>
                                <TableCell>{{ worker.role }}</TableCell>
                                <TableCell>{{ worker.address }}</TableCell>
                                <TableCell>{{ worker.phone }}</TableCell>
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
                        :disabled="props.workers.current_page === 1"
                        @click="
                            $inertia.get(route('userslist'), {
                                page: props.workers.current_page - 1,
                            })
                        "
                    >
                        Anterior
                    </Button>

                    <Button
                        class="text-primary"
                        variant="outline"
                        size="sm"
                        :disabled="props.workers.current_page === props.workers.last_page"
                        @click="
                            $inertia.get(route('userslist'), {
                                page: props.workers.current_page + 1,
                            })
                        "
                    >
                        Siguiente
                    </Button>
                </div>
            </div>
        </div>
    </DashboardLayout>
    <DeleteWorker v-model:open="isDeleteOpen" v-if="selectedWorker" :worker="selectedWorker" />
    <UpdateWorker v-model:open="isEditOpen" v-if="selectedWorker" :worker="selectedWorker" />
    <CreateWorker v-model:open="isCreateOpen" />
</template>
