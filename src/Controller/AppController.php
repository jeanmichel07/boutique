<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\CategorieRepository;
use App\Repository\GallerieRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{

    /**
     * @var ProduitRepository
     */
    private $produitRepository;
    /**
     * @var CategorieRepository
     */
    private $categorieRepository;
    /**
     * @var GallerieRepository
     */
    private $gallerieRepository;

    public function __construct(ProduitRepository $produitRepository,CategorieRepository $categorieRepository,GallerieRepository $gallerieRepository)
    {
        $this->produitRepository = $produitRepository;
        $this->categorieRepository = $categorieRepository;
        $this->gallerieRepository = $gallerieRepository;
    }

    /**
     * @Route("/", name="app_app")
     */
    public function index(Request $request): Response
    {


        if($this->getUser()) {
            if ($this->getUser()->getRoles() == ["ROLE_ADMIN"]) {
                return $this->redirectToRoute('dasboard');

            } else {

                $nomCateg = ($request->get('categ'));

                if ($nomCateg) {
                    $oneCateg = $this->categorieRepository->findByNom($nomCateg);
                    $produits = $this->produitRepository->findByCategorie($oneCateg);
                    $categories = $this->categorieRepository->findBy(["status" => 1]);
                } else {
                    $produits = $this->produitRepository->findAll();
                    $categories = $this->categorieRepository->findBy(["status" => 1]);
                }

                return $this->render('app/index.html.twig', [
                    'controller_name' => 'AppController',
                    'produits' => $produits,
                    'categories' => $categories,
                    'nomCateg' => $nomCateg
                ]);
            }
        }
    }

    /**
     * @Route("/details/{id}", name="produit_details")
     */
    public function details(Produit $produit): Response
    {
        $galleries = $this->gallerieRepository->findByProduit($produit);

        return $this->renderForm('admin/produit/details.html.twig', [
            'produit' => $produit,
            'galeries' => $galleries,
        ]);
    }
}
