<template>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Crear Nueva Pieza</h1>
    
    <form @submit.prevent="submit" class="max-w-2xl">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="mb-4">
          <label for="id" class="block text-gray-700 text-sm font-bold mb-2">ID de Pieza *</label>
          <input
            id="id"
            v-model="form.id"
            type="text"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required
          >
          <p v-if="form.errors.id" class="mt-1 text-red-500 text-xs">{{ form.errors.id }}</p>
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

        <div class="mb-4">
          <label for="project_id" class="block text-gray-700 text-sm font-bold mb-2">Proyecto *</label>
          <select
            id="project_id"
            v-model="form.project_id"
            @change="form.block_id = ''"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required
          >
            <option value="" disabled selected>Seleccione un proyecto</option>
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
            <option value="" disabled selected>
              {{ form.project_id ? 'Seleccione un bloque' : 'Primero seleccione un proyecto' }}
            </option>
            <option 
              v-for="block in blocks.filter(b => b.project_id === form.project_id)" 
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
          href="/parts" 
          class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
        >
          Cancelar
        </Link>
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          :disabled="form.processing"
        >
          <span v-if="!form.processing">Guardar Pieza</span>
          <span v-else>Guardando...</span>
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  projects: {
    type: Array,
    default: () => []
  },
  blocks: {
    type: Array,
    default: () => []
  }
})

const form = useForm({
  id: '',
  name: '',
  theoretical_weight: 0,
  real_weight: null,
  status: 'Pendiente',
  project_id: '',
  block_id: '',
  registration_date: new Date().toISOString()
})

const submit = () => {
  form.post('/parts', {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
    }
  })
}
</script>