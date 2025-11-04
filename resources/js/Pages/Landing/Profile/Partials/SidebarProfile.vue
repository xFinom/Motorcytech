<script setup>
import { User, ClipboardList } from 'lucide-vue-next'
</script>

<template>
  <aside
    class="w-64 h-screen bg-gray-900 text-white flex flex-col justify-between shadow-lg"
  >
    <!-- LOGO -->
    <div>
      <div class="flex items-center justify-center py-6 border-b border-gray-700">
        <h1 class="text-2xl font-bold text-primary">Bienvenido a tu perfil</h1>
      </div>

      <!-- ENLACES -->
      <nav class="mt-6 flex flex-col space-y-1">
        <a
          href= "#"
          class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors"
        >
          <User class="w-5 h-5 mr-3" />
          <span>Perfil</span>
        </a>

        <a
          :href="route('service.order.profileindex')"
          class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors"
        >
          <ClipboardList class="w-5 h-5 mr-3" />
          <span>Órdenes de servicio</span>
        </a>
      </nav>
    </div>
  </aside>
</template>


