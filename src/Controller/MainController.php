<?php

namespace App\Controller;

use App\Form\SearchArticleType;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(ArticlesRepository $articlesRepository, Request $request): Response
    {
        $articles = $articlesRepository->findBy(['active' => true], ['created_at' => 'desc'], 5);

        $form = $this->createForm(SearchArticleType::class);

        $search = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // On recherche les articles correspondant aux mots-clés
            $articles = $articlesRepository->search(
                $search->get('words')->getData(),
                $search->get('categorie')->getData()
            );
        }

        return $this->render('main/index.html.twig', [
            'articles' => $articles,
            'form' => $form->createView()
        ]);
    }
}
