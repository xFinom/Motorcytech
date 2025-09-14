<script lang="ts" setup>
import { ArrowUpDown, ChevronDown, MoreVertical } from 'lucide-vue-next'
import { defineProps, ref, computed } from 'vue'
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

// Recibir proveedores desde el backend (paginados)
const props = defineProps<{
  suppliers: {
    data: Array<{
      id: number,
      company: string,
      representative: string | null,
      address: string | null,
      email: string | null,
      phone: string | null,
      product: string,
    }>,
    current_page: number,
    last_page: number
  }
}>()

// Input de filtrado
const filterText = ref('')

// Filtrado solo en frontend por company o representative
const filteredSuppliers = computed(() =>
  props.suppliers.data.filter((supplier) =>
    (supplier.company || '').toLowerCase().includes(filterText.value.toLowerCase()) ||
    (supplier.representative || '').toLowerCase().includes(filterText.value.toLowerCase())
  )
)

// Columnas visuales
const columns = [
  { name: 'Compañía', sortable: false },
  { name: 'Representante', sortable: false },
  { name: 'Dirección', sortable: false },
  { name: 'Email', sortable: false },
  { name: 'Teléfono', sortable: false },
  { name: 'Producto', sortable: false },
  { name: 'Acciones', sortable: false, hideHeader: true },
]
</script>

<template>
  <DashboardLayout>
    <div class="w-full">
      <!-- Barra de filtrado -->
      <div class="flex items-center py-4">
        <Input
          class="max-w-sm"
          placeholder="Filtrar por compañía o representante..."
          v-model="filterText"
        />
        <Button variant="outline" class="ml-auto">
          Columns <ChevronDown class="ml-2 h-4 w-4" />
        </Button>
      </div>

      <!-- Tabla -->
      <div class="rounded-md border">
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead v-for="col in columns" :key="col.name" class="text-left text-primary">
                <div class="flex items-center">
                  <span v-if="!col.hideHeader">{{ col.name }}</span>
                  <ArrowUpDown v-if="col.sortable" class="ml-2 h-4 w-4" />
                </div>
              </TableHead>
            </TableRow>
          </TableHeader>

          <TableBody>
            <!-- Mostrar proveedores -->
            <TableRow v-for="supplier in filteredSuppliers" :key="supplier.id">
              <TableCell>{{ supplier.company }}</TableCell>
              <TableCell>{{ supplier.representative }}</TableCell>
              <TableCell>{{ supplier.address }}</TableCell>
              <TableCell>{{ supplier.email }}</TableCell>
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
                    <DropdownMenuItem>Editar</DropdownMenuItem>
                    <DropdownMenuItem>Eliminar</DropdownMenuItem>
                  </DropdownMenuContent>
                </DropdownMenu>
              </TableCell>
            </TableRow>

            <!-- Fila vacía si no hay proveedores -->
            <TableRow v-if="filteredSuppliers.length === 0">
              <TableCell :colspan="columns.length" class="h-24 text-center text-muted-foreground">
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
          @click="$inertia.get(route('supplierslist'), { page: props.suppliers.current_page - 1 })"
        >
          Anterior
        </Button>

        <Button
          class="text-primary"
          variant="outline"
          size="sm"
          :disabled="props.suppliers.current_page === props.suppliers.last_page"
          @click="$inertia.get(route('supplierslist'), { page: props.suppliers.current_page + 1 })"
        >
          Siguiente
        </Button>
      </div>
    </div>
  </DashboardLayout>
</template>
