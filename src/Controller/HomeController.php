<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    #[Route("/")]
    public function index() {
        $now = new \DateTime();
        return new Response($now->format('Y-m-d H:i:s') );
    }
}