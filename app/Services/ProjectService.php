<?php

namespace App\Services;

use App\Repositories\ProjectRepository;

class ProjectService
{
    protected $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllProjects()
    {
        return $this->repository->all();
    }

    public function getProject(string $id)
    {
        return $this->repository->find($id);
    }

    public function createProject(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateProject(string $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteProject(string $id)
    {
        return $this->repository->delete($id);
    }
}