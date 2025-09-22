<script setup>
import { useDark, useToggle } from '@vueuse/core'

import { Head, Link, useForm } from '@inertiajs/vue3'

import { Icon } from '@iconify/vue'

import { Button } from '@/Components/ui/button/index'

const isDark = useDark({ selector: 'html' })
const toggleDark = useToggle(isDark)

function toggleDarkMode() {
    toggleDark()
}

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
    <Head title="Log in" />

    <div
        class="flex min-h-screen flex-col items-center justify-center bg-[#e5e7eb] p-4 dark:bg-[#061222] sm:p-6 md:p-10"
    >
        <div
            class="flex w-full max-w-4xl flex-col overflow-hidden rounded-lg border border-gray-300 bg-white text-[#061222] shadow-lg dark:border-gray-700 dark:bg-[#1e293b] dark:text-white md:flex-row"
        >
            <div class="block w-full md:hidden">
                <img
                    src="https://img.freepik.com/foto-gratis/tiro-completo-adulto-equipo-montando-motocicleta_23-2150781530.jpg?semt=ais_hybrid&w=740"
                    alt="Login Illustration"
                    class="h-auto w-full bg-black object-contain"
                />
            </div>

            <div class="w-full p-6 md:w-1/2 md:p-10">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-2xl font-bold tracking-tight">Bienvenido</h2>
                    <Button
                        variant="ghost"
                        class="rounded-full bg-gray-100 p-2 text-[#061222] transition hover:bg-gray-200 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600"
                        :class="[
                            isScrolled
                                ? 'text-[#fefcf9] dark:text-gray-200'
                                : 'text-[#061222] dark:text-white',
                        ]"
                        @click="toggleDarkMode"
                    >
                        <Icon
                            :icon="
                                isDark
                                    ? 'line-md:moon-alt-to-sunny-outline-loop-transition'
                                    : 'line-md:sunny-outline-to-moon-loop-transition'
                            "
                            class="text-2xl"
                        />
                    </Button>
                </div>

                <p class="mb-6 text-sm text-[#061222] dark:text-white">
                    Ingresa a tu cuenta de Motorcytech
                </p>

                <form @submit.prevent="submit" class="space-y-4">
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium">Correo</label>
                        <input
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-[#061222] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#fb5607] dark:bg-[#0f172a] dark:text-white"
                            placeholder="usuario@ejemplo.com"
                        />
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="text-sm font-medium">Contraseña</label>
                            <Link
                                :href="route('password.request')"
                                class="text-sm text-[#fb5607] hover:underline"
                            >
                                ¿Olvidaste tu contraseña?
                            </Link>
                        </div>
                        <input
                            id="password"
                            type="password"
                            v-model="form.password"
                            required
                            class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-[#061222] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#fb5607] dark:bg-[#0f172a] dark:text-white"
                        />
                    </div>

                    <div class="flex items-center">
                        <input
                            id="remember"
                            type="checkbox"
                            v-model="form.remember"
                            class="h-5 w-5 rounded border-gray-300 text-[#fb5607] focus:ring-[#fb5607]"
                        />
                        <label
                            for="remember"
                            class="m-2 block text-sm text-gray-900 dark:text-white"
                        >
                            Mantener sesión activa
                        </label>
                    </div>

                    <button
                        class="mx-auto justify-end rounded-md px-6 py-2 font-semibold transition duration-300"
                        :class="
                            isScrolled
                                ? 'border border-[#fb5607] text-white hover:bg-[#fb5607] dark:border-white'
                                : 'border border-[#fb5607] text-black hover:bg-[#fb5607] hover:text-[#fefcf9] dark:text-white'
                        "
                    >
                        Iniciar Sesión
                    </button>
                </form>
            </div>

            <div class="hidden bg-muted md:block md:w-1/2">
                <img
                    src="https://img.freepik.com/foto-gratis/tiro-completo-adulto-equipo-montando-motocicleta_23-2150781530.jpg?semt=ais_hybrid&w=740"
                    alt="Login Illustration"
                    class="h-full w-full object-cover"
                />
            </div>
        </div>

        <p class="mt-4 px-4 text-center text-xs text-muted-foreground">
            Al continuar aceptas nuestros
            <a href="#" class="text-[#fb5607] underline">Términos de Servicio</a> y
            <a href="#" class="text-[#fb5607] underline">Política de Privacidad</a>.
        </p>
    </div>
</template>
