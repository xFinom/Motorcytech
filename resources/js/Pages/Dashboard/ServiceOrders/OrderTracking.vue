<script setup lang="ts">
import { ref } from 'vue'

import { Icon } from '@iconify/vue'

import { Button } from '@/Components/ui/button'
import {
    Stepper,
    StepperDescription,
    StepperIndicator,
    StepperItem,
    StepperSeparator,
    StepperTitle,
    StepperTrigger,
} from '@/Components/ui/stepper'
import { Textarea } from '@/Components/ui/textarea'
import CommentSection from '@/Pages/Dashboard/ServiceOrders/Partials/CommentSection.vue'
import Navbar from '@/Pages/Landing/Partials/Navbar.vue'
import { UserRole } from '@/constants/enums/UserRole'
import { PrivateMessage } from '@/interfaces/PrivateMessage'

const steps = [
    {
        step: 1,
        title: 'Ingresado',
        description: 'La motocicleta ha sido registrada para el servicio correspodiente',
        icon: 'emojione-monotone:motorcycle',
    },
    {
        step: 2,
        title: 'En proceso',
        description:
            'Se está trabajando sobre los procedimientos descritos en la orden de servicio',
        icon: 'mingcute:loading-line',
    },
    {
        step: 3,
        title: 'Detenido',
        description:
            'En espera de autorización o refacciones para seguir con los procedimientos requeridos',
        icon: 'healthicons:stop',
    },
    {
        step: 4,
        title: 'Listo',
        description: 'Se finalizaron los procedimientos descritos en la orden de servicio',
        icon: 'material-symbols:fact-check',
    },
    {
        step: 5,
        title: 'Finalizado',
        description: 'Se realizó el pago del servicio y la motocicleta salió del taller',
        icon: 'hugeicons:time-schedule',
    },
]

type OrderEvent = {
    date: string
    title: string
    description: string
    status: 'created' | 'in-progress' | 'paused' | 'waiting' | 'completed' | 'delivered'
}
const orderHistory: OrderEvent[] = [
    {
        date: '19 Sep 2025, 09:10',
        title: 'Orden registrada',
        description: 'Se creó la orden de servicio #A4567',
        status: 'created',
    },
    {
        date: '19 Sep 2025, 11:20',
        title: 'En reparación',
        description: 'Técnico inició el diagnóstico del equipo',
        status: 'in-progress',
    },
    {
        date: '20 Sep 2025, 14:00',
        title: 'Trabajo detenido',
        description: 'En espera de autorización del cliente para continuar',
        status: 'paused',
    },
    {
        date: '22 Sep 2025, 10:30',
        title: 'Listo para entrega',
        description: 'El servicio está finalizado',
        status: 'waiting',
    },
    {
        date: '22 Sep 2025, 12:15',
        title: 'Servicio pagado',
        description: 'Se confirmó el pago vía tarjeta',
        status: 'completed',
    },
    {
        date: '22 Sep 2025, 13:00',
        title: 'Entregado',
        description: 'El equipo salió del taller',
        status: 'delivered',
    },
]

const statusIcons: Record<OrderEvent['status'], string> = {
    created: 'mdi:receipt-text',
    'in-progress': 'mdi:tools',
    paused: 'mingcute:loading-line',
    waiting: 'mdi:credit-card-clock',
    completed: 'mdi:check-bold',
    delivered: 'mdi:truck-delivery-outline',
}

const comments = ref<PrivateMessage[]>([
    {
        id: 2,
        message: "That's awesome. I think our users will really appreciate the improvements.",
        created_at: '2025-09-25T11:46:00Z',
        user: {
            id: 2,
            name: 'Juan Perez',
            email: 'juan@example.com',
            phone: '333142312',
            address: 'calle 123',
            role: UserRole.TRABAJADOR,
            privateMessages: [],
        },
    },
    {
        id: 1,
        message: 'Yes, totally agree! This will make the workflow so much smoother.',
        created_at: '2025-09-25T11:50:00Z',
        user: {
            id: 1,
            name: 'Maria Lopez',
            email: 'maria@example.com',
            role: UserRole.CLIENTE,
            rfc: '1312312312',
            phone: '333142312',
            address: 'calle 123',
            privateMessages: [],
        },
    },
    {
        id: 3,
        message: 'Can we also add notifications for better UX?',
        created_at: '2025-09-25T12:00:00Z',
        user: {
            id: 3,
            name: 'Carlos Sanchez',
            email: 'carlos@example.com',
            phone: '333142312',
            address: 'calle 123',
            role: UserRole.TRABAJADOR,
            privateMessages: [],
        },
    },
])
</script>

<template>
    <Navbar />
    <h2
        class="py-6 text-center font-semibold text-gray-900 text-primary dark:bg-gray-900 dark:text-primary sm:text-2xl"
    >
        Seguimiento de orden de servicio #123456
    </h2>

    <Stepper class="bg-white py-6 antialiased dark:bg-gray-900 md:py-10">
        <StepperItem v-for="item in steps" :key="item.step" class="basis-1/10" :step="item.step">
            <StepperTrigger>
                <StepperIndicator>
                    <Icon :icon="item.icon" class="h-12 w-12" />
                </StepperIndicator>
                <div class="flex flex-col">
                    <StepperTitle>
                        {{ item.title }}
                    </StepperTitle>
                    <StepperDescription>
                        {{ item.description }}
                    </StepperDescription>
                </div>
            </StepperTrigger>
            <StepperSeparator
                v-if="item.step !== steps[steps.length - 1].step"
                class="h-px w-full"
            />
        </StepperItem>
    </Stepper>

    <section class="bg-white py-6 antialiased dark:bg-gray-900 md:py-10">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="lg:flex lg:gap-8">
                <div class="w-full space-y-6 lg:max-w-xl xl:max-w-2xl">
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                    >
                        <h2
                            class="mb-4 text-xl font-semibold text-gray-900 text-primary dark:text-primary"
                        >
                            Datos del cliente
                        </h2>
                        <dl class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                            <div class="flex justify-between">
                                <dt class="font-medium">Nombre:</dt>
                                <dd>Juan Pérez</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Dirección:</dt>
                                <dd>Calle 123, Col. Centro, GDL</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Teléfono:</dt>
                                <dd>+52 3313141516</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Correo:</dt>
                                <dd>juan.perez@email.com</dd>
                            </div>
                        </dl>
                    </div>

                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                    >
                        <h2
                            class="mb-4 text-xl font-semibold text-gray-900 text-primary dark:text-primary"
                        >
                            Datos de la motocicleta
                        </h2>
                        <dl class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                            <div class="flex justify-between">
                                <dt class="font-medium">Placa:</dt>
                                <dd>XYZ-123</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Marca:</dt>
                                <dd>Yamaha</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Tipo:</dt>
                                <dd>Deportiva</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Año:</dt>
                                <dd>2022</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Número de serie:</dt>
                                <dd>ASDF123456XYZ</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Número de motor:</dt>
                                <dd>ENG-987654321</dd>
                            </div>
                        </dl>
                    </div>
                    <CommentSection :comments="comments" />
                </div>
                <div class="mt-6 grow sm:mt-8 lg:mt-0">
                    <div
                        class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                    >
                        <h3
                            class="text-xl font-semibold text-gray-900 text-primary dark:text-primary"
                        >
                            Historial de la orden de servicio
                        </h3>

                        <ol class="relative ms-3 border-s border-gray-200 dark:border-gray-700">
                            <li
                                v-for="(event, i) in orderHistory"
                                :key="i"
                                class="mb-10 ms-6 last:mb-0"
                                :class="{
                                    'text-primary-700 dark:text-primary-500': [
                                        'completed',
                                        'delivered',
                                    ].includes(event.status),
                                }"
                            >
                                <span
                                    class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full ring-8 ring-white dark:ring-gray-800"
                                    :class="{
                                        'bg-gray-100 dark:bg-gray-700': [
                                            'created',
                                            'in-progress',
                                            'paused',
                                            'waiting',
                                        ].includes(event.status),
                                        'bg-primary-100 dark:bg-primary-900': [
                                            'completed',
                                            'delivered',
                                        ].includes(event.status),
                                    }"
                                >
                                    <Icon
                                        :icon="statusIcons[event.status]"
                                        class="h-4 w-4"
                                        :class="{
                                            'text-gray-500 dark:text-gray-400': [
                                                'created',
                                                'in-progress',
                                                'paused',
                                                'waiting',
                                            ].includes(event.status),
                                        }"
                                    />
                                </span>

                                <h4 class="mb-0.5 font-semibold">{{ event.date }}</h4>
                                <p class="text-sm font-medium">{{ event.title }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ event.description }}
                                </p>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
