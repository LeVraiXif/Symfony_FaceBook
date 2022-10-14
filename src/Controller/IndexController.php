<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostingFormType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class IndexController extends AbstractController
{
    
    #[Route('/', name: 'app_index')]
    public function show(Request $request, Environment $twig, PostRepository $postRepository, EntityManagerInterface $entityManager): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $postRepository->getpostPaginator($offset);

        $post = new Post();
        $user = $this->getUser();
        $form = $this->createForm(PostingFormType::class, $post);
        $form->handleRequest($request);

        //var_dump($form->isSubmitted());
        //var_dump($form->isValid());
        //exit;
        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPublication($user->getPublication() + 1);
            $post->setUser($user);
            $entityManager->persist($post);
            $entityManager->persist($user);
            $entityManager->flush();
            
        }

        return new Response($twig->render('index/index.html.twig', [
            'posts' => $postRepository->findAll(),

            'posts' => $paginator,
            'previous' => $offset - PostRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + PostRepository::PAGINATOR_PER_PAGE),

            'PostingForm' => $form->createView(),
            ]));
           
            
    }
}
