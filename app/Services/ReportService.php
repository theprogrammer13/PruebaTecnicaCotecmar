<?php

namespace App\Services;

use App\Repositories\PartRepository;
use App\Repositories\ProjectRepository;

use App\Models\Project;

class ReportService
{
    protected $partRepository;
    protected $projectRepository;

    public function __construct(
        PartRepository $partRepository,
        ProjectRepository $projectRepository
    ) {
        $this->partRepository = $partRepository;
        $this->projectRepository = $projectRepository;
    }

    public function getPendingPartsReport()
    {
       // Obtener proyectos con sus piezas pendientes
        $projectsWithPendingParts = Project::with(['blocks.parts' => function($query) {
            $query->where('status', 'Pendiente');
        }])
        ->whereHas('blocks.parts', function($query) {
            $query->where('status', 'Pendiente');
        })
        ->get()
        ->map(function($project) {
            return [
                'id' => $project->id,
                'name' => $project->name,
                'pending_parts_count' => $project->blocks->flatMap->parts->where('status', 'Pendiente')->count(),
                'blocks' => $project->blocks->map(function($block) {
                    return [
                        'id' => $block->id,
                        'name' => $block->name,
                        'pending_parts' => $block->parts->where('status', 'Pendiente')->map(function($part) {
                            return [
                                'id' => $part->id,
                                'name' => $part->name,
                                'theoretical_weight' => $part->theoretical_weight,
                                'created_at' => $part->created_at->format('Y-m-d H:i:s'),
                            ];
                        })->values()
                    ];
                })->reject(fn($block) => $block['pending_parts']->isEmpty())->values()
            ];
        });

        return $projectsWithPendingParts;
    }

    public function getProjectStatusReport()
    {
        // Obtener datos para el gráfico
        $projectsStatusData = Project::with(['blocks.parts'])
        ->get()
        ->map(function($project) {
            $parts = $project->blocks->flatMap->parts;
            
            return [
                'name' => $project->name,
                'pending' => $parts->where('status', 'Pendiente')->count(),
                'manufactured' => $parts->where('status', 'Fabricado')->count(),
                'total' => $parts->count()
            ];
        });

        return $projectsStatusData;
    }
}