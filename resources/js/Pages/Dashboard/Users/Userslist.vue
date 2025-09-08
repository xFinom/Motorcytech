<script lang="ts" setup>
import { ArrowUpDown, ChevronDown, MoreVertical } from 'lucide-vue-next'

import { defineProps } from 'vue'

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

// Recibir usuarios desde el backend (paginados)
const props = defineProps<{
    users: {
        data: Array<{
            name: string
            email: string
            rfc: string
            role: string
            address: string
            phone: string
        }>
        current_page: number
        last_page: number
    }
}>()

// Columnas visuales
const columns = [
    { name: 'Nombre', sortable: true },
    { name: 'Correo electrónico', sortable: false },
    { name: 'RFC', sortable: false },
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
            <!-- Barra visual de filtrado y selector de columnas -->
            <div class="flex items-center py-4">
                <Input class="max-w-sm" placeholder="Filter emails..." readonly />
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
                                class="text-left, text-primary"
                            >
                                <div class="flex items-center">
                                    <span v-if="!col.hideHeader">{{ col.name }}</span>
                                    <ArrowUpDown v-if="col.sortable" class="ml-2 h-4 w-4" />
                                </div>
                            </TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        <!-- Mostrar usuarios -->
                        <TableRow v-for="user in props.users.data" :key="user.email">
                            <TableCell>{{ user.name }}</TableCell>
                            <TableCell>{{ user.email }}</TableCell>
                            <TableCell>{{ user.rfc }}</TableCell>
                            <TableCell>{{ user.role }}</TableCell>
                            <TableCell>{{ user.address }}</TableCell>
                            <TableCell>{{ user.phone }}</TableCell>
                            <TableCell>
                                <DropdownMenu>
                                    <DropdownMenuTrigger as-child>
                                        <Button variant="ghost" size="sm" class="h-8 w-8 p-0">
                                            <MoreVertical class="h-4 w-4" />
                                        </Button>
                                    </DropdownMenuTrigger>
                                    <DropdownMenuContent align="end">
                                        <DropdownMenuItem>Editar</DropdownMenuItem>
                                        <DropdownMenuItem>Eliminar</DropdownMenuItem>
                                    </DropdownMenuContent>
                                </DropdownMenu>
                            </TableCell>
                        </TableRow>

                        <!-- Fila vacía si no hay usuarios -->
                        <TableRow v-if="props.users.data.length === 0">
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
                    :disabled="props.users.current_page === 1"
                    @click="
                        $inertia.get(route('userslist'), { page: props.users.current_page - 1 })
                    "
                >
                    Anterior
                </Button>

                <Button
                    class="text-primary"
                    variant="outline"
                    size="sm"
                    :disabled="props.users.current_page === props.users.last_page"
                    @click="
                        $inertia.get(route('userslist'), { page: props.users.current_page + 1 })
                    "
                >
                    Siguiente
                </Button>
            </div>
        </div>
        </div>
    </DashboardLayout>
</template>
