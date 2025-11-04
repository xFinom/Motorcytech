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
    <Head title="Terminos y condiciones" />
    <div class="min-h-screen font-sans antialiased">
        <Navbar />
        <section class="min-h-screen bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="mx-auto max-w-5xl px-6 py-12">
                <div
                    class="rounded-2xl border bg-white p-8 shadow-sm transition-colors duration-300 dark:border-gray-700 dark:bg-gray-800"
                >
                    <h1 class="mb-6 text-center text-3xl font-bold text-gray-900 dark:text-white">
                        Términos y Condiciones de Uso
                    </h1>
                    <p class="mb-10 text-center text-sm text-gray-500 dark:text-gray-400">
                        Última actualización: 3 de noviembre de 2025
                    </p>

                    <section class="space-y-6 text-justify leading-relaxed">
                        <p>
                            Bienvenido a <strong>Motorcytech</strong>. Al acceder y utilizar este
                            sitio web o cualquiera de nuestros servicios digitales, usted acepta
                            cumplir con los presentes
                            <strong>Términos y Condiciones de Uso</strong>. Si no está de acuerdo
                            con alguno de los puntos descritos, debe abstenerse de utilizar este
                            sitio o los servicios ofrecidos.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">1. Objeto</h2>
                        <p>
                            El presente documento regula el acceso y uso del sitio web de
                            <strong>Motorcytech</strong>, así como los servicios de gestión,
                            diagnóstico, mantenimiento y reparación de motocicletas ofrecidos a
                            través de esta plataforma.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            2. Aceptación del Usuario
                        </h2>
                        <p>
                            El uso del sitio implica la aceptación plena y sin reservas de todas las
                            disposiciones incluidas en estos términos. El usuario declara haber
                            leído, comprendido y aceptado las condiciones aquí establecidas.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            3. Servicios Ofrecidos
                        </h2>
                        <p>
                            <strong>Motorcytech</strong> proporciona herramientas digitales para el
                            seguimiento del estatus de reparación, historial de mantenimiento y
                            comunicación directa con el taller. Nos reservamos el derecho de
                            modificar, suspender o descontinuar temporal o definitivamente cualquier
                            servicio sin previo aviso.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            4. Responsabilidad del Usuario
                        </h2>
                        <ul class="list-disc space-y-1 pl-6">
                            <li>Proporcionar información veraz y actualizada.</li>
                            <li>Utilizar los servicios conforme a la ley y la buena fe.</li>
                            <li>
                                No interferir con el funcionamiento técnico del sistema ni intentar
                                acceder a información de otros usuarios.
                            </li>
                        </ul>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            5. Propiedad Intelectual
                        </h2>
                        <p>
                            Todos los contenidos, logotipos, marcas, diseños, textos, imágenes y
                            software utilizados en el sitio son propiedad de
                            <strong>Motorcytech</strong> o de sus respectivos titulares, y están
                            protegidos por la legislación nacional e internacional sobre propiedad
                            intelectual.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            6. Privacidad y Protección de Datos
                        </h2>
                        <p>
                            El tratamiento de los datos personales se rige por nuestra
                            <RouterLink
                                to="/politica-privacidad"
                                class="text-primary hover:underline"
                            >
                                Política de Privacidad </RouterLink
                            >, la cual forma parte integral de los presentes términos.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            7. Limitación de Responsabilidad
                        </h2>
                        <p>
                            <strong>Motorcytech</strong> no se responsabiliza por daños derivados
                            del uso indebido del sitio, fallas técnicas, interrupciones del servicio
                            o pérdida de información ocasionada por terceros.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">8. Modificaciones</h2>
                        <p>
                            <strong>Motorcytech</strong> se reserva el derecho de modificar estos
                            Términos y Condiciones en cualquier momento. Las modificaciones entrarán
                            en vigor a partir de su publicación en el sitio web.
                        </p>

                        <h2 class="mt-6 text-xl font-semibold text-primary">
                            9. Legislación Aplicable
                        </h2>
                        <p>
                            Estos términos se rigen por las leyes vigentes en los
                            <strong>Estados Unidos Mexicanos</strong>, y cualquier controversia será
                            resuelta ante los tribunales competentes de la ciudad de Guadalajara,
                            Jalisco.
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
