<template>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Proyecto: {{ project.id }}</h1>
    
    <form @submit.prevent="submit" class="max-w-md">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">ID del Proyecto</label>
        <div class="p-2 bg-gray-100 rounded">{{ project.id }}</div>
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

      <div class="flex items-center justify-between mt-6">
        <Link 
          :href="`/projects/${project.id}`" 
          class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
        >
          Cancelar
        </Link>
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          :disabled="form.processing"
        >
          Actualizar Proyecto
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  project: Object,
});

const form = useForm({
  name: props.project.name,
});

const submit = () => {
  form.put(`/projects/${props.project.id}`);
};
</script>