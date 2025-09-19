<script setup lang="ts">
import { toTypedSchema } from '@vee-validate/zod'
import { Check, Circle, Dot } from 'lucide-vue-next'
import type { ZodObject } from 'zod'

import { ref } from 'vue'
import { defineProps } from 'vue'

import { router } from '@inertiajs/vue3'

import { Button } from '@/Components/ui/button'
import { Form } from '@/Components/ui/form'
import {
    Stepper,
    StepperDescription,
    StepperItem,
    StepperSeparator,
    StepperTitle,
    StepperTrigger,
} from '@/Components/ui/stepper'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import FormClient from '@/Pages/Dashboard/ServiceOrders/Partials/FormClient.vue'
import FormMotorcycle from '@/Pages/Dashboard/ServiceOrders/Partials/FormMotorcycle.vue'
import FormService from '@/Pages/Dashboard/ServiceOrders/Partials/FormService.vue'
import { clientSchema } from '@/constants/validation/client'
import { motorcycleSchema } from '@/constants/validation/motorcycle'
import { serviceSchema } from '@/constants/validation/service'
import { serviceOrderSchema } from '@/constants/validation/serviceOrder'
import { ServiceOrderStep } from '@/enums/ServiceOrderStep'
import { StepperState } from '@/enums/StepperState'

interface Props {
    motorcycleTypes: string[]
    brands: string[]
}

defineProps<Props>()

const initialStep = ref(ServiceOrderStep.FillingClientData)
const steps = [
    {
        step: ServiceOrderStep.FillingClientData,
        title: 'Cliente',
        description: 'Datos de contacto y facturación',
    },
    {
        step: ServiceOrderStep.FillingMotorcycleData,
        title: 'Motocicleta',
        description: 'Datos de la motocicleta',
    },
    {
        step: ServiceOrderStep.FillingServiceData,
        title: 'Servicio',
        description: 'Servicio a realizar',
    },
]

function formatValues(values: any) {
    return {
        client: {
            name: values.name,
            email: values.email,
            phone: values.phone,
            address: values.address,
            rfc: values.rfc,
        },
        motorcycle: {
            serial_num: values.serial_num,
            motor_num: values.motor_num,
            placa: values.placa,
            brand_id: values.brand_id,
            type_id: values.type_id,
            year: values.year,
        },
        service: {
            service_id: values.service_id,
            note: values.note,
        },
    }
}

function onSubmit(values: any) {
    const formattedValues = formatValues(values)

    const validation = serviceOrderSchema.safeParse(formattedValues)

    if (validation.success) {
        router.post(route('service.order.store'), formattedValues)
    }
}

const formSchema: ZodObject<any>[] = [clientSchema, motorcycleSchema, serviceSchema]
</script>

<template>
    <DashboardLayout>
        <Form
            v-slot="{ meta, values, validate }"
            as=""
            keep-values
            :validation-schema="toTypedSchema(formSchema[initialStep - 1])"
        >
            <Stepper
                v-slot="{ isNextDisabled, isPrevDisabled, nextStep, prevStep }"
                v-model="initialStep"
                class="mx-auto block w-full max-w-3xl rounded-xl"
            >
                <form
                    @submit="
                        (e) => {
                            e.preventDefault()
                            validate()

                            if (initialStep === steps.length && meta.valid) {
                                onSubmit(values)
                            }
                        }
                    "
                >
                    <div class="flex-start flex w-full gap-2">
                        <StepperItem
                            v-for="step in steps"
                            :key="step.step"
                            v-slot="{ state }"
                            class="relative flex w-full flex-col items-center justify-center"
                            :step="step.step"
                        >
                            <StepperSeparator
                                v-if="step.step !== steps[steps.length - 1].step"
                                class="absolute left-[calc(50%+20px)] right-[calc(-50%+10px)] top-5 block h-0.5 shrink-0 rounded-full bg-muted group-data-[state=completed]:bg-primary"
                            />

                            <StepperTrigger as-child>
                                <Button
                                    :variant="
                                        state === StepperState.Completed ||
                                        state === StepperState.Active
                                            ? 'default'
                                            : 'outline'
                                    "
                                    size="icon"
                                    class="z-10 shrink-0 rounded-full"
                                    :class="[
                                        state === StepperState.Active &&
                                            'ring-2 ring-primary ring-offset-2 ring-offset-background',
                                    ]"
                                    :disabled="state !== StepperState.Completed && !meta.valid"
                                >
                                    <Check v-if="state === StepperState.Completed" class="size-5" />
                                    <Circle v-if="state === StepperState.Active" />
                                    <Dot v-if="state === StepperState.Inactive" />
                                </Button>
                            </StepperTrigger>

                            <div class="mt-5 flex flex-col items-center text-center">
                                <StepperTitle
                                    :class="[state === StepperState.Active && 'text-primary']"
                                    class="text-sm font-semibold transition lg:text-base"
                                >
                                    {{ step.title }}
                                </StepperTitle>
                                <StepperDescription
                                    :class="[state === StepperState.Active && 'text-primary']"
                                    class="sr-only text-xs text-muted-foreground transition md:not-sr-only lg:text-sm"
                                >
                                    {{ step.description }}
                                </StepperDescription>
                            </div>
                        </StepperItem>
                    </div>

                    <div class="mt-4 flex flex-col gap-4">
                        <template v-if="initialStep === ServiceOrderStep.FillingClientData">
                            <FormClient />
                        </template>

                        <template v-if="initialStep === ServiceOrderStep.FillingMotorcycleData">
                            <FormMotorcycle :types="motorcycleTypes" :brands="brands" />
                        </template>

                        <template v-if="initialStep === ServiceOrderStep.FillingServiceData">
                            <FormService />
                        </template>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <Button
                            :disabled="isPrevDisabled"
                            variant="outline"
                            size="sm"
                            @click="prevStep()"
                        >
                            Back
                        </Button>
                        <div class="flex items-center gap-3">
                            <Button
                                v-if="initialStep !== ServiceOrderStep.FillingServiceData"
                                :type="meta.valid ? 'button' : 'submit'"
                                :disabled="isNextDisabled"
                                size="sm"
                                @click="meta.valid && nextStep()"
                            >
                                Siguiente
                            </Button>
                            <Button
                                v-if="initialStep === ServiceOrderStep.FillingServiceData"
                                size="sm"
                                type="submit"
                            >
                                Enviar
                            </Button>
                        </div>
                    </div>
                </form>
            </Stepper>
        </Form>
    </DashboardLayout>
</template>
