<?php

namespace App\Controller\ModelManagerController;

use App\Repository\ModelManagerAdapter\ModelManagerAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModelManagerController extends AbstractController
{

    protected $modelManagerAdapter;

    public function __construct(ModelManagerAdapter $modelManagerAdapter)
    {
        $this->modelManagerAdapter = $modelManagerAdapter;
    }

}
