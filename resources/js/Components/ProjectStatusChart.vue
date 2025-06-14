<script setup>
import { ref, onMounted } from 'vue';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

const props = defineProps({
    projects: Array,
});

const chartRef = ref(null);

onMounted(() => {
    const ctx = chartRef.value.getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: props.projects.map(p => p.name),
            datasets: [
                {
                    label: 'Partes Pendientes',
                    data: props.projects.map(p => p.pending),
                    backgroundColor: '#ef4444', // rojo
                },
                {
                    label: 'Partes Fabricadas',
                    data: props.projects.map(p => p.manufactured),
                    backgroundColor: '#22c55e', // verde
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                    beginAtZero: true
                }
            }
        }
    });
});
</script>

<template>
    <div class="p-4 bg-white rounded-lg shadow">
        <h3 class="text-lg font-medium mb-4">Estado de Partes por Proyecto</h3>
        <canvas ref="chartRef"></canvas>
    </div>
</template>