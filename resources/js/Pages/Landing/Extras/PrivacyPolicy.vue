<script setup lang="ts">
import { Head } from '@inertiajs/vue3'

import Navbar from '@/Pages/Landing/Partials/Navbar.vue'

import Chatbot from '../Chatbot/Chatbot.vue'
import Footer from '../Partials/Footer.vue'
</script>

<style>
/* Common transition style */
.slide-left-enter-active,
.slide-right-enter-active,
.slide-up-enter-active {
    transition: all 0.7s ease;
}

/* Slide from left */
.slide-left-enter-from {
    opacity: 0;
    transform: translateX(-50px);
}
.slide-left-enter-to {
    opacity: 1;
    transform: translateX(0);
}

/* Slide from right */
.slide-right-enter-from {
    opacity: 0;
    transform: translateX(50px);
}
.slide-right-enter-to {
    opacity: 1;
    transform: translateX(0);
}

/* Slide from bottom */
.slide-up-enter-from {
    opacity: 0;
    transform: translateY(50px);
}
.slide-up-enter-to {
    opacity: 1;
    transform: translateY(0);
}
</style>

<template>
    <Head title="Politica de privacidad" />
    <div class="min-h-screen font-sans antialiased">
        <Navbar />

        <section class="min-h-screen bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="mx-auto max-w-5xl px-6 py-12">
                <div
                    class="rounded-2xl border bg-white p-8 shadow-sm transition-colors duration-300 dark:border-gray-700 dark:bg-gray-800"
                >
                    <h1 class="mb-6 text-center text-3xl font-bold text-gray-900 dark:text-white">
                        Política de Privacidad
                    </h1>
                    <p class="mb-10 text-center text-sm text-gray-500 dark:text-gray-400">
                        Última actualización: 3 de noviembre de 2025
                    </p>

                    <section class="space-y-6 text-justify leading-relaxed">
                        <p>
                            En <strong>Motorcytech</strong> respetamos su privacidad y nos
                            comprometemos a proteger los datos personales que recopilamos conforme a
                            la
                            <em
                                >Ley Federal de Protección de Datos Personales en Posesión de los
                                Particulares</em
                            >.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            1. Responsable del Tratamiento de Datos
                        </h2>
                        <p>
                            El responsable del tratamiento de sus datos personales es
                            <strong>Motorcytech</strong>, con domicilio en Guadalajara, Jalisco,
                            México.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            2. Datos que Recabamos
                        </h2>
                        <ul class="list-disc space-y-1 pl-6">
                            <li>Datos de identificación (nombre, teléfono, correo electrónico).</li>
                            <li>Datos de su motocicleta (modelo, marca, año, número de serie).</li>
                            <li>
                                Información relacionada con servicios contratados o historial de
                                mantenimiento.
                            </li>
                        </ul>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            3. Finalidades del Tratamiento
                        </h2>
                        <p>Sus datos personales serán utilizados para:</p>
                        <ul class="list-disc space-y-1 pl-6">
                            <li>Gestionar citas y servicios en el taller.</li>
                            <li>Comunicar el avance o estatus de su motocicleta.</li>
                            <li>Emitir facturación o comprobantes de pago.</li>
                            <li>Mejorar la calidad de nuestro servicio y atención al cliente.</li>
                        </ul>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            4. Transferencia de Datos
                        </h2>
                        <p>
                            <strong>Motorcytech</strong> no transfiere sus datos personales a
                            terceros sin su consentimiento, salvo en los casos previstos por la ley.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">5. Derechos ARCO</h2>
                        <p>
                            Usted tiene derecho a <strong>Acceder</strong>,
                            <strong>Rectificar</strong>, <strong>Cancelar</strong> u
                            <strong>Oponerse</strong> (ARCO) al tratamiento de sus datos personales.
                            Puede ejercer estos derechos enviando una solicitud al correo:
                            <a
                                href="mailto:privacidad@motorcytech.mx"
                                class="text-primary hover:underline"
                                >privacidad@motorcytech.mx</a
                            >.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            6. Seguridad de la Información
                        </h2>
                        <p>
                            <strong>Motorcytech</strong> adopta medidas administrativas, técnicas y
                            físicas necesarias para proteger sus datos personales contra daño,
                            pérdida, alteración o acceso no autorizado.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">7. Uso de Cookies</h2>
                        <p>
                            Nuestro sitio web puede utilizar cookies para mejorar la experiencia del
                            usuario. El uso de cookies puede deshabilitarse desde la configuración
                            de su navegador.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">8. Modificaciones</h2>
                        <p>
                            Nos reservamos el derecho de modificar la presente Política de
                            Privacidad en cualquier momento. Los cambios serán publicados en este
                            mismo sitio web.
                        </p>

                        <p class="mt-10 text-center font-medium text-gray-600 dark:text-gray-400">
                            © 2025 Motorcytech. Todos los derechos reservados.
                        </p>
                    </section>
                </div>
            </div>
        </section>

        <Footer />
        <Chatbot />
    </div>
</template>
