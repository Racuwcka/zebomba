<?php

namespace App\Http\Controllers;

use App\Service\UserAuthService;
use Illuminate\Routing\Controller as BaseController;

class MainController extends BaseController
{
    public $service;

    public function __construct(UserAuthService $service)
    {
        $this->service = $service;
    }
}
