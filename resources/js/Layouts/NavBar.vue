<template>
  <GuestLayout>
    <nav class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <div class="flex-shrink-0 flex items-center">
              <h1 class="text-lg font-bold text-gray-800">Sistema de Fabricación</h1>
            </div>
            <!-- Mostrar enlaces solo si está autenticado -->
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
              <Link 
                href="/reports" 
                class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
                :class="{ 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': !$page.url.startsWith('/reports') }"
              >
                Reportes
              </Link>
              <Link 
                href="/projects" 
                class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
                :class="{ 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': !$page.url.startsWith('/projects') }"
              >
                Proyectos
              </Link>
              <Link 
                href="/blocks" 
                class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
                :class="{ 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': !$page.url.startsWith('/blocks') }"
              >
                Bloques
              </Link>
              <Link 
                href="/parts" 
                class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
                :class="{ 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': !$page.url.startsWith('/parts') }"
              >
                Piezas
              </Link>
            </div>
          </div>
          <!-- Mostrar botón de logout solo si está autenticado -->
          <div v-if="$page.props.auth.user" class="hidden sm:ml-6 sm:flex sm:items-center">
            <div class="mr-4 text-sm text-gray-700">
              Bienvenido, {{ $page.props.auth.user.name }}
            </div>
            <form @submit.prevent="logout">
              <button 
                type="submit"
                class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium"
              >
                Cerrar sesión
              </button>
            </form>
          </div>

        </div>
      </div>
    </nav>
  </GuestLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

const logout = () => {
    router.post('/logout', {}, {
        preserveScroll: true,
        onFinish: () => {
            // Esto asegura que los props se actualicen con el nuevo estado auth.user = null
            router.reload();
        },
    });
}
</script>

<style scoped>
.router-link-active {
  @apply border-blue-500 text-gray-900;
}
</style>