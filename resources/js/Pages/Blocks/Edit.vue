<template>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Bloque: {{ block.id }}</h1>
    
    <form @submit.prevent="submit" class="max-w-md">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">ID del Bloque</label>
        <div class="p-2 bg-gray-100 rounded">{{ block.id }}</div>
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
        <p v-if="form.errors.name" class="text-red-500 text-xs italic">{{ form.errors.name }}</p>
      </div>

      <div class="mb-4">
        <label for="project_id" class="block text-gray-700 text-sm font-bold mb-2">Proyecto *</label>
        <select
          id="project_id"
          v-model="form.project_id"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        >
          <option value="" disabled selected>Seleccione un proyecto</option>
          <option 
            v-for="project in $page.props.projects" 
            :key="project.id" 
            :value="project.id"
          >
            {{ project.name }} ({{ project.id }})
          </option>
        </select>
        <p v-if="form.errors.project_id" class="text-red-500 text-xs italic">{{ form.errors.project_id }}</p>
      </div>

      <div class="flex items-center justify-between mt-6">
        <Link 
          :href="`/blocks/${block.id}`" 
          class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
        >
          Cancelar
        </Link>
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          :disabled="form.processing"
        >
          Actualizar Bloque
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  block: Object,
});

const form = useForm({
  name: props.block.name,
  project_id: props.block.project_id,
});

const submit = () => {
  form.put(`/blocks/${props.block.id}`);
};
</script>