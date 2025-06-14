<template>

    <div class="container mx-auto px-4 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Listado de Piezas</h1>
        <Link 
          href="/parts/create" 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
          Nueva Pieza
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
              <th class="py-3 px-6 text-left">Peso Teórico</th>
              <th class="py-3 px-6 text-left">Peso Real</th>
              <th class="py-3 px-6 text-left">Estado</th>
              <th class="py-3 px-6 text-left">Proyecto</th>
              <th class="py-3 px-6 text-left">Bloque</th>
              <th class="py-3 px-6 text-left">Fecha Registro</th>
              <th class="py-3 px-6 text-center">Acciones</th>
            </tr>
          </thead>
          <tbody class="text-gray-600 text-sm font-light">
            <tr 
              v-for="part in parts" 
              :key="part.id"
              class="border-b border-gray-200 hover:bg-gray-100"
            >
              <td class="py-3 px-6 text-left">{{ part.id }}</td>
              <td class="py-3 px-6 text-left">{{ part.name }}</td>
              <td class="py-3 px-6 text-left">{{ part.theoretical_weight }} kg</td>
              <td class="py-3 px-6 text-left">{{ part.real_weight ? `${part.real_weight} kg` : '-' }}</td>
              <td class="py-3 px-6 text-left">
                <span 
                  class="px-2 py-1 rounded-full text-xs"
                  :class="{
                    'bg-yellow-200 text-yellow-800': part.status === 'Pendiente',
                    'bg-green-200 text-green-800': part.status === 'Fabricado'
                  }"
                >
                  {{ part.status }}
                </span>
              </td>
              <td class="py-3 px-6 text-left">{{ part.block.project.name }}</td>
              <td class="py-3 px-6 text-left">{{ part.block_id }}</td>
              <td class="py-3 px-6 text-left">{{ formatDate(part.registration_date) }}</td>
              <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center space-x-4">
                  <Link 
                    :href="`/parts/${part.id}`" 
                    class="text-blue-500 hover:text-blue-700"
                  >
                    Ver
                  </Link>
                  <Link 
                    :href="`/parts/${part.id}/edit`" 
                    class="text-green-500 hover:text-green-700"
                  >
                    Editar
                  </Link>
                  <button 
                    @click="deletePart(part.id)"
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
  parts: Array,
});

const formatDate = (dateString) => {
  if (!dateString) return '-';
  const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
  return new Date(dateString).toLocaleDateString('es-ES', options);
};

const deletePart = (id) => {
  if (confirm('¿Estás seguro de que quieres eliminar esta pieza?')) {
    router.delete(`/parts/${id}`);
  }
};
</script>