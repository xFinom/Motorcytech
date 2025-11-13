<script setup lang="ts">
import { Bike, Star, Users, Wrench } from 'lucide-vue-next'

import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card'
import { AreaChart } from '@/Components/ui/chart-area'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import MetricCard from '@/Pages/Dashboard/Overview/Partials/MetricCard.vue'
import { ref } from "vue";
import {
    Tabs,
    TabsList,
    TabsTrigger,
    TabsContent,
} from "@/Components/ui/tabs";

const servicesData = [
    {
        service: 'Carburación y Fuel Injection',
        data: [
            { month: 'Enero 2025', forecast: 12, actual: 10 },
            { month: 'Febrero 2025', forecast: 12, actual: 18 },
            { month: 'Marzo 2025', forecast: 13, actual: 10 },
            { month: 'Abril 2025', forecast: 13, actual: null },
            { month: 'Mayo 2025', forecast: 14, actual: null },
            { month: 'Junio 2025', forecast: 14, actual: null },
            { month: 'Julio 2025', forecast: 15, actual: null },
            { month: 'Agosto 2025', forecast: 15, actual: null },
            { month: 'Septiembre 2025', forecast: 16, actual: null },
            { month: 'Octubre 2025', forecast: 16, actual: null },
            { month: 'Noviembre 2025', forecast: 17, actual: null },
            { month: 'Diciembre 2025', forecast: 17, actual: null },
        ],
    },
    {
        service: 'Enderezado de Pipas',
        data: [
            { month: 'Enero 2025', forecast: 4, actual: 1 },
            { month: 'Febrero 2025', forecast: 4, actual: 3 },
            { month: 'Marzo 2025', forecast: 4, actual: 4 },
            { month: 'Abril 2025', forecast: 4, actual: null },
            { month: 'Mayo 2025', forecast: 4, actual: null },
            { month: 'Junio 2025', forecast: 4, actual: null },
            { month: 'Julio 2025', forecast: 4, actual: null },
            { month: 'Agosto 2025', forecast: 5, actual: null },
            { month: 'Septiembre 2025', forecast: 5, actual: null },
            { month: 'Octubre 2025', forecast: 5, actual: null },
            { month: 'Noviembre 2025', forecast: 5, actual: null },
            { month: 'Diciembre 2025', forecast: 5, actual: null },
        ],
    },
    {
        service: 'Escaneo',
        data: [
            { month: 'Enero 2025', forecast: 9, actual: 7 },
            { month: 'Febrero 2025', forecast: 10, actual: 10 },
            { month: 'Marzo 2025', forecast: 10, actual: 4 },
            { month: 'Abril 2025', forecast: 11, actual: null },
            { month: 'Mayo 2025', forecast: 11, actual: null },
            { month: 'Junio 2025', forecast: 11, actual: null },
            { month: 'Julio 2025', forecast: 12, actual: null },
            { month: 'Agosto 2025', forecast: 12, actual: null },
            { month: 'Septiembre 2025', forecast: 13, actual: null },
            { month: 'Octubre 2025', forecast: 13, actual: null },
            { month: 'Noviembre 2025', forecast: 13, actual: null },
            { month: 'Diciembre 2025', forecast: 14, actual: null },
        ],
    },
    {
        service: 'Mantenimiento Preventivo',
        data: [
            { month: 'Enero 2025', forecast: 10, actual: 10 },
            { month: 'Febrero 2025', forecast: 10, actual: 16 },
            { month: 'Marzo 2025', forecast: 10, actual: 21 },
            { month: 'Abril 2025', forecast: 10, actual: null },
            { month: 'Mayo 2025', forecast: 10, actual: null },
            { month: 'Junio 2025', forecast: 10, actual: null },
            { month: 'Julio 2025', forecast: 10, actual: null },
            { month: 'Agosto 2025', forecast: 10, actual: null },
            { month: 'Septiembre 2025', forecast: 11, actual: null },
            { month: 'Octubre 2025', forecast: 11, actual: null },
            { month: 'Noviembre 2025', forecast: 11, actual: null },
            { month: 'Diciembre 2025', forecast: 11, actual: null },
        ],
    },
    {
        service: 'Reparación',
        data: [
            { month: 'Enero 2025', forecast: 17, actual: 3 },
            { month: 'Febrero 2025', forecast: 18, actual: 11 },
            { month: 'Marzo 2025', forecast: 18, actual: 23 },
            { month: 'Abril 2025', forecast: 18, actual: null },
            { month: 'Mayo 2025', forecast: 19, actual: null },
            { month: 'Junio 2025', forecast: 19, actual: null },
            { month: 'Julio 2025', forecast: 20, actual: null },
            { month: 'Agosto 2025', forecast: 20, actual: null },
            { month: 'Septiembre 2025', forecast: 21, actual: null },
            { month: 'Octubre 2025', forecast: 21, actual: null },
            { month: 'Noviembre 2025', forecast: 21, actual: null },
            { month: 'Diciembre 2025', forecast: 22, actual: null },
        ],
    },
    {
        service: 'Revisión General',
        data: [
            { month: 'Enero 2025', forecast: 12, actual: 7 },
            { month: 'Febrero 2025', forecast: 12, actual: 5 },
            { month: 'Marzo 2025', forecast: 12, actual: 10 },
            { month: 'Abril 2025', forecast: 13, actual: null },
            { month: 'Mayo 2025', forecast: 13, actual: null },
            { month: 'Junio 2025', forecast: 14, actual: null },
            { month: 'Julio 2025', forecast: 14, actual: null },
            { month: 'Agosto 2025', forecast: 14, actual: null },
            { month: 'Septiembre 2025', forecast: 15, actual: null },
            { month: 'Octubre 2025', forecast: 15, actual: null },
            { month: 'Noviembre 2025', forecast: 15, actual: null },
            { month: 'Diciembre 2025', forecast: 16, actual: null },
        ],
    },
]
const selectedService = ref(servicesData[0].service);


defineProps<{}>()
</script>

<template>
    <DashboardLayout>
        <div class="w-full max-w-7xl mx-auto">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-10">
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

            <div>
                <Tabs v-model="selectedService" >
                    <TabsList class="flex justify-center gap-2 border-b border-border pb-2 pt-2 overflow-x-auto">
                        <TabsTrigger
                            v-for="service in servicesData"
                            :key="service.service"
                            :value="service.service"
                            class="capitalize"
                        >
                            {{ service.service }}
                        </TabsTrigger>
                    </TabsList>

                    <TabsContent
                        v-for="service in servicesData"
                        :key="service.service"
                        :value="service.service"
                        class="mt-6"
                    >
                        <Card>
                            <CardHeader>
                                <CardTitle class="font-bold text-primary">{{ service.service }}</CardTitle>
                                <p class="text-sm text-muted-foreground">Proyecciones 2025</p>
                            </CardHeader>
                            <CardContent>
                                <AreaChart
                                    :data="service.data"
                                    index="month"
                                    :categories="['forecast', 'actual']"
                                    :auto-init-update="true"
                                    :colors="['#0D9488', '#F59E0B']"
                                    :show-grid-line="true"
                                    class="h-[400px] w-full"
                                />
                            </CardContent>
                        </Card>
                    </TabsContent>
                </Tabs>
            </div>
        </div>
    </DashboardLayout>
</template>
