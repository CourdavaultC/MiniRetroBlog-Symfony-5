<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Form\ArticlesType;
use App\Form\CategoriesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 * @package APP\Controller
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/categories/ajout", name="categories_ajout")
     */
    public function ajoutCategorie(Request $request)
    {
        $categorie = new Categories;

        $form = $this->createForm(CategoriesType::class, $categorie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/categories/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/articles/ajout", name="admin_articles_ajout")
     */
    public function ajoutArticle(Request $request): Response
    {
        $article = new Articles;

        $form = $this->createForm(ArticlesType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $article->setUsers($this->getUser());
            $article->setActive(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/articles/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
