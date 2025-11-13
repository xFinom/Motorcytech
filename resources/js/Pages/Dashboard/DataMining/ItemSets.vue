<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import data from '@/data/itemset.json'

const brands = [...new Set(data.map((d) => d.brand))]

const filteredData = (brand: string) => {
    return data
        .filter((d) => d.brand === brand)
        .map((d) => ({ ...d, itemsLabel: d.items.join(' & ') }))
}
</script>

<template>
    <DashboardLayout>
        <Head title="ItemSets" />
        <div class="w-full max-w-7xl mx-auto">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <Card
                    v-for="brand in brands"
                    :key="brand"
                    class="border border-border transition-all duration-300 hover:shadow-lg"
                >
                    <CardHeader>
                        <CardTitle class="flex items-center justify-between text-primary">
                            {{ brand }}
                        </CardTitle>
                    </CardHeader>

                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Items</TableHead>
                                    <TableHead>Soporte</TableHead>
                                </TableRow>
                            </TableHeader>

                            <TableBody>
                                <TableRow
                                    v-for="(set, i) in filteredData(brand)"
                                    :key="i"
                                    class="transition hover:bg-muted/40"
                                >
                                    <TableCell class="capitalize font-medium">{{
                                        set.items.join(', ')
                                    }}</TableCell>
                                    <TableCell>{{ (set.support * 100).toFixed(2) }}%</TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </div>
    </DashboardLayout>
</template>
