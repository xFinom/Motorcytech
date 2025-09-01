<script setup lang="ts">
import { Icon } from '@iconify/vue'
</script>

<template>
    <section class="bg-white dark:bg-[#061222]">
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:py-16 lg:px-6">
            <div class="mb-8 max-w-screen-md lg:mb-16">
                <h2
                    class="mb-4 text-4xl font-extrabold tracking-tight text-[#fb5607] dark:text-white"
                >
                    ¿Por que escogernos?
                </h2>
                <p class="text-[#061222] dark:text-gray-400 sm:text-xl">
                    Combinamos experiencia mecánica, innovación y pasión por las motos para ofrecer
                    un servicio de alto nivel.
                </p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0 lg:grid-cols-3">
                <div>
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#fb5607] dark:bg-[#fb5607] lg:h-12 lg:w-12"
                    >
                        <Icon
                            icon="line-md:laptop-twotone"
                            class="h-5 w-5 text-white dark:text-white lg:h-6 lg:w-6"
                        />
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-[#061222] dark:text-white">
                        Seguimiento en linea
                    </h3>
                    <p class="text-[#061222] dark:text-gray-400">
                        Planifica, monitorea y recibe tu moto sin sorpresas. Haz seguimiento en
                        línea de cada etapa del servicio, mantente informado en todo momento y
                        recibe notificaciones cuando esté lista.
                    </p>
                </div>
                <div>
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#fb5607] dark:bg-[#fb5607] lg:h-12 lg:w-12"
                    >
                        <Icon
                            icon="line-md:watch-twotone-loop"
                            class="h-5 w-5 text-white dark:text-white lg:h-6 lg:w-6"
                        />
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-[#061222] dark:text-white">
                        Transparencia
                    </h3>
                    <p class="text-[#061222] dark:text-gray-400">
                        Transparencia total en cada servicio. Te mostramos qué necesita tu moto,
                        cuánto costará y qué se está haciendo en cada etapa, sin letras pequeñas ni
                        costos sorpresa.
                    </p>
                </div>
                <div>
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#fb5607] dark:bg-[#fb5607] lg:h-12 lg:w-12"
                    >
                        <Icon
                            icon="line-md:check-all"
                            class="h-5 w-5 text-white dark:text-white lg:h-6 lg:w-6"
                        />
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-[#061222] dark:text-white">Calidad</h3>
                    <p class="text-[#061222] dark:text-gray-400">
                        Calidad en cada detalle, desde el primer momento. Asignamos tareas precisas
                        a nuestro equipo, seguimos procesos estandarizados y utilizamos refacciones
                        de confianza para asegurar un servicio superior.
                    </p>
                </div>
                <div>
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#fb5607] dark:bg-[#fb5607] lg:h-12 lg:w-12"
                    >
                        <Icon
                            icon="line-md:engine-filled"
                            class="h-5 w-5 text-white dark:text-white lg:h-6 lg:w-6"
                        />
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-[#061222] dark:text-white">
                        Venta de accesorios
                    </h3>
                    <p class="text-[#061222] dark:text-gray-400">
                        Accesorios de calidad para cada tipo de moto. Contamos con una selección
                        confiable y actualizada de accesorios que complementan el estilo, seguridad
                        y rendimiento de tu motocicleta.
                    </p>
                </div>
                <div>
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#fb5607] dark:bg-[#fb5607] lg:h-12 lg:w-12"
                    >
                        <Icon
                            icon="line-md:emoji-smile-filled"
                            class="h-5 w-5 text-white dark:text-white lg:h-6 lg:w-6"
                        />
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-[#061222] dark:text-white">
                        Amabilidad
                    </h3>
                    <p class="text-[#061222] dark:text-gray-400">
                        Te atendemos como te mereces, con respeto y cercanía. Nos esforzamos en
                        brindar una experiencia amable y honesta, porque para nosotros, cada cliente
                        y su moto son importantes.
                    </p>
                </div>
                <div>
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#fb5607] dark:bg-[#fb5607] lg:h-12 lg:w-12"
                    >
                        <Icon
                            icon="line-md:briefcase-check-twotone"
                            class="h-5 w-5 text-white dark:text-white lg:h-6 lg:w-6"
                        />
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-[#061222] dark:text-white">
                        Experiencia
                    </h3>
                    <p class="text-[#061222] dark:text-gray-400">
                        Experiencia que respalda cada reparación. Contamos con años de trayectoria y
                        un equipo capacitado para ofrecer soluciones precisas y duraderas en el
                        cuidado de tu moto.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
