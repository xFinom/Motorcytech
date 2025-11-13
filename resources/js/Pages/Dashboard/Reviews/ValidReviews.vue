<script lang="ts" setup>
import { MoreVertical } from 'lucide-vue-next'
import { computed, defineProps, ref } from 'vue'
import { router } from '@inertiajs/vue3'

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
import { Review } from '@/interfaces/Review'
import DeleteReview from './Partials/DeleteReview.vue'
import UserOverview from '@/Components/UserOverview.vue'
import { Badge } from '@/Components/ui/badge'

//Recibimos las reviews paginadas desde Laravel/Inertia
const props = defineProps<{
    reviews: {
        data: Review[]
        current_page: number
        last_page: number
    }
}>()

// Estado del modal y review seleccionada
const isDeleteOpen = ref(false)
const selectedReview = ref<Review | null>(null)

//Filtro en frontend
const filter = ref('')
const filteredReviews = computed(() => {
    if (!filter.value) return props.reviews.data
    return props.reviews.data.filter(
        (r) =>
            r.client.name.toLowerCase().includes(filter.value.toLowerCase()) ||
            r.client.email.toLowerCase().includes(filter.value.toLowerCase()) ||
            r.comment.toLowerCase().includes(filter.value.toLowerCase())
    )
})

//Abrir modal de eliminación
function onClickDelete(review: Review) {
    selectedReview.value = { ...review } // guardamos la review seleccionada
    isDeleteOpen.value = true // abrimos el modal
}

// Validar review
const onClickValidate = (review: Review) => {
    router.put(
        route('reviews.validate', review.id),
        {},
        {
            preserveScroll: true,
            onSuccess: () => console.log('✅ Review validada correctamente'),
            onError: (e) => console.error('Error al validar review:', e),
        }
    )
}

// 🔹 Columnas de la tabla
const columns = [
    { name: 'Cliente', sortable: false },
    { name: 'Comentario', sortable: false },
    { name: 'Fecha', sortable: false },
    { name: 'Estado', sortable: false },
    { name: 'Acciones', sortable: false, hideHeader: true },
]
</script>

<template>
    <DashboardLayout>
        <div class="w-full max-w-7xl mx-auto">
            <!-- Filtro -->
            <div class="flex items-center py-4">
                <Input v-model="filter" class="max-w-sm" placeholder="Buscar" />
            </div>

            <!-- Tabla de reviews -->
            <div class="rounded-md border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead
                                v-for="col in columns"
                                :key="col.name"
                                class="text-left text-primary"
                            >
                                <span v-if="!col.hideHeader">{{ col.name }}</span>
                            </TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        <TableRow
                            v-for="review in filteredReviews"
                            :key="review.id"
                            class="border-b"
                        >
                            <TableCell>
                                <UserOverview :name="review.client.name" :email="review.client.email" />
                            </TableCell>
                            <TableCell class="max-w-xs truncate">{{ review.comment }}</TableCell>
                            <TableCell>{{
                                new Date(review.created_at).toLocaleDateString()
                            }}</TableCell>
                            <TableCell>
                                <Badge
                                    class="bg-neutral-100 text-neutral-800 dark:bg-neutral-800 dark:text-neutral-200"
                                >
                                    {{ review.status }}
                                </Badge>
                            </TableCell>
                            <TableCell>
                                <DropdownMenu>
                                    <DropdownMenuTrigger as-child>
                                        <Button variant="ghost" size="sm" class="h-8 w-8 p-0">
                                            <MoreVertical class="h-4 w-4" />
                                        </Button>
                                    </DropdownMenuTrigger>
                                    <DropdownMenuContent align="end">
                                        <DropdownMenuItem
                                            @click="onClickValidate(review)"
                                            class="text-primary"
                                        >
                                            Validar
                                        </DropdownMenuItem>
                                        <DropdownMenuItem
                                            @click="onClickDelete(review)"
                                            class="text-destructive"
                                        >
                                            Eliminar
                                        </DropdownMenuItem>
                                    </DropdownMenuContent>
                                </DropdownMenu>
                            </TableCell>
                        </TableRow>

                        <TableRow v-if="filteredReviews.length === 0">
                            <TableCell colspan="6" class="h-24 text-center text-muted-foreground">
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
                    :disabled="props.reviews.current_page === 1"
                    @click="
                        $inertia.get(route('validreviews'), { page: props.reviews.current_page - 1 })
                    "
                >
                    Anterior
                </Button>

                <Button
                    variant="outline"
                    size="sm"
                    :disabled="props.reviews.current_page === props.reviews.last_page"
                    @click="
                        $inertia.get(route('validreviews'), { page: props.reviews.current_page + 1 })
                    "
                >
                    Siguiente
                </Button>
            </div>
        </div>

        <!-- Modal de eliminación -->
<DeleteReview v-model:open="isDeleteOpen" v-if="selectedReview" :review="selectedReview" />

    </DashboardLayout>
</template>
