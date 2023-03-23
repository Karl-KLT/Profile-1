<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Clients\SkillsServices;
class SkillsController extends Controller
{
    protected $SkillsServices;

    public function __construct(SkillsServices $SkillsServices)
    {
        $this->SkillsServices = $SkillsServices;
    }

    public function getList()
    {
        return $this->SkillsServices->getList();
    }

    public function updateOrCreate()
    {
        return $this->SkillsServices->updateOrCreate();
    }
}
