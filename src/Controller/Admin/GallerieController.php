<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Gallerie;
use App\Entity\Produit;
use App\Form\GallerieType;
use App\Repository\CategorieRepository;
use App\Repository\GallerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/gallerie")
 */
class GallerieController extends AbstractController
{


    /**
     * @var GallerieRepository
     */
    private $gallerieRepository;
    /**
     * @var Request
     */
    private $request;

    public function __construct(GallerieRepository $gallerieRepository)
    {

        $this->gallerieRepository = $gallerieRepository;

    }

    /**
     * @Route("/", name="app_gallerie_index", methods={"GET"})
     */
    public function index(GallerieRepository $gallerieRepository): Response
    {
        return $this->render('admin/gallerie/index.html.twig', [
            'galleries' => $gallerieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_gallerie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, GallerieRepository $gallerieRepository): Response
    {

        $gallerie = new Gallerie();
        $form = $this->createForm(GallerieType::class, $gallerie);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $gallerieRepository->add($gallerie);
            return $this->redirectToRoute('app_gallerie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/gallerie/new.html.twig', [
            'gallerie' => $gallerie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_gallerie_show", methods={"GET"})
     */
    public function show(Gallerie $gallerie): Response
    {
        return $this->render('admin/gallerie/show.html.twig', [
            'gallerie' => $gallerie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_gallerie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Gallerie $gallerie, GallerieRepository $gallerieRepository): Response
    {
        $form = $this->createForm(GallerieType::class, $gallerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gallerieRepository->add($gallerie);
            return $this->redirectToRoute('app_gallerie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/gallerie/edit.html.twig', [
            'gallerie' => $gallerie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_gallerie_delete", methods={"POST"})
     */
    public function delete(Request $request, Gallerie $gallerie, GallerieRepository $gallerieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $gallerie->getId(), $request->request->get('_token'))) {
            $gallerieRepository->remove($gallerie);
        }

        return $this->redirectToRoute('app_gallerie_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/gallerie", name="add_gallerie", methods={"POST"})
     */
    public function addImage(Produit $produit,Request $request)
    {
        $gallerie = new Gallerie();
        $form = $this->createForm(GallerieType::class, $gallerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('app_gallerie_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin/produit/show.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);

        }

}
