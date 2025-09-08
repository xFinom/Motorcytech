<script lang="ts" setup>
import { ArrowUpDown, ChevronDown, MoreVertical } from 'lucide-vue-next'
import { defineProps } from 'vue'
import {ref, computed } from 'vue'
const filterText = ref ('')
const filteredMotorcycles = computed(() =>
  props.motorcycles.data.filter((moto) =>
    moto.brand.name.toLowerCase().includes(filterText.value.toLowerCase())
  )
)
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

// Recibir motocicletas desde el backend (paginadas)
const props = defineProps<{
  motorcycles: {
    data: Array<{
      placa: string,
      serial_num: string,
      motor_num: string,
      brand: { name: string },
      type: { type_name: string },
      cliente: { name: string },
    }>,
    current_page: number,
    last_page: number
  }
}>()

// Columnas visuales
const columns = [
  { name: 'Placa', sortable: true },
  { name: 'Número de serie', sortable: false },
  { name: 'Número de motor', sortable: false },
  { name: 'Marca', sortable: false },
  { name: 'Tipo', sortable: false },
  { name: 'Cliente', sortable: false },
  { name: 'Acciones', sortable: false, hideHeader: true },
]
</script>

<template>
  <DashboardLayout>
    <div class="w-full">
      <!-- Barra de filtrado -->
      <div class="flex items-center py-4">
        <Input class="max-w-sm" placeholder="Filtrar por marca..." v-model="filterText" />
        <Button variant="outline" class="ml-auto">
          Columns <ChevronDown class="ml-2 h-4 w-4" />
        </Button>
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
            <TableRow
              v-for="moto in filteredMotorcycles"
              :key="moto.serial_num"
            >
              <TableCell>{{ moto.placa }}</TableCell>
              <TableCell>{{ moto.serial_num }}</TableCell>
              <TableCell>{{ moto.motor_num }}</TableCell>
              <TableCell>{{ moto.brand.name }}</TableCell>
              <TableCell>{{ moto.type.type_name }}</TableCell>
              <TableCell>{{ moto.cliente.name }}</TableCell>
              <TableCell>
                <DropdownMenu>
                  <DropdownMenuTrigger as-child>
                  
                  </DropdownMenuTrigger>
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