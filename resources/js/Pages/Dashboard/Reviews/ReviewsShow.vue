<script setup lang="ts">
import type { Review } from '@/interfaces/Review'
import Navbar from '@/Pages/Landing/Partials/Navbar.vue';
import Footer from '@/Pages/Landing/Partials/Footer.vue';

const props = withDefaults(defineProps<{
  reviews?: Review[]  // 🔹 puede ser undefined si no llega de Inertia
}>(), {
  reviews: () => []   // 🔹 default: array vacío
})
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
  <div class="flex flex-col min-h-screen font-sans antialiased bg-white dark:bg-[#061222] text-[#061222] dark:text-white">
    <Navbar/>

    <!-- Contenido principal que crece -->
    <main class="flex-grow">
      <section class="py-12">
        <div class="mx-auto max-w-4xl px-4">
          <h2 class="text-3xl font-semibold mb-8 text-center text-gray-900 dark:text-white">Reseñas</h2>

          <div v-if="props.reviews.length" class="flex flex-col gap-4">
            <div
              v-for="review in props.reviews"
              :key="review.id"
              class="bg-[#f7f7f7] dark:bg-[#0c1a2b] rounded-lg p-6 shadow-lg flex flex-col font-['Poppins']"
            >
              <div class="flex gap-6">
                <!-- Columna izquierda: Estrellas, nombre y fecha -->
                <div class="flex flex-col gap-2 w-1/3">
                  <!-- Estrellas -->
                  <div class="flex items-center gap-1">
                    <svg
                      v-for="star in 5"
                      :key="star"
                      class="h-5 w-5"
                      :class="star <= review.rating ? 'text-yellow-400' : 'text-gray-400 dark:text-gray-600'"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 
                           0L8.397 8.387l-4.552.361c-1.775.14-2.495 
                           2.331-1.142 3.477l3.468 2.937-1.06 
                           4.392c-.413 1.713 1.472 3.067 
                           2.992 2.149L12 19.35l3.897 
                           2.354c1.52.918 3.405-.436 
                           2.992-2.15l-1.06-4.39 
                           3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"
                      />
                    </svg>
                  </div>

                  <p class="font-semibold text-lg text-[#061222] dark:text-white">{{ review.client?.name || 'Cliente' }}</p>
                  <span class="text-sm text-gray-600 dark:text-gray-400">{{ new Date(review.created_at).toLocaleDateString() }}</span>
                </div>

                <!-- Columna derecha: Comentario -->
                <div class="flex flex-col justify-between w-2/3">
                  <p class="text-[#061222] dark:text-gray-400 text-lg leading-relaxed">{{ review.comment }}</p>

                  <!-- Servicio finalizado abajo -->
                  <span class="text-[#fb5607] text-sm flex items-center gap-1 mt-4 self-end">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 0L14.09 7.36H21.82L15.36 11.91L17.45 19.27L12 14.72L6.55 19.27L8.64 11.91L2.18 7.36H9.91L12 0Z"/>
                    </svg>
                    Servicio finalizado
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Si no hay reseñas -->
          <div v-else class="text-center text-gray-400 mt-10">
            No hay reseñas aún.
          </div>
        </div>
      </section>
    </main>

    <Footer/>
  </div>
</template>



