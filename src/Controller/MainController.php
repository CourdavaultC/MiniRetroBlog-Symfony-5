<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(ArticlesRepository $articlesRepo): Response
    {
        return $this->render('main/index.html.twig', [
            'articles' => $articlesRepo->findBy(['active' => true], ['created_at' => 'desc']),
        ]);
    }
}
