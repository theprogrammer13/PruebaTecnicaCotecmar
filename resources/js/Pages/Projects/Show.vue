<template>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Detalle del Proyecto: {{ project.id }}</h1>
      <Link 
        href="/projects" 
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
            <p><span class="font-semibold">ID:</span> {{ project.id }}</p>
            <p><span class="font-semibold">Nombre:</span> {{ project.name }}</p>
          </div>
        </div>

        <div>
          <h3 class="font-bold text-gray-700 mb-2">Auditoría</h3>
          <div class="space-y-2">
            <p><span class="font-semibold">Creado:</span> {{ formatDate(project.created_at) }}</p>
            <p><span class="font-semibold">Última actualización:</span> {{ formatDate(project.updated_at) }}</p>
          </div>
        </div>
      </div>

      <div class="mt-8 flex space-x-4">
        <Link 
          :href="`/projects/${project.id}/edit`" 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
          Editar Proyecto
        </Link>
        <button
          @click="deleteProject"
          class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
        >
          Eliminar Proyecto
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
  project: Object,
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

const deleteProject = () => {
  if (confirm('¿Estás seguro de que quieres eliminar este proyecto?')) {
    router.delete(`/projects/${props.project.id}`);
  }
};
</script>