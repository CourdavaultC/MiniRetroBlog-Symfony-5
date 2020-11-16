<?php

namespace App\Controller;

use App\Entity\ConsolesMinis;
use App\Entity\ImagesConsolesMini;
use App\Form\ConsolesMinisType;
use App\Repository\ConsolesMinisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/consoles_minis")
 */
class ConsolesMinisController extends AbstractController
{
    /**
     * @Route("/", name="consoles_minis_index", methods={"GET"})
     */
    public function index(ConsolesMinisRepository $consolesMinisRepository): Response
    {
        return $this->render('consoles_minis/index.html.twig', [
            'consoles_minis' => $consolesMinisRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="consoles_minis_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $consolesMini = new ConsolesMinis();
        $form = $this->createForm(ConsolesMinisType::class, $consolesMini);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagesConsolesMinis = $form->get('images_consoles_minis')->getData();

            foreach($imagesConsolesMinis as $image){
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                $img = new ImagesConsolesMini();
                $img->setName($fichier);
                $consolesMini->addImagesConsolesMini($img);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consolesMini);
            $entityManager->flush();

            return $this->redirectToRoute('consoles_minis_index');
        }

        return $this->render('consoles_minis/new.html.twig', [
            'consoles_mini' => $consolesMini,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consoles_minis_show", methods={"GET"})
     */
    public function show(ConsolesMinis $consolesMini): Response
    {
        return $this->render('consoles_minis/show.html.twig', [
            'consoles_mini' => $consolesMini,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="consoles_minis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ConsolesMinis $consolesMini): Response
    {
        $form = $this->createForm(ConsolesMinisType::class, $consolesMini);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imagesConsolesMinis = $form->get('images_consoles_minis')->getData();

            foreach($imagesConsolesMinis as $image){
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                $img = new ImagesConsolesMini();
                $img->setName($fichier);
                $consolesMini->addImagesConsolesMini($img);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('consoles_minis_index');
        }

        return $this->render('consoles_minis/edit.html.twig', [
            'consoles_mini' => $consolesMini,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consoles_minis_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ConsolesMinis $consolesMini): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consolesMini->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($consolesMini);
            $entityManager->flush();
        }

        return $this->redirectToRoute('consoles_minis_index');
    }

    /**
     * @Route("/supprime/image/{id}", name="consoles_minis_delete_image", methods={"DELETE"})
     */
    public function deleteImage(ImagesConsolesMini $imagesConsolesMini, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if($this->isCsrfTokenValid('delete'.$imagesConsolesMini->getId(), $data['_token'])){
            $name = $imagesConsolesMini->getName();
            unlink($this->getParameter('images_directory').'/'.$name);

            $em = $this->getDoctrine()->getManager();
            $em->remove($imagesConsolesMini);
            $em->flush();

            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }
}
