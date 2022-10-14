<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController
{
    #[Route('/nav', name: 'app_nav')]
    public function index(): Response
    {
        return $this->render('nav/nav.html.twig', [
            'controller_name' => 'NavController',
        ]);
    }
}
