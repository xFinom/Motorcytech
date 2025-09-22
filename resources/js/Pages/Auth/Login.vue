<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'

import { useDark, useToggle } from '@vueuse/core'

import { Button } from '@/Components/ui/button/index'

import { Icon } from '@iconify/vue'

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

  <div class="flex min-h-screen flex-col items-center justify-center bg-[#e5e7eb] dark:bg-[#061222] p-4 sm:p-6 md:p-10">
    <div class="w-full max-w-4xl bg-white dark:bg-[#1e293b] text-[#061222] dark:text-white border border-gray-300 dark:border-gray-700 rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row">
      
      <div class="block md:hidden w-full">
        <img
          src="https://img.freepik.com/foto-gratis/tiro-completo-adulto-equipo-montando-motocicleta_23-2150781530.jpg?semt=ais_hybrid&w=740"
          alt="Login Illustration"
          class="w-full h-auto object-contain bg-black"
        />
      </div>

      <div class="w-full md:w-1/2 p-6 md:p-10">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-2xl font-bold tracking-tight">Bienvenido</h2>
          <Button
            variant="ghost"
            class="rounded-full p-2 bg-gray-100 dark:bg-gray-700 text-[#061222] dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 transition"
            :class="[
              isScrolled
                ? 'text-[#fefcf9] dark:text-gray-200'
                : 'text-[#061222] dark:text-white',
            ]"
            @click="toggleDarkMode"
          >
            <Icon
              :icon="isDark
                ? 'line-md:moon-alt-to-sunny-outline-loop-transition'
                : 'line-md:sunny-outline-to-moon-loop-transition'"
              class="text-2xl"
            />
          </Button>
        </div>

        <p class="text-sm mb-6 text-[#061222] dark:text-white">Ingresa a tu cuenta de Motorcytech</p>

        <form @submit.prevent="submit" class="space-y-4">
          <div class="space-y-2">
            <label for="email" class="text-sm font-medium">Correo</label>
            <input
              id="email"
              type="email"
              v-model="form.email"
              required
              class="w-full rounded-md border border-gray-300 bg-white dark:bg-[#0f172a] text-[#061222] dark:text-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-[#fb5607]"
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
              class="w-full rounded-md border border-gray-300 bg-white dark:bg-[#0f172a] text-[#061222] dark:text-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-[#fb5607]"
            />
          </div>

                <div class="flex items-center">
        <input
          id="remember"
          type="checkbox"
          v-model="form.remember"
          class="h-5 w-5 rounded border-gray-300 text-[#fb5607] focus:ring-[#fb5607]"
        />
        <label for="remember" class="m-2 block text-sm text-gray-900 dark:text-white">
          Mantener sesión activa
        </label>
      </div>

      <button
        class="mx-auto justify-end rounded-md px-6 py-2 font-semibold transition duration-300"
        :class="
          isScrolled
            ? 'border border-[#fb5607] dark:border-white text-white hover:bg-[#fb5607]'
            : 'border border-[#fb5607] text-black hover:bg-[#fb5607] hover:text-[#fefcf9] dark:text-white'
        "
      >
        Iniciar Sesión
      </button>
        </form>

      </div>

 
      <div class="hidden md:block md:w-1/2 bg-muted">
        <img
          src="https://img.freepik.com/foto-gratis/tiro-completo-adulto-equipo-montando-motocicleta_23-2150781530.jpg?semt=ais_hybrid&w=740"
          alt="Login Illustration"
          class="h-full w-full object-cover"
        />
      </div>
    </div>

    <p class="mt-4 text-center text-xs text-muted-foreground px-4">
      Al continuar aceptas nuestros
      <a href="#" class="underline text-[#fb5607]">Términos de Servicio</a> y
      <a href="#" class="underline text-[#fb5607]">Política de Privacidad</a>.
    </p>
  </div>
</template>