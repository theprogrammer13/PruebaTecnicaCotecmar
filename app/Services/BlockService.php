<?php

namespace App\Services;

use App\Repositories\BlockRepository;

class BlockService
{
    protected $repository;

    public function __construct(BlockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllBlocks()
    {
        return $this->repository->all();
    }

    public function getBlock(string $id)
    {
        return $this->repository->find($id);
    }

    public function getBlocksByProject(string $projectId)
    {
        return $this->repository->getByProject($projectId);
    }

    public function createBlock(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateBlock(string $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteBlock(string $id)
    {
        return $this->repository->delete($id);
    }
}