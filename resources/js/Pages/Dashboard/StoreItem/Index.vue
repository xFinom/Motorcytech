<script setup lang="ts">
import { ArrowUpDown, MoreVertical } from 'lucide-vue-next'

import { computed, ref } from 'vue'

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
import { PaginatedStoreItemList } from '@/interfaces/StoreItem'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import StoreForm from '@/Pages/Dashboard/StoreItem/Partials/StoreForm.vue'

const props = defineProps<{
    products: PaginatedStoreItemList
}>()

// Filtrado
const filterText = ref('')
const filteredItems = computed(() =>
    props.products.data.filter(
        (item) =>
            item.name.toLowerCase().includes(filterText.value.toLowerCase())
    )
)

const columns = [
    { name: 'Nombre', sortable: false },
    { name: 'Descripción', sortable: false },
    { name: 'Cantidad', sortable: false },
    { name: 'Precio', sortable: false },
    { name: 'Acciones', sortable: false, hideHeader: true },
]

type ItemRow = (typeof props.products.data)[number]

// Estado de modales / Sheets
const showCreateItem = ref(false)
const selectedItem = ref<ItemRow | null>(null)
const isEditOpen = ref(false)

function onClickEdit(supplier: ItemRow) {
    selectedItem.value = { ...supplier }
    isEditOpen.value = true
}
</script>

<template>
    <DashboardLayout>
    <div class="w-full max-w-7xl mx-auto">
        <div class="flex items-center justify-between  py-4">
            <Input class="max-w-sm" placeholder="Buscar" v-model="filterText" />
            <Button @click="showCreateItem = true"> Agregar </Button>
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
                    <TableRow v-for="item in filteredItems" :key="item.id">
                        <TableCell>{{ item.name }}</TableCell>
                        <TableCell>{{ item.description }}</TableCell>
                        <TableCell>{{ item.quantity }}</TableCell>
                        <TableCell>${{ item.price }}</TableCell>

                        <TableCell>
                            <DropdownMenu>
                                <DropdownMenuTrigger as-child>
                                    <Button variant="ghost" size="sm" class="h-8 w-8 p-0">
                                        <MoreVertical class="h-4 w-4" />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="end">
                                    <DropdownMenuItem @click="onClickEdit(item)">
                                        Editar
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </TableCell>
                    </TableRow>

                    <TableRow v-if="filteredItems.length === 0">
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
                :disabled="products.current_page === 1"
                @click="
                    $inertia.get(route('dashboard.store.items.index'), {
                        page: products.current_page - 1,
                    })
                "
            >
                Anterior
            </Button>

            <Button
                class="text-primary"
                variant="outline"
                size="sm"
                :disabled="products.current_page === products.last_page"
                @click="
                    $inertia.get(route('dashboard.store.items.index'), {
                        page: products.current_page + 1,
                    })
                "
            >
                Siguiente
            </Button>
        </div>
    </div>
    </DashboardLayout>
    <StoreForm
        v-model:open="isEditOpen"
        v-if="selectedItem"
        :item="selectedItem"
    />
</template>
