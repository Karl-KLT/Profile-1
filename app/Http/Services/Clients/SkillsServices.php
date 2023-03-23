<?php

namespace App\Http\Services\Clients;

use App\Repositories\Clients\SkillsRepository;

class SkillsServices
{
    protected $SkillsRepository;

    public function __construct(SkillsRepository $SkillsRepository)
    {
        $this->SkillsRepository = $SkillsRepository;
    }

    public function getList()
    {
        return $this->SkillsRepository->getList();
    }

    public function updateOrCreate()
    {
        return $this->SkillsRepository->updateOrCreate();
    }


}
