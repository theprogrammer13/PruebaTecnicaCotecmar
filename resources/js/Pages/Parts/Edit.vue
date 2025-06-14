<template>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Pieza: {{ part.id }}</h1>
    
    <form @submit.prevent="submit" class="max-w-2xl">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">ID de Pieza</label>
          <div class="p-2 bg-gray-100 rounded">{{ part.id }}</div>
        </div>

        <div class="mb-4">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre *</label>
          <input
            id="name"
            v-model="form.name"
            type="text"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required
          >
          <p v-if="form.errors.name" class="mt-1 text-red-500 text-xs">{{ form.errors.name }}</p>
        </div>

        <div class="mb-4">
          <label for="theoretical_weight" class="block text-gray-700 text-sm font-bold mb-2">Peso Teórico (kg) *</label>
          <input
            id="theoretical_weight"
            v-model="form.theoretical_weight"
            type="number"
            step="0.01"
            min="0"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required
          >
          <p v-if="form.errors.theoretical_weight" class="mt-1 text-red-500 text-xs">{{ form.errors.theoretical_weight }}</p>
        </div>

        <div class="mb-4">
          <label for="real_weight" class="block text-gray-700 text-sm font-bold mb-2">Peso Real (kg)</label>
          <input
            id="real_weight"
            v-model="form.real_weight"
            type="number"
            step="0.01"
            min="0"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          >
          <p v-if="form.errors.real_weight" class="mt-1 text-red-500 text-xs">{{ form.errors.real_weight }}</p>
        </div>

        <!-- Selector de Proyecto -->
        <div class="mb-4">
          <label for="project_id" class="block text-gray-700 text-sm font-bold mb-2">Proyecto *</label>
          <select
            id="project_id"
            v-model="form.project_id"
            @change="updateAvailableBlocks"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required
          >
            <option value="" disabled>Seleccione un proyecto</option>
            <option 
              v-for="project in projects" 
              :key="project.id" 
              :value="project.id"
            >
              {{ project.name }} ({{ project.id }})
            </option>
          </select>
          <p v-if="form.errors.project_id" class="mt-1 text-red-500 text-xs">{{ form.errors.project_id }}</p>
        </div>

        <!-- Selector de Bloque (dependiente del proyecto seleccionado) -->
        <div class="mb-4">
          <label for="block_id" class="block text-gray-700 text-sm font-bold mb-2">Bloque *</label>
          <select
            id="block_id"
            v-model="form.block_id"
            :disabled="!form.project_id"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            :class="{ 'bg-gray-100': !form.project_id }"
            required
          >
            <option value="" disabled>
              {{ form.project_id ? 'Seleccione un bloque' : 'Primero seleccione un proyecto' }}
            </option>
            <option 
              v-for="block in availableBlocks" 
              :key="block.id" 
              :value="block.id"
            >
              {{ block.name }} ({{ block.id }})
            </option>
          </select>
          <p v-if="form.errors.block_id" class="mt-1 text-red-500 text-xs">{{ form.errors.block_id }}</p>
        </div>

        <div class="mb-4">
          <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Estado *</label>
          <select
            id="status"
            v-model="form.status"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required
          >
            <option value="Pendiente">Pendiente</option>
            <option value="Fabricado">Fabricado</option>
          </select>
          <p v-if="form.errors.status" class="mt-1 text-red-500 text-xs">{{ form.errors.status }}</p>
        </div>
      </div>

      <div class="flex items-center justify-between mt-6">
        <Link 
          :href="`/parts/${part.id}`" 
          class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
        >
          Cancelar
        </Link>
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          :disabled="form.processing"
        >
          <span v-if="!form.processing">Actualizar Pieza</span>
          <span v-else>Actualizando...</span>
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  part: {
    type: Object,
    required: true
  },
  projects: {
    type: Array,
    default: () => []
  },
  blocks: {
    type: Array,
    default: () => []
  }
})

// Inicializar el formulario con los valores de la pieza
const form = useForm({
  name: props.part.name,
  theoretical_weight: props.part.theoretical_weight,
  real_weight: props.part.real_weight,
  status: props.part.status,
  project_id: props.part.block?.project_id || '',
  block_id: props.part.block_id
})

// Bloques disponibles filtrados por proyecto seleccionado
const availableBlocks = computed(() => {
  if (!form.project_id) return []
  return props.blocks.filter(block => block.project_id === form.project_id)
})

// Actualizar bloques disponibles cuando cambia el proyecto
const updateAvailableBlocks = () => {
  // Si el bloque actual no pertenece al nuevo proyecto, lo limpiamos
  const currentBlock = props.blocks.find(b => b.id === form.block_id)
  if (!currentBlock || currentBlock.project_id !== form.project_id) {
    form.block_id = ''
  }
}

// Precargar el proyecto y bloque actual al montar el componente
onMounted(() => {
  if (props.part.block) {
    form.project_id = props.part.block.project_id
  }
})

const submit = () => {
  // Solo enviamos block_id al servidor (project_id es solo para UI)
  form.transform((data) => ({
    ...data,
    project_id: undefined // No enviar project_id al servidor
  })).put(`/parts/${props.part.id}`, {
    preserveScroll: true
  })
}
</script>