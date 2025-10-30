<script lang="ts" setup>
import { ArrowUpDown } from 'lucide-vue-next'
import { computed, defineProps, ref } from 'vue'

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

// Recibir órdenes desde el backend (paginadas)
const props = defineProps<{
    orders: {
        data: Array<{
            id: number
            client_name: string
            items: Array<{ id: number; name: string; price: number }>
            total_price: number
        }>
        current_page: number
        last_page: number
    }
}>()

type OrderRow = {
    id: number
    client_name: string
    items: Array<{ id: number; name: string; price: number }>
    total_price: number
}

// Barra de filtrado
const filter = ref('')

// Lista filtrada (por cliente o items)
const filteredOrders = computed(() => {
    if (!filter.value) return props.orders.data
    const f = filter.value.toLowerCase()
    return props.orders.data.filter(
        (order) =>
            order.client_name.toLowerCase().includes(f) ||
            order.items.some(item => item.name.toLowerCase().includes(f))
    )
})

// Columnas visuales
const columns = [
    { name: 'ID Orden', sortable: true },
    { name: 'Cliente', sortable: true },
    { name: 'Items', sortable: false },
    { name: 'Total', sortable: false },
]
</script>

<template>
    <DashboardLayout>
        <div class="pl-20 pr-20 pt-2">
            <!-- Barra de filtrado -->
            <div class="flex items-center justify-between py-4">
                <Input
                    v-model="filter"
                    class="max-w-sm"
                    placeholder="Filtrar órdenes..."
                />
            </div>

            <!-- Tabla -->
            <div class="rounded-md border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead v-for="col in columns" :key="col.name" class="text-left">
                                <div class="flex items-center text-primary">
                                    <span>{{ col.name }}</span>
                                    <ArrowUpDown v-if="col.sortable" class="ml-2 h-4 w-4" />
                                </div>
                            </TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        <TableRow v-for="order in filteredOrders" :key="order.id">
                            <TableCell>{{ order.id }}</TableCell>
                            <TableCell>{{ order.client_name }}</TableCell>
                            <TableCell>
                                <ul>
                                    <li v-for="item in order.items" :key="item.id">
                                        {{ item.name }} - ${{ item.price }}
                                    </li>
                                </ul>
                            </TableCell>
                            <TableCell>${{ order.total_price }}</TableCell>
                        </TableRow>

                        <!-- Fila vacía si no hay coincidencias -->
                        <TableRow v-if="filteredOrders.length === 0">
                            <TableCell :colspan="columns.length" class="h-24 text-center text-muted-foreground">
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
                    :disabled="props.orders.current_page === 1"
                    @click="$inertia.get(route('purchase_orders.index'), { page: props.orders.current_page - 1 })"
                >
                    Anterior
                </Button>

                <Button
                    class="text-primary"
                    variant="outline"
                    size="sm"
                    :disabled="props.orders.current_page === props.orders.last_page"
                    @click="$inertia.get(route('purchase_orders.index'), { page: props.orders.current_page + 1 })"
                >
                    Siguiente
                </Button>
            </div>
        </div>
    </DashboardLayout>
</template>

