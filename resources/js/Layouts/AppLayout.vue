<template>
  <div>
    <Navbar />
    <main class="py-6">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <slot />
      </div>
    </main>
  </div>
</template>

<script setup>
import Navbar from './Navbar.vue';
</script>