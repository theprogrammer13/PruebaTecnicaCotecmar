<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlockRequest;
use App\Http\Requests\UpdateBlockRequest;
use App\Services\BlockService;
use App\Services\ProjectService;
use Inertia\Inertia;

class BlockController extends Controller
{
    protected $blockService;
    protected $projectService;

    public function __construct(BlockService $blockService, ProjectService $projectService)
    {
        $this->service = $blockService;
        $this->projectService=$projectService;
    }

    public function index()
    {
        $blocks = $this->service->getAllBlocks();
        return Inertia::render('Blocks/Index', [
            'blocks' => $blocks,
            'status' => session('status'),
        ]);
    }

    public function create()
    {
        $projects = $this->projectService->getAllProjects();
        return Inertia::render('Blocks/Create', [
            'projects' => $projects
        ]);
    }

    public function store(StoreBlockRequest $request)
    {
        $this->service->createBlock($request->validated());
        return redirect()->route('blocks.index')->with('status', 'Bloque creado exitosamente');
    }

    public function show(string $id)
    {
        $block = $this->service->getBlock($id);
        return Inertia::render('Blocks/Show', [
            'block' => $block,
        ]);
    }

    public function edit(string $id)
    {
        $block = $this->service->getBlock($id);
        $projects = $this->projectService->getAllProjects();
        return Inertia::render('Blocks/Edit', [
            'block' => $block,
            'projects'=>$projects
        ]);
    }

    public function update(UpdateBlockRequest $request, string $id)
    {
        $this->service->updateBlock($id, $request->validated());
        return redirect()->route('blocks.index')->with('status', 'Bloque actualizado exitosamente');
    }

    public function destroy(string $id)
    {
        $this->service->deleteBlock($id);
        return redirect()->route('blocks.index')->with('status', 'Bloque eliminado exitosamente');
    }

    public function getByProject(string $projectId)
    {
        $blocks = $this->service->getBlocksByProject($projectId);
        return Inertia::render('Blocks/ByProject', [
            'blocks' => $blocks,
            'projectId' => $projectId,
        ]);
    }
}