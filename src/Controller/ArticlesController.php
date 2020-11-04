<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/articles", name="articles_")
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/details/{slug}", name="details")
     */
    public function details($slug, ArticlesRepository $articlesRepository): Response
    {
        $article = $articlesRepository->findOneBy(['slug' => $slug]);

        if(!$article){
            throw new NotFoundHttpException('Pas d\'article trouvé');
        }

        return $this->render('admin/articles/details.html.twig', compact('article'));
    }
}
