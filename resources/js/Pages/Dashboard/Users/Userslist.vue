<script lang="ts" setup>
import { ArrowUpDown, MoreVertical } from 'lucide-vue-next'

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
import UpdateUser from '@/Pages/Dashboard/Users/Partials/UpdateUser.vue'
import DeleteUser from '@/Pages/Dashboard/Users/Partials/DeleteUser.vue'

// Recibir usuarios desde el backend (paginados)
const props = defineProps<{
    users: {
        data: Array<{
            id: number
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

type UserRow = {
    id: number
    name: string
    email: string
    rfc: string
    role: string
    address: string
    phone: string
}

// Estado para guardar el usuario seleccionado
const selectedUser = ref<UserRow | null>(null)

// (Opcional para el siguiente paso) bandera para abrir/cerrar modal/hoja de edición
const isEditOpen = ref(false)
const isDeleteOpen = ref(false)

function onClickDelete(user: UserRow) {
    selectedUser.value = { ...user } // guardamos la fila
    isDeleteOpen.value = true             // abrimos el modal
}

function onClickEdit(user: UserRow) {
    // Clonamos para no mutar directamente la fila de la tabla
    selectedUser.value = { ...user }
    // (Opcional) abrir modal/hoja de edición en el siguiente paso
    isEditOpen.value = true
}
// Estado del filtro
const filter = ref('')

// Computed: usuarios filtrados por frontend
const filteredUsers = computed(() => {
    if (!filter.value) return props.users.data
    return props.users.data.filter(
        (user) =>
            user.name.toLowerCase().includes(filter.value.toLowerCase()) ||
            user.email.toLowerCase().includes(filter.value.toLowerCase()) ||
            user.rfc.toLowerCase().includes(filter.value.toLowerCase())
    )
})

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
            <!-- Barra de filtrado y selector de columnas -->
            <div class="flex items-center py-4">
                <Input v-model="filter" class="max-w-sm" placeholder="Filtrar usuarios..." />
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
                        <!-- Mostrar usuarios filtrados -->
                        <TableRow v-for="user in filteredUsers" :key="user.email">
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
                                        <DropdownMenuItem @click="onClickEdit(user)"
                                            >Editar</DropdownMenuItem
                                        >
                                        <DropdownMenuItem @click="onClickDelete(user)"
                                        >Eliminar</DropdownMenuItem
                                        >
                                    </DropdownMenuContent>
                                </DropdownMenu>
                            </TableCell>
                        </TableRow>

                        <!-- Fila vacía si no hay coincidencias -->
                        <TableRow v-if="filteredUsers.length === 0">
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
            <div class="mt-4 flex justify-end space-x-2 text-primary">
                <Button
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
        <DeleteUser v-model:open="isDeleteOpen" v-if="selectedUser" :user="selectedUser" />
        <UpdateUser v-model:open="isEditOpen" v-if="selectedUser" :user="selectedUser" />
    </DashboardLayout>
</template>
