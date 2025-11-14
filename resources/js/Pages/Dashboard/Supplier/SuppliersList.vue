<script lang="ts" setup>
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
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import CreateSupplier from '@/Pages/Dashboard/Supplier/CreateSupplier.vue'
import DeleteSupplier from '@/Pages/Dashboard/Supplier/DeleteSupplier.vue'
import UpdateSupplier from '@/Pages/Dashboard/Supplier/UpdateSupplier.vue'
import UserOverview from '@/Components/UserOverview.vue'

const isScrolled = ref(false)
// Props del backend
const props = defineProps<{
    suppliers: {
        data: Array<{
            id: number
            company: string
            representative: string
            address: string
            email: string
            phone: string
            product: string
        }>
        current_page: number
        last_page: number
    }
}>()

type SupplierRow = (typeof props.suppliers.data)[number]

// Estado de modales / Sheets
const showCreateSupplier = ref(false)
const selectedSupplier = ref<SupplierRow | null>(null)
const isEditOpen = ref(false)
const isDeleteOpen = ref(false)

// Filtrado
const filterText = ref('')
const filteredSuppliers = computed(() =>
    props.suppliers.data.filter(
        (supplier) =>
            supplier.company.toLowerCase().includes(filterText.value.toLowerCase()) ||
            supplier.representative.toLowerCase().includes(filterText.value.toLowerCase())
    )
)

// Columnas de la tabla
const columns = [
    { name: 'Representante', sortable: false },
    { name: 'Compañía', sortable: false },
    { name: 'Dirección', sortable: false },
    { name: 'Teléfono', sortable: false },
    { name: 'Producto', sortable: false },
    { name: 'Acciones', sortable: false, hideHeader: true },
]

// Acciones
function onClickEdit(supplier: SupplierRow) {
    selectedSupplier.value = { ...supplier }
    isEditOpen.value = true
}

function onClickDelete(supplier: SupplierRow) {
    selectedSupplier.value = { ...supplier }
    isDeleteOpen.value = true
}
</script>

<template>
    <DashboardLayout>
        <div class="w-full max-w-7xl mx-auto">
            <!-- Barra de filtrado y botón crear -->
            <div class="flex items-center py-4">
                <Input
                    class="max-w-sm"
                    placeholder="Buscar"
                    v-model="filterText"
                />
                <button
                    class="ml-auto justify-end rounded-md px-4 py-1 font-semibold transition duration-300"
                    :class="
                        isScrolled
                            ? 'border border-[#fb5607] text-white hover:bg-[#fb5607] dark:border-white'
                            : 'border border-[#fb5607] text-black hover:bg-[#fb5607] hover:text-[#fefcf9] dark:text-white'
                    "
                    @click="showCreateSupplier = true"
                >
                    Agregar
                </button>
            </div>

            <!-- Tabla de proveedores -->
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
                        <TableRow v-for="supplier in filteredSuppliers" :key="supplier.id">
                            <TableCell>
                                <UserOverview :name="supplier.representative" :email="supplier.email" />
                            </TableCell>
                            <TableCell>{{ supplier.company }}</TableCell>
                            <TableCell>{{ supplier.address }}</TableCell>
                            <TableCell>{{ supplier.phone }}</TableCell>
                            <TableCell>{{ supplier.product }}</TableCell>
                            <TableCell>
                                <DropdownMenu>
                                    <DropdownMenuTrigger as-child>
                                        <Button variant="outline" size="sm">
                                            <MoreVertical class="h-4 w-4" />
                                        </Button>
                                    </DropdownMenuTrigger>
                                    <DropdownMenuContent>
                                        <DropdownMenuItem @click="onClickEdit(supplier)"
                                            >Editar</DropdownMenuItem
                                        >
                                        <DropdownMenuItem @click="onClickDelete(supplier)"
                                            >Eliminar</DropdownMenuItem
                                        >
                                    </DropdownMenuContent>
                                </DropdownMenu>
                            </TableCell>
                        </TableRow>

                        <TableRow v-if="filteredSuppliers.length === 0">
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
                    :disabled="props.suppliers.current_page === 1"
                    @click="
                        $inertia.get(route('dashboard.suppliers.index'), {
                            page: props.suppliers.current_page - 1,
                        })
                    "
                >
                    Anterior
                </Button>
                <Button
                    class="text-primary"
                    variant="outline"
                    size="sm"
                    :disabled="props.suppliers.current_page === props.suppliers.last_page"
                    @click="
                        $inertia.get(route('dashboard.suppliers.index'), {
                            page: props.suppliers.current_page + 1,
                        })
                    "
                >
                    Siguiente
                </Button>
            </div>
        </div>

        <!-- Componentes modales / sheets -->
        <CreateSupplier v-model:open="showCreateSupplier" @success="$inertia.reload()" />
        <UpdateSupplier
            v-if="selectedSupplier"
            v-model:open="isEditOpen"
            :supplier="selectedSupplier"
            @success="$inertia.reload()"
        />
        <DeleteSupplier
            v-if="selectedSupplier"
            v-model:open="isDeleteOpen"
            :supplier="selectedSupplier"
            @success="$inertia.reload()"
        />
    </DashboardLayout>
</template>
