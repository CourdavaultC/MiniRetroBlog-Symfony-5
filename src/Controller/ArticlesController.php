<?php

namespace App\Controller;

use App\Entity\Articles;
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
