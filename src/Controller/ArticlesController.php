<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/articles", name="articles_")
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="list")
     * @return void
     */
    public function index(ArticlesRepository $articlesRepository, Request $request){
        // On définit le nombre d'éléments par page
        $limit = 2;

        // On récupère le numéro de la page
        $page = (int)$request->query->get("page", 1);

        // On récupère les articles de la page
        $articles = $articlesRepository->getPaginatedArticles($page, $limit);

        // On récupère le nombre total d'articles
        $total = $articlesRepository->getTotalArticles();

        return $this->render('articles/listall.html.twig', compact('articles', 'total', 'limit', 'page'));
    }

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

    /**
     * @Route("/favoris/ajout/{id}", name="ajout_favoris")
     */
    public function ajoutFavoris(Articles $article): Response
    {
        if(!$article){
            throw new NotFoundHttpException('Pas d\'article trouvé');
        }
        $article->addFavori($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        return $this->redirectToRoute('app_home');
    }

    /**
     * @Route("/favoris/retrait/{id}", name="retrait_favoris")
     */
    public function retraitFavoris(Articles $article): Response
    {
        if(!$article){
            throw new NotFoundHttpException('Pas d\'article trouvé');
        }
        $article->removeFavori($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        return $this->redirectToRoute('app_home');
    }
}
