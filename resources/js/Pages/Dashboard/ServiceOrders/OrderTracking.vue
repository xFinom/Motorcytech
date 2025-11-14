<script setup lang="ts">
import { ref, watch } from 'vue'

import { Icon } from '@iconify/vue'

import {
    Stepper,
    StepperDescription,
    StepperIndicator,
    StepperItem,
    StepperSeparator,
    StepperTitle,
    StepperTrigger,
} from '@/Components/ui/stepper'
import MainLayout from '@/Layouts/MainLayout.vue'
import CommentSection from '@/Pages/Dashboard/ServiceOrders/Partials/CommentSection.vue'
import { ApprovalStatus } from '@/enums/ApprovalStatus'
import { getEventStatusIcon } from '@/enums/Event'
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
</script>

<template>
    <MainLayout>
        <h2
            class="py-6 text-center font-semibold text-gray-900 text-primary dark:bg-gray-900 dark:text-primary sm:text-2xl"
        >
            Seguimiento de orden de servicio #{{ serviceOrder.id }}
        </h2>

        <Stepper
            v-model="currentStep"
            class="flex w-full items-center justify-center bg-white py-6 antialiased dark:bg-gray-900 md:py-10"
        >
            <StepperItem
                v-for="item in steps"
                :key="item.step"
                :step="item.step"
                :active="item.step <= currentStep"
                class="basis-1/10"
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
                                <div v-if="serviceOrder.client.rfc" class="flex justify-between">
                                    <dt class="font-medium">RFC:</dt>
                                    <dd>{{ serviceOrder.client.rfc }}</dd>
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
                                    <dt class="font-medium">Fecha de ingreso:</dt>
                                    <dd>{{ formatDate(serviceOrder.entry_date) }}</dd>
                                </div>
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
                                <dt class="font-medium">Nota:</dt>
                                {{ serviceOrder.note }}
                            </dl>
                        </div>
                        <CommentSection
                            :private-messages="serviceOrder.private_messages ?? []"
                            :service-order-id="serviceOrder.id"
                        />
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
                                    v-for="(event, i) in serviceOrder.events"
                                    :key="i"
                                    class="mb-10 ms-6 last:mb-0"
                                    :class="{
                                        'text-primary-700 dark:text-primary-500': [
                                            'completed',
                                            'delivered',
                                        ].includes(event.approval_status),
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
                                            ].includes(event.approval_status),
                                            'bg-primary-100 dark:bg-primary-900': [
                                                'completed',
                                                'delivered',
                                            ].includes(event.approval_status),
                                        }"
                                    >
                                        <Icon
                                            :icon="getEventStatusIcon(event.type)"
                                            class="h-4 w-4"
                                            :class="{
                                                'text-gray-500 dark:text-gray-400': [
                                                    'created',
                                                    'in-progress',
                                                    'paused',
                                                    'waiting',
                                                ].includes(event.approval_status),
                                            }"
                                        />
                                    </span>

                                    <h4 class="mb-0.5 font-semibold">
                                        {{ formatDate(event.created_at) }}
                                    </h4>
                                    <p class="text-sm font-medium">{{ event.title }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ event.description }}
                                    </p>


                                    <div
                                        v-if="
                                            ['BillGenerated', 'SparePartQuote'].includes(
                                                event.type
                                            ) && event.approval_status !== ApprovalStatus.APPROVED
                                        "
                                        class="mt-3"
                                    >
                                        <a
                                            :href="
                                                route('service.orders.pay', { event_id: event.id })
                                            "
                                            class="inline-block"
                                        >
                                            <button
                                                class="rounded bg-primary px-4 py-2 text-white shadow"
                                            >
                                                Pagar
                                            </button>
                                        </a>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
