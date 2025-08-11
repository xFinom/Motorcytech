<template>
  <section class="py-16 px-4 bg-white text-black dark:bg-[#061222] dark:text-white">
    <div class="flex items-center justify-center gap-4 mb-12">
      <Icon icon="mdi:tools" class="text-[#fb5607] text-5xl" />
      <h2 class="text-4xl font-extrabold text-[#061222] dark:text-white slide-up-enter">
        Nuestros <span class="text-[#fb5607]">Servicios</span>
      </h2>
      <Icon icon="mdi:tools" class="text-[#fb5607] text-5xl" />
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <div
        v-for="servicio in servicios"
        :key="servicio.titulo"
        class="relative bg-white/5 backdrop-blur-md rounded-2xl overflow-hidden shadow-lg"
      >
        <div
          class="aspect-video bg-cover bg-center"
          :style="{ backgroundImage: `url(${servicio.imagen})` }"
        ></div>

        <div class="absolute top-3 right-3 z-10">
          <div class="relative group">
            <button
              class="text-white bg-black/50 rounded-full p-2 hover:bg-black/70 transition"
              title="Ver detalles"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="3"
                  d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"
                />
              </svg>
            </button>

            <div
              class="absolute top-full right-0 mt-2 w-64 p-4 bg-slate-800 text-sm text-white rounded-lg shadow-xl z-50 hidden group-hover:block"
            >
              <ul class="list-disc list-inside space-y-1">
                <li v-for="item in servicio.detalles" :key="item">{{ item }}</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="p-4 bg-[#0f172a] text-center text-lg font-semibold text-orange-400">
          {{ servicio.titulo }}
        </div>
      </div>
    </div>
  </section>
</template>


<script setup>
import { Icon } from '@iconify/vue'
const servicios = [
  {
    titulo: 'Mantenimiento Preventivo',
    imagen: 'https://www.shutterstock.com/image-photo/pouring-new-motor-oil-into-600nw-2370170305.jpg',
    detalles: [
      'Afinación completa',
      'Cambio de líquidos',
      'Limpieza y lubricación',
      'Ajustes generales',
    ],
  },
  {
    titulo: 'Reparación',
    imagen: 'https://moltta.com/cdn/shop/articles/Errores_Comunes_en_el_Mantenimiento_de_Motos_y_Como_Evitarlos.jpg?v=1712784383',
    detalles: [
      'Suspensiones y amortiguadores',
      'Motores',
      'Fallas eléctricas',
      'Frenos',
    ],
  },
  {
    titulo: 'Enderezado de pipas',
    imagen: 'https://cdn-0.motocrossactionmag.com/wp-content/uploads/2018/11/GasGas-25013.jpg',
    detalles: [
      'Reparación de fugas',
      'Enderezado con calor',
      'Pintura',
    ],
  },
  {
    titulo: 'Escaneo',
    imagen: 'https://www.dtc.tools/cdn/shop/products/prod-g-navigator-txb-evolution-06_1200x.jpg?v=1522978810',
    detalles: [
      'Lectura de códigos de falla',
      'Borrado de códigos de falla',
      'Reprogramación básica',
      'Lectura de datos en tiempo real',
    ],
  },
  {
    titulo: 'Carburación y fuel injection',
    imagen: 'https://talleractual.com/images/contenido/moto-actual/tecnica-al-dia/2019/09/2019-09-12-mantenimiento-del-carburador-de-moto-4-04.jpg',
    detalles: [
      'Limpieza de carburadores',
      'Ajuste de espreas',
      'Limpieza de inyectores',
      'Sincronización',
    ],
  },
  {
    titulo: 'Revisión General',
    imagen: 'https://www.shutterstock.com/image-photo/handsome-man-workwear-adjusting-engine-260nw-1546732175.jpg',
    detalles: [
      'Tornillería general',
      'Revisión de componentes',
      'Revisión de llantas',
      'Niveles y fluidos',
    ],
  },
];
</script>