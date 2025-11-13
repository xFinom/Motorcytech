<script lang="ts" setup>
import { ArrowUpDown, Bike, MoreVertical, Star, Users, Wrench } from 'lucide-vue-next'

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
import DeleteUser from '@/Pages/Dashboard/Users/Partials/DeleteUser.vue'
import UpdateUser from '@/Pages/Dashboard/Users/Partials/UpdateUser.vue'
import UserOverview from '@/Components/UserOverview.vue'
import MetricCard from '@/Pages/Dashboard/Overview/Partials/MetricCard.vue'

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
    isDeleteOpen.value = true // abrimos el modal
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
    { name: 'Nombre', sortable: false },
    { name: 'RFC', sortable: false },
    { name: 'Dirección', sortable: false },
    { name: 'Teléfono', sortable: false },
    { name: 'Acciones', sortable: false, hideHeader: true },
]
</script>

<template>
    <DashboardLayout>
        <div class="w-full max-w-7xl mx-auto">
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

            <!-- Barra de filtrado y selector de columnas -->
            <div class="flex items-center py-4">
                <Input v-model="filter" class="max-w-sm" placeholder="Buscar" />
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
                            <TableCell>
                                <UserOverview :name="user.name" :email="user.email" />
                            </TableCell>
                            <TableCell>{{ user.rfc }}</TableCell>
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
