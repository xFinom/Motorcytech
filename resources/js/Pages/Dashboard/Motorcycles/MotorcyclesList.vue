<script lang="ts" setup>
import { ArrowUpDown, Bike, ChevronDown, MoreVertical, Star, Users, Wrench } from 'lucide-vue-next'

import { defineProps } from 'vue'
import { computed, ref } from 'vue'

import { Avatar, AvatarFallback } from '@/Components/ui/avatar'
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
import { Motorcycle, PaginatedMotorcycleList } from '@/interfaces/Motorcycle'
import { generateInitials } from '@/utils/name'
import UserOverview from '@/Components/UserOverview.vue'
import MetricCard from '@/Pages/Dashboard/Overview/Partials/MetricCard.vue'

const filterText = ref('')
const filteredMotorcycles = computed(() =>
    props.motorcycles.data.filter((moto: Motorcycle) =>
        moto.type.brand.name.toLowerCase().includes(filterText.value.toLowerCase())
    )
)

// Recibir motocicletas desde el backend (paginadas)
const props = defineProps<{
    motorcycles: PaginatedMotorcycleList
}>()

// Columnas visuales
const columns = [
    { name: 'Cliente', sortable: false },
    { name: 'Placa', sortable: false },
    { name: 'Número de serie', sortable: false },
    { name: 'Número de motor', sortable: false },
    { name: 'Marca', sortable: false },
    { name: 'Modelo', sortable: false },
    { name: 'Acciones', sortable: false, hideHeader: true },
]
</script>

<template>
    <DashboardLayout>
        <div class="w-full mx-auto max-w-7xl">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-2">
                <MetricCard
                    title="Órdenes de Servicio"
                    :value="1"
                    description="Generadas este año"
                    :icon="Wrench"
                />

                <MetricCard
                    title="Clientes"
                    :value="1"
                    description="Atendidos este año"
                    :icon="Users"
                />

                <MetricCard
                    title="Motocicletas"
                    :value="1"
                    description="Actualmente en el taller"
                    :icon="Bike"
                />

                <MetricCard
                    title="Reseñas"
                    :value="1"
                    description="Pendientes de validación"
                    :icon="Star"
                />
            </div>

            <!-- Barra de filtrado -->
            <div class="flex items-center py-4">
                <Input class="max-w-sm" placeholder="Buscar" v-model="filterText" />
            </div>

            <!-- Tabla -->
            <div class="rounded-md border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead
                                v-for="col in columns"
                                :key="col.name"
                                class="text-left text-primary"
                            >
                                <div class="flex items-center">
                                    <span v-if="!col.hideHeader">{{ col.name }}</span>
                                    <ArrowUpDown v-if="col.sortable" class="ml-2 h-4 w-4" />
                                </div>
                            </TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        <!-- Mostrar motocicletas -->
                        <TableRow v-for="moto in filteredMotorcycles" :key="moto.serial_num">
                            <TableCell>
                                <UserOverview :name="moto.cliente.name" :email="moto.cliente.email" />
                            </TableCell>
                            <TableCell>{{ moto.placa }}</TableCell>
                            <TableCell>{{ moto.serial_num }}</TableCell>
                            <TableCell>{{ moto.motor_num }}</TableCell>
                            <TableCell>{{ moto.type.brand.name }}</TableCell>
                            <TableCell>{{ moto.type.name }}</TableCell>
                            <TableCell>
                                <DropdownMenu>
                                    <DropdownMenuTrigger as-child> </DropdownMenuTrigger>
                                </DropdownMenu>
                            </TableCell>
                        </TableRow>

                        <!-- Fila vacía si no hay motos -->
                        <TableRow v-if="filteredMotorcycles.length === 0">
                            <TableCell
                                :colspan="columns.length"
                                class="h-24 text-center text-muted-foreground"
                            >
                                No data.
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
                    :disabled="props.motorcycles.current_page === 1"
                    @click="
                        $inertia.get(route('motorcycleslist'), {
                            page: props.motorcycles.current_page - 1,
                        })
                    "
                >
                    Anterior
                </Button>

                <Button
                    class="text-primary"
                    variant="outline"
                    size="sm"
                    :disabled="props.motorcycles.current_page === props.motorcycles.last_page"
                    @click="
                        $inertia.get(route('motorcycleslist'), {
                            page: props.motorcycles.current_page + 1,
                        })
                    "
                >
                    Siguiente
                </Button>
            </div>
        </div>
    </DashboardLayout>
</template>
