<script setup lang="ts">
import { Bike, Star, Users, Wrench } from 'lucide-vue-next'

import { Avatar, AvatarFallback } from '@/Components/ui/avatar'
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card'
import { BarChart } from '@/Components/ui/chart-bar'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import MetricCard from '@/Pages/Dashboard/Overview/Partials/MetricCard.vue'
import { Client } from '@/interfaces/User'
import { generateInitials } from '@/utils/name'

defineProps<{
    totalServiceOrders: number;
    totalClients: number;
    totalMotorcycles: number;
    totalPendingReviews: number;
    chartData: any;
    recentClients: Array<Client>
}>()
</script>

<template>
    <DashboardLayout>
        <div class="pl-10 pr-10">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <MetricCard
                    title="Órdenes de Servicio"
                    :value="totalServiceOrders"
                    description="Generadas este año"
                    :icon="Wrench"
                />

                <MetricCard
                    title="Clientes"
                    :value="totalClients"
                    description="Atendidos este año"
                    :icon="Users"
                />

                <MetricCard
                    title="Motocicletas"
                    :value="totalMotorcycles"
                    description="Actualmente en el taller"
                    :icon="Bike"
                />

                <MetricCard
                    title="Reseñas"
                    :value="totalPendingReviews"
                    description="Pendientes de validación"
                    :icon="Star"
                />
            </div>
            <div class="mt-6 grid gap-4 md:grid-cols-4">
                <Card class="col-span-3">
                    <CardHeader>
                        <CardTitle class="font-bold text-primary">Servicios</CardTitle>
                        <p class="text-sm text-muted-foreground">Realizados este año.</p>
                    </CardHeader>
                    <CardContent>
                        <BarChart
                            index="name"
                            :data="chartData"
                            :categories="['total']"
                            :rounded-corners="4"
                        />
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader>
                        <CardTitle class="font-bold text-primary">Clientes recientes</CardTitle>
                        <p class="text-sm text-muted-foreground">
                            Los últimos 7 clientes de este mes.
                        </p>
                    </CardHeader>
                    <CardContent class="space-y-6">
                        <div
                            v-for="client in recentClients"
                            :key="client.email"
                            class="flex items-center"
                        >
                            <div class="flex items-center gap-2 px-1 py-1 text-left text-sm">
                                <Avatar class="h-8 w-8 rounded-lg">
                                    <AvatarFallback class="rounded-lg text-primary">
                                        {{ generateInitials(client.name) }}
                                    </AvatarFallback>
                                </Avatar>
                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ client.name }}</span>
                                    <span class="truncate text-xs">{{ client.email }}</span>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </DashboardLayout>
</template>
