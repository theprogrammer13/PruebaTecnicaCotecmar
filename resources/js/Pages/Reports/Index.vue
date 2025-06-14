<script setup>
import ProjectStatusChart from '@/Components/ProjectStatusChart.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    pendingParts: {
        type: Array,
        default: () => []
    },
    statusData: {
        type: Array,
        default: () => []
    }
});
</script>

<template>

    

            <div class="container mx-auto px-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Reportes
                </h2>
            </div>


        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col gap-6">
                <!-- Reporte de partes pendientes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium mb-4">Partes Pendientes por Proyecto</h3>
                        
                        <div v-if="pendingParts.length > 0">
                            <div v-for="project in pendingParts" :key="`project-${project.id}`" class="mb-8">
                                <h4 class="font-semibold">
                                    {{ project.name }} - 
                                    <span class="text-red-500">
                                        {{ project.pending_parts_count }} partes pendientes
                                    </span>
                                </h4>
                                
                                <div v-for="block in project.blocks" :key="`block-${block.id}`" class="ml-4 mt-2">
                                    <h5 class="font-medium">{{ block.name }}</h5>
                                    <ul class="list-disc ml-6">
                                        <li v-for="part in block.pending_parts" :key="`part-${part.id}`" class="py-1">
                                            {{ part.name }} - 
                                            Peso teórico: {{ part.theoretical_weight }} kg -
                                            Creado: {{ part.created_at }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div v-else class="text-gray-500">
                            No hay partes pendientes
                        </div>
                    </div>
                </div>

                <!-- Reporte de estados -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium mb-4">Estado de Proyectos</h3>
                        <ProjectStatusChart :projects="statusData" />
                    </div>
                </div>
            </div>
        </div>

</template>