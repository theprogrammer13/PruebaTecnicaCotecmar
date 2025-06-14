<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Services\ProjectService;
use Inertia\Inertia;

class ProjectController extends Controller
{
    protected $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $projects = $this->service->getAllProjects();
        return Inertia::render('Projects/Index', [
            'projects' => $projects,
            'status' => session('status'),
        ]);
    }

    public function create()
    {
        return Inertia::render('Projects/Create');
    }

    public function store(StoreProjectRequest $request)
    {
        $this->service->createProject($request->validated());
        return redirect()->route('projects.index')->with('status', 'Proyecto creado exitosamente');
    }

    public function show(string $id)
    {
        $project = $this->service->getProject($id);
        return Inertia::render('Projects/Show', [
            'project' => $project,
        ]);
    }

    public function edit(string $id)
    {
        $project = $this->service->getProject($id);
        return Inertia::render('Projects/Edit', [
            'project' => $project,
        ]);
    }

    public function update(UpdateProjectRequest $request, string $id)
    {
        $this->service->updateProject($id, $request->validated());
        return redirect()->route('projects.index')->with('status', 'Proyecto actualizado exitosamente');
    }

    public function destroy(string $id)
    {
        $this->service->deleteProject($id);
        return redirect()->route('projects.index')->with('status', 'Proyecto eliminado exitosamente');
    }
}