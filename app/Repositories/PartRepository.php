<?php

namespace App\Repositories;

use App\Models\Part;

class PartRepository
{
    protected $model;

    public function __construct(Part $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with(['block', 'registeredBy', 'block.project'])->get();
    }

    public function find($id)
    {
        return $this->model->with(['block', 'registeredBy'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $part = $this->find($id);
        $part->update($data);
        return $part;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function getByBlock($blockId)
    {
        return $this->model->where('block_id', $blockId)->get();
    }

    public function getPending()
    {
        return $this->model->where('status', 'Pendiente')->get();
    }

    public function getPendingByProject($projectId)
    {
        return $this->model->whereHas('block', function($query) use ($projectId) {
            $query->where('project_id', $projectId);
        })->where('status', 'Pendiente')->get();
    }
}