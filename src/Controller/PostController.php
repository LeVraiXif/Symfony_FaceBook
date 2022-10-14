<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class PostController extends AbstractController
{
    #[Route('/post/{id}', name: 'app_post')]
    public function index(Environment $twig, Post $post): Response
    {
        return $this->render('post/card.html.twig', [
            'post' => $post
        ]);
    }
}
