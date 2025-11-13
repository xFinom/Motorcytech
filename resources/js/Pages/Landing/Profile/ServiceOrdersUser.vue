<script setup lang="ts">

import ProfileLayout from '../../../Layouts/ProfileLayout.vue';

import { computed, defineProps, ref } from 'vue'

import { Avatar, AvatarFallback, AvatarImage } from '@/Components/ui/avatar'
import { Badge } from '@/Components/ui/badge'
import { Button } from '@/Components/ui/button'
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

const props = defineProps<{
    serviceOrders: PaginatedServiceOrderList
}>()

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
]

</script>

<template>
    <ProfileLayout>
        <div class="pl-20 pr-20 pt-2 bg-transparent text-gray-800 dark:bg-transparent dark:text-gray-200">
            <div class="pl-20 pr-20">
                <!-- Barra de filtrado -->
                <div class="flex items-center py-4">
                    <Input
                        v-model="filter"
                        class="max-w-sm border border-gray-300 bg-white text-gray-800 placeholder-gray-400
                               focus:border-[#FF6B00] focus:ring-[#FF6B00]
                               dark:border-gray-700 dark:bg-[#141C2E] dark:text-gray-100 dark:placeholder-gray-400"
                        placeholder="Buscar motocicleta"
                    />
                </div>

                <!-- Tabla -->
                <div class="rounded-md shadow-sm bg-transparent border border-transparent">
                    <Table>
                        <TableHeader>
                            <TableRow class="bg-gray-100 dark:bg-[#1B2539]">
                                <TableHead
                                    v-for="col in columns"
                                    :key="col.name"
                                    class="text-left text-gray-700 dark:text-gray-200 font-semibold"
                                >
                                    <div class="flex items-center">
                                        <span>{{ col.name }}</span>
                                    </div>
                                </TableHead>
                            </TableRow>
                        </TableHeader>

                        <TableBody>
                            <TableRow
                                v-for="order in fitleredServiceOrders"
                                :key="order.id"
                                class="hover:bg-gray-50 dark:hover:bg-[#1F2A3D] transition-colors duration-200"
                            >
                                <!-- Cliente -->
                                <TableCell>
                                    <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                        <Avatar class="h-8 w-8 rounded-lg">
                                            <AvatarFallback
                                                class="rounded-lg bg-gray-200 text-gray-800
                                                       dark:bg-[#FF6B00]/20 dark:text-[#FF6B00]"
                                            >
                                                {{ generateInitials(order.client.name) }}
                                            </AvatarFallback>
                                        </Avatar>
                                        <div class="grid flex-1 text-left text-sm leading-tight">
                                            <span class="truncate font-semibold text-gray-900 dark:text-white">
                                                {{ order.client.name }}
                                            </span>
                                            <span class="truncate text-xs text-gray-500 dark:text-gray-400">
                                                {{ order.client.email }}
                                            </span>
                                        </div>
                                    </div>
                                </TableCell>

                                <!-- Motocicleta -->
                                <TableCell>
                                    <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                        <div class="grid flex-1 text-left text-sm leading-tight">
                                            <span class="truncate font-semibold text-gray-900 dark:text-white">
                                                {{ order.motorcycle.type.brand.name }}:
                                                {{ order.motorcycle.type.name }}
                                            </span>
                                            <span class="truncate text-xs text-gray-500 dark:text-gray-400">
                                                Placas: {{ order.motorcycle.placa }}
                                            </span>
                                        </div>
                                    </div>
                                </TableCell>

                                <!-- Fecha -->
                                <TableCell class="text-gray-700 dark:text-gray-300">
                                    {{ formatDate(order.entry_date) }}
                                </TableCell>

                                <!-- Servicio -->
                                <TableCell>
                                    <Badge class="bg-gray-100 text-gray-800 dark:bg-[#1B2539] dark:text-gray-200 border dark:border-gray-700">
                                        {{ order.service.name }}
                                    </Badge>
                                </TableCell>

                                <!-- Estado -->
                                <TableCell>
                                    <Badge
                                        :class="['', ServiceOrderStatusBadges[order.status]]"
                                        class="flex items-center gap-1 px-2 py-1
                                               dark:bg-[#1B2539] dark:text-gray-200 dark:border dark:border-gray-700"
                                    >
                                        <component
                                            :is="ServiceOrderStatusIcons[order.status]"
                                            class="h-3.5 w-3.5 text-[#FF6B00]"
                                        />
                                        <span>{{ ServiceOrderStatusLabels[order.status] }}</span>
                                    </Badge>
                                </TableCell>
                            </TableRow>

                            <!-- Sin resultados -->
                            <TableRow v-if="fitleredServiceOrders.length === 0">
                                <TableCell
                                    :colspan="columns.length"
                                    class="h-24 text-center text-gray-500 dark:text-gray-400"
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
                        class="text-[#FF6B00] border-gray-300 dark:border-gray-700
                               hover:bg-[#FF6B00] hover:text-white transition"
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
                        class="text-[#FF6B00] border-gray-300 dark:border-gray-700
                               hover:bg-[#FF6B00] hover:text-white transition"
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
    </ProfileLayout>
</template>

