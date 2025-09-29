<script setup lang="ts">
import { ref, watch } from 'vue'

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
import Navbar from '@/Pages/Landing/Partials/Navbar.vue'
import { ServiceOrderStatus } from '@/enums/ServiceOrderStatus'
import { ServiceOrder } from '@/interfaces/ServiceOrder'
import { formatDate } from '@/utils/date'

// Props
const props = defineProps<{ serviceOrder: ServiceOrder }>()

// 🔹 Mapeo entre el enum y los pasos
const statusStepMap: Record<ServiceOrderStatus, number> = {
    [ServiceOrderStatus.INGRESADO]: 1,
    [ServiceOrderStatus.EN_PROCESO]: 2,
    [ServiceOrderStatus.DETENIDO]: 3,
    [ServiceOrderStatus.LISTO]: 4,
    [ServiceOrderStatus.FINALIZADO]: 5,
}

// 🔹 Inicializa el step actual según el estado recibido
const currentStep = ref<number>(statusStepMap[props.serviceOrder.status])

// 🔹 Actualiza si cambia la orden (p. ej., navegación o recarga)
watch(
    () => props.serviceOrder.status,
    (newStatus) => {
        if (newStatus) currentStep.value = statusStepMap[newStatus]
    },
    { immediate: true }
)

// 🔹 Definición de los pasos
const steps = [
    {
        step: 1,
        title: 'Ingresado',
        description: 'La motocicleta ha sido registrada.',
        icon: 'emojione-monotone:motorcycle',
    },
    {
        step: 2,
        title: 'En proceso',
        description: 'Se está trabajando en el servicio.',
        icon: 'mingcute:loading-line',
    },
    {
        step: 3,
        title: 'Detenido',
        description: 'En espera de autorización o refacciones.',
        icon: 'healthicons:stop',
    },
    {
        step: 4,
        title: 'Listo',
        description: 'Se finalizaron los procedimientos.',
        icon: 'material-symbols:fact-check',
    },
    {
        step: 5,
        title: 'Finalizado',
        description: 'El pago fue realizado y la moto salió del taller.',
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
        description: 'Técnico inició el diagnóstico.',
        status: 'in-progress',
    },
    {
        date: '20 Sep 2025, 14:00',
        title: 'Trabajo detenido',
        description: 'En espera de autorización del cliente.',
        status: 'paused',
    },
    {
        date: '22 Sep 2025, 10:30',
        title: 'Listo para entrega',
        description: 'El servicio está finalizado.',
        status: 'waiting',
    },
    {
        date: '22 Sep 2025, 12:15',
        title: 'Servicio pagado',
        description: 'Pago confirmado vía tarjeta.',
        status: 'completed',
    },
    {
        date: '22 Sep 2025, 13:00',
        title: 'Entregado',
        description: 'El equipo salió del taller.',
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
</script>

<template>
    <Navbar />
    <h2
        class="py-6 text-center font-semibold text-gray-900 text-primary dark:bg-gray-900 dark:text-primary sm:text-2xl"
    >
        Seguimiento de orden de servicio #{{ serviceOrder.id }}
    </h2>

    <Stepper 
    v-model="currentStep"
    class="bg-white py-6 antialiased dark:bg-gray-900 md:py-10 w-full flex justify-center items-center" >
        <StepperItem
            v-for="item in steps"
            :key="item.step"
            :step="item.step"
            :active="item.step <= currentStep"
            class="basis-1/10 "
        >
            <StepperTrigger class="pointer-events-none select-none">
                <StepperIndicator
                    :class="[
                        item.step <= currentStep
                            ? 'scale-110 border-2 border-primary bg-primary text-white shadow-lg'
                            : 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-gray-400',
                        'flex h-14 w-14 items-center justify-center rounded-full transition-all duration-300',
                    ]"
                >
                    <Icon
                        :icon="item.icon"
                        :class="[
                            'h-10 w-10 transition-colors duration-300',
                            item.step <= currentStep
                                ? 'text-gray'
                                : 'text-gray-400 dark:text-gray-200',
                        ]"
                    />
                </StepperIndicator>

                <div class="flex flex-col text-center md:text-left">
                    <StepperTitle class="font-semibold text-primary dark:text-gray-200 text-center">
                        {{ item.title }}
                    </StepperTitle>
                    <StepperDescription class="text-black dark:text-gray-400 text-center ">
                        {{ item.description }}
                    </StepperDescription>
                </div>
            </StepperTrigger>

            <StepperSeparator
                v-if="item.step !== steps[steps.length - 1].step"
                class="h-1 w-full rounded-full transition-all duration-300"
                :class="item.step < currentStep ? 'bg-primary' : 'bg-gray-300 dark:bg-gray-700'"
            />
        </StepperItem>
    </Stepper>

   

    <!-- Resto de la vista: datos del cliente, motocicleta y conversación -->
    <section class="bg-white py-6 antialiased dark:bg-gray-900 md:py-10">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="lg:flex lg:gap-8">
                <div class="w-full space-y-6 lg:max-w-xl xl:max-w-2xl">
                    <!-- Datos del cliente -->
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
                                <dd>{{ serviceOrder.client.name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Dirección:</dt>
                                <dd>{{ serviceOrder.client.address }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Teléfono:</dt>
                                <dd>{{ serviceOrder.client.phone }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Correo:</dt>
                                <dd>{{ serviceOrder.client.email }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Datos de la motocicleta -->
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
                                <dd>{{ serviceOrder.motorcycle.placa }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Marca:</dt>
                                <dd>{{ serviceOrder.motorcycle.type.brand.name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Tipo:</dt>
                                <dd>{{ serviceOrder.motorcycle.type.name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Año:</dt>
                                <dd>{{ serviceOrder.motorcycle.year }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Número de serie:</dt>
                                <dd>{{ serviceOrder.motorcycle.serial_num }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium">Número de motor:</dt>
                                <dd>{{ serviceOrder.motorcycle.motor_num }}</dd>
                            </div>
                        </dl>
                        <p><strong>Nota:</strong> {{ serviceOrder.note }}</p>
                        <p>
                            <strong>Fecha de ingreso:</strong>
                            {{ formatDate(serviceOrder.entry_date) }}
                        </p>
                    </div>

                    <!-- Conversación -->
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                    >
                        <h2 class="mb-4 text-xl font-semibold text-primary dark:text-primary">
                            Conversación
                        </h2>
                        <div class="relative flex items-start gap-2.5">
                            <img
                                class="h-8 w-8 rounded-full"
                                src="https://cdn-icons-png.flaticon.com/512/10337/10337609.png"
                                alt="Jese image"
                            />
                            <div
                                class="leading-1.5 flex w-full max-w-[320px] flex-col rounded-e-xl rounded-es-xl bg-gray-100 p-4 dark:bg-gray-700"
                            >
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="text-sm font-semibold text-gray-900 dark:text-white"
                                        >{{ serviceOrder.client.name }}</span
                                    >
                                    <span
                                        class="text-sm font-normal text-gray-500 dark:text-gray-400"
                                        >11:46</span
                                    >
                                </div>
                                <p class="py-2.5 text-sm font-normal text-gray-900 dark:text-white">
                                    That's awesome. I think our users will really appreciate the
                                    improvements.
                                </p>
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400"
                                    >Received</span
                                >
                            </div>
                        </div>
                        <div class="gap-2, mt-5 grid w-full">
                            <Textarea
                                class="rounded-e-xl rounded-es-xl bg-gray-100 p-4 dark:bg-gray-700"
                                placeholder="Escribe tu mensaje aquí."
                            />
                            <Button class="mt-5">Enviar</Button>
                        </div>
                    </div>
                </div>

                <!-- Historial -->
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
