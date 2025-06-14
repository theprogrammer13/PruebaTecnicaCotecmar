<?php

namespace App\Repositories;

use App\Models\Block;

class BlockRepository
{
    protected $model;

    public function __construct(Block $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getByProject($projectId)
    {
        return $this->model->where('project_id', $projectId)->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $block = $this->find($id);
        $block->update($data);
        return $block;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}