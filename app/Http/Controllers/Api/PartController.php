<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartRequest;
use App\Http\Requests\UpdatePartRequest;
use App\Services\PartService;
use App\Services\BlockService;
use App\Services\ProjectService;
use Inertia\Inertia;

class PartController extends Controller
{
    protected $partService;
    protected $blockService;
    protected $projectService;

    public function __construct(
        PartService $partService, 
        BlockService $blockService, 
        ProjectService $projectService
    )
    {
        $this->partService = $partService;
        $this->blockService=$blockService;
        $this->projectService=$projectService;
    }

    public function index()
    {
        $parts = $this->partService->getAllParts();
        return Inertia::render('Parts/Index', [
            'parts' => $parts,
            'status' => session('status'),
        ]);
    }

    public function create()
    {
        $projects = $this->projectService->getAllProjects();
        $blocks=$this->blockService->getAllBlocks();
        
        return Inertia::render('Parts/Create', [
            'projects' => $projects,
            'blocks' => $blocks
        ]);
    }

    public function store(StorePartRequest $request)
    {
        $this->partService->createPart($request->validated());
        return redirect()->route('parts.index')->with('status', 'Parte creada exitosamente');
    }

    // En el método show del PartController
    public function show(string $id)
    {
        $part = $this->partService->getPartById($id);
        
        // Cargar relación con el usuario que registró
        $part->load('registeredBy');
        
        return Inertia::render('Parts/Show', [
            'part' => $part,
        ]);
    }

    public function edit(string $id)
    {
        $part = $this->partService->getPartById($id);
        $blocks=$this->blockService->getAllBlocks();
        $projects = $this->projectService->getAllProjects();
        return Inertia::render('Parts/Edit', [
            'part' => $part,
            "projects"=>$projects,
            "blocks"=>$blocks
        ]);
    }

    public function update(UpdatePartRequest $request, string $id)
    {
        $this->partService->updatePart($id, $request->validated());
        return redirect()->route('parts.index')->with('status', 'Parte actualizada exitosamente');
    }

    public function destroy(string $id)
    {
        $this->partService->deletePart($id);
        return redirect()->route('parts.index')->with('status', 'Parte eliminada exitosamente');
    }

    public function getPartsByBlock(string $blockId)
    {
        $parts = $this->partService->getPartsByBlock($blockId);
        return Inertia::render('Parts/ByBlock', [
            'parts' => $parts,
            'blockId' => $blockId,
        ]);
    }
}