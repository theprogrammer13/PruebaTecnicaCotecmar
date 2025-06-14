<template>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Crear Nuevo Proyecto</h1>
    
    <form @submit.prevent="submit" class="max-w-md">
      <div class="mb-4">
        <label for="id" class="block text-gray-700 text-sm font-bold mb-2">ID del Proyecto *</label>
        <input
          id="id"
          v-model="form.id"
          type="text"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        >
        <p v-if="form.errors.id" class="text-red-500 text-xs italic">{{ form.errors.id }}</p>
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
          href="/projects" 
          class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
        >
          Cancelar
        </Link>
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          :disabled="form.processing"
        >
          Guardar Proyecto
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const form = useForm({
  id: '',
  name: '',
});

const submit = () => {
  form.post('/projects');
};
</script>