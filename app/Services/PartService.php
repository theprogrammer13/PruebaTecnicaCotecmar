<?php

namespace App\Services;

use App\Repositories\PartRepository;

class PartService
{
    protected $partRepository;

    public function __construct(PartRepository $partRepository)
    {
        $this->partRepository = $partRepository;
    }

    public function getAllParts()
    {
        return $this->partRepository->all();
    }

    public function getPartById($id)
    {
        return $this->partRepository->find($id);
    }

    public function createPart(array $data)
    {
        $data['status'] = 'Fabricado';
        $data['registration_date'] = now();
        return $this->partRepository->create($data);
    }

    public function updatePart($id, array $data)
    {
        return $this->partRepository->update($id, $data);
    }

    public function deletePart($id)
    {
        return $this->partRepository->delete($id);
    }

    public function getPartsByBlock($blockId)
    {
        return $this->partRepository->getByBlock($blockId);
    }

    public function getPendingParts()
    {
        return $this->partRepository->getPending();
    }
}