<script setup lang="ts">
import { ref } from 'vue'
import { Icon } from '@iconify/vue'
import { router } from '@inertiajs/vue3'
import SuccessReview from './Partials/SuccessReview.vue'

// Formulario
const formData = ref({
  rating: 0,
  comment: ''
})
const hoverRating = ref(0)

// Estado del modal o mensaje de éxito
const isSuccessOpen = ref(false)

const enviarMensaje = () => {
  if (!formData.value.comment.trim()) {
    alert('Por favor, escribe un mensaje antes de enviar.')
    return
  }

  // Enviar al backend con Inertia router
  router.post('/reviews', formData.value, {
    onSuccess: () => {
      // Abrir modal o mensaje de éxito
      isSuccessOpen.value = true

      // Limpiar formulario
      formData.value.rating = 0
      formData.value.comment = ''
    },
    onError: (errors) => {
      console.error(errors)
      alert('Ocurrió un error al enviar la reseña.')
    }
  })
}
</script>
<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-300">

    <!-- Header -->
    <div class="w-[450px] bg-[#061222] text-center py-6 relative">
      <h1 class="text-white text-2xl font-bold flex items-center justify-center gap-2">
        
        <!-- Icono con Iconify -->
        <Icon 
          icon="mdi:tools"
          class="text-3xl text-orange-500"
        />

        MOTORCY <span class="text-primary">TECH</span>
      </h1>
    </div>

    <!-- Contenido de feedback -->
    <div class="bg-white shadow-lg rounded-lg p-8 mt-2 w-full max-w-md text-center hover:shadow-2xl transition-shadow">

      <p class="text-black mb-6 font-medium">Tu opinión es muy importante para nosotros</p>

<!-- Estrellas -->
<div class="flex justify-center gap-1 mb-6 text-2xl cursor-pointer">
  <span
    v-for="n in 5"
    :key="n"
    @click="formData.rating = n"
    @mouseover="hoverRating = n"
    @mouseleave="hoverRating = 0"
    :class="[(hoverRating >= n || formData.rating >= n) ? 'text-orange-400' : 'text-gray-400']"
  >
    ★
  </span>
</div>

<!-- Textarea -->
<textarea
  class="w-full border border-orange-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-orange-400"
  rows="4"
  placeholder="Escribe tu mensaje aquí..."
  v-model="formData.comment"
></textarea>

<!-- Botón -->
<button
  @click="enviarMensaje"
  class="w-full bg-orange-500 text-white py-2 rounded-md hover:bg-orange-600 transition-colors"
>
  Enviar mensaje
</button>

    </div>

  </div>
  <SuccessReview v-model:open="isSuccessOpen"/>
</template>

