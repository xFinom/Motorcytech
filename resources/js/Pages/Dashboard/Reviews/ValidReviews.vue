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

// Recibimos las reviews desde Laravel/Inertia
const props = defineProps<{ reviews: Review[] }>()

// Filtrado
const filter = ref('')
const filteredReviews = computed(() => {
    if (!filter.value) return props.reviews
    return props.reviews.filter(
        (r) =>
            r.client.name.toLowerCase().includes(filter.value.toLowerCase()) ||
            r.client.email.toLowerCase().includes(filter.value.toLowerCase()) ||
            r.comment.toLowerCase().includes(filter.value.toLowerCase())
    )
})

const onClickValidate = (review: Review) => {
    router.put(
        route('reviews.validate', review.id),
        {}, // no necesitas enviar datos adicionales
        {
            preserveScroll: true,
            onSuccess: () => {
                console.log('Review validada correctamente ✅')
            },
            onError: (serverErrors) => {
                console.error('Error al validar review:', serverErrors)
            },
        }
    )
}

const onClickDelete = (review: Review) => {
    if (confirm('¿Deseas eliminar esta review?')) {
        router.delete(route('reviews.destroy', review.id), {
            preserveScroll: true,
            onSuccess: () => {
                console.log('Review eliminada correctamente ✅')
            },
            onError: (serverErrors) => {
                console.error('Error al eliminar review:', serverErrors)
            },
        })
    }
}

// Columnas visuales
const columns = [
    { name: 'Cliente', sortable: false},
    { name: 'Correo', sortable: false },
    { name: 'Comentario', sortable: false },
    { name: 'Fecha', sortable: false },
    { name: 'Estado', sortable: false },
    { name: 'Acciones', sortable: false, hideHeader: true },
]
</script>

<template>
    <DashboardLayout>
        <div class="pl-10 pr-10">
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
                                <div class="flex items-center">
                                    <span v-if="!col.hideHeader">{{ col.name }}</span>
                                    <MoreVertical
                                        v-if="col.sortable"
                                        class="ml-2 h-4 w-4 text-primary"
                                    />
                                </div>
                            </TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        <TableRow
                            v-for="review in filteredReviews"
                            :key="review.id"
                            class="border-b"
                        >
                            <TableCell>{{ review.client.name }}</TableCell>
                            <TableCell>{{ review.client.email }}</TableCell>
                            <TableCell class="max-w-xs truncate">{{ review.comment }}</TableCell>
                            <TableCell>{{
                                new Date(review.created_at).toLocaleDateString()
                            }}</TableCell>
                            <TableCell>{{ review.status }}</TableCell>
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
        </div>
    </DashboardLayout>
</template>
