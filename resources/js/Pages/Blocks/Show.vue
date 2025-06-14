<template>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Detalle del Bloque: {{ block.id }}</h1>
      <Link 
        href="/blocks" 
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
            <p><span class="font-semibold">ID:</span> {{ block.id }}</p>
            <p><span class="font-semibold">Nombre:</span> {{ block.name }}</p>
            <p><span class="font-semibold">Proyecto:</span> {{ block.project_id }}</p>
          </div>
        </div>

        <div>
          <h3 class="font-bold text-gray-700 mb-2">Auditoría</h3>
          <div class="space-y-2">
            <p><span class="font-semibold">Creado:</span> {{ formatDate(block.created_at) }}</p>
            <p><span class="font-semibold">Última actualización:</span> {{ formatDate(block.updated_at) }}</p>
          </div>
        </div>
      </div>

      <div class="mt-8 flex space-x-4">
        <Link 
          :href="`/blocks/${block.id}/edit`" 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
          Editar Bloque
        </Link>
        <button
          @click="deleteBlock"
          class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
        >
          Eliminar Bloque
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
  block: Object,
});

const formatDate = (dateString) => {
  if (!dateString) return 'No registrado';
  const options = { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric', 
    hour: '2-digit', 
    minute: '2-digit' 
  };
  return new Date(dateString).toLocaleDateString('es-ES', options);
};

const deleteBlock = () => {
  if (confirm('¿Estás seguro de que quieres eliminar este bloque?')) {
    router.delete(`/blocks/${props.block.id}`);
  }
};
</script>