<template>
  
    <div class="container mx-auto px-4 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Listado de Bloques</h1>
        <Link 
          href="/blocks/create" 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
          Nuevo Bloque
        </Link>
      </div>

      <div v-if="$page.props.status" class="mb-4 p-4 bg-green-100 text-green-700 rounded">
        {{ $page.props.status }}
      </div>

      <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
        <table class="min-w-full">
          <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
              <th class="py-3 px-6 text-left">ID</th>
              <th class="py-3 px-6 text-left">Nombre</th>
              <th class="py-3 px-6 text-left">Proyecto</th>
              <th class="py-3 px-6 text-left">Creado</th>
              <th class="py-3 px-6 text-center">Acciones</th>
            </tr>
          </thead>
          <tbody class="text-gray-600 text-sm font-light">
            <tr 
              v-for="block in blocks" 
              :key="block.id"
              class="border-b border-gray-200 hover:bg-gray-100"
            >
              <td class="py-3 px-6 text-left">{{ block.id }}</td>
              <td class="py-3 px-6 text-left">{{ block.name }}</td>
              <td class="py-3 px-6 text-left">{{ block.project_id }}</td>
              <td class="py-3 px-6 text-left">{{ formatDate(block.created_at) }}</td>
              <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center space-x-4">
                  <Link 
                    :href="`/blocks/${block.id}`" 
                    class="text-blue-500 hover:text-blue-700"
                  >
                    Ver
                  </Link>
                  <Link 
                    :href="`/blocks/${block.id}/edit`" 
                    class="text-green-500 hover:text-green-700"
                  >
                    Editar
                  </Link>
                  <button 
                    @click="deleteBlock(block.id)"
                    class="text-red-500 hover:text-red-700"
                  >
                    Eliminar
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
  blocks: Array,
});

const formatDate = (dateString) => {
  if (!dateString) return '-';
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return new Date(dateString).toLocaleDateString('es-ES', options);
};

const deleteBlock = (id) => {
  if (confirm('¿Estás seguro de que quieres eliminar este bloque?')) {
    router.delete(`/blocks/${id}`);
  }
};
</script>