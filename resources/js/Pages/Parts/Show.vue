<template>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Detalle de Pieza: {{ part.id }}</h1>
      <Link 
        href="/parts" 
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
      >
        Volver al Listado
      </Link>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <h3 class="font-bold text-gray-700 mb-2">Información Básica</h3>
          <div class="space-y-2">
            <p><span class="font-semibold">Nombre:</span> {{ part.name }}</p>
            <p><span class="font-semibold">Estado:</span> 
              <span 
                class="px-2 py-1 rounded-full text-xs"
                :class="{
                  'bg-yellow-200 text-yellow-800': part.status === 'Pendiente',
                  'bg-green-200 text-green-800': part.status === 'Fabricado'
                }"
              >
                {{ part.status }}
              </span>
            </p>
            <p><span class="font-semibold">Bloque:</span> {{ part.block_id }}</p>
          </div>
        </div>

        <div>
          <h3 class="font-bold text-gray-700 mb-2">Pesos</h3>
          <div class="space-y-2">
            <p><span class="font-semibold">Peso Teórico:</span> {{ part.theoretical_weight }} kg</p>
            <p><span class="font-semibold">Peso Real:</span> {{ part.real_weight ? `${part.real_weight} kg` : 'No registrado' }}</p>
            <p v-if="part.real_weight">
              <span class="font-semibold">Diferencia:</span> 
              {{ (part.theoretical_weight - part.real_weight).toFixed(2) }} kg
            </p>
          </div>
        </div>

        <div>
          <h3 class="font-bold text-gray-700 mb-2">Registro</h3>
          <div class="space-y-2">
            <p><span class="font-semibold">Fecha de Registro:</span> {{ formatDate(part.registration_date) }}</p>
            
            <p v-if="part.registered_by"><span class="font-semibold">Registrado por:</span> {{ part.registered_by.name }}</p>

          </div>
        </div>

        <div>
          <h3 class="font-bold text-gray-700 mb-2">Auditoría</h3>
          <div class="space-y-2">
            <p><span class="font-semibold">Creado:</span> {{ formatDate(part.created_at) }}</p>
            <p><span class="font-semibold">Última actualización:</span> {{ formatDate(part.updated_at) }}</p>
          </div>
        </div>
      </div>

      <div class="mt-8 flex space-x-4">
        <Link 
          :href="`/parts/${part.id}/edit`" 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
          Editar Pieza
        </Link>
        <button
          @click="deletePart"
          class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
        >
          Eliminar Pieza
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
  part: Object,
});

const formatDate = (dateString) => {
  if (!dateString) return 'No registrado';
  const options = { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric', 
    hour: '2-digit', 
    minute: '2-digit',
    timeZone: 'UTC' 
  };
  return new Date(dateString).toLocaleDateString('es-ES', options);
};

const deletePart = () => {
  if (confirm('¿Estás seguro de que quieres eliminar esta pieza?')) {
    router.delete(`/parts/${props.part.id}`);
  }
};
</script>