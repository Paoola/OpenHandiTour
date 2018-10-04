<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Routing\ExtraLoader;

class PartnerController extends AbstractController
{
    public function extra($parameter)
    {
        return new Response($parameter);
    }
}

