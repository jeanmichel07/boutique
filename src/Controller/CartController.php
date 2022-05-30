<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CartController
 * @package App\Controller
 * @Route("/cart")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="cart")
     * @param SessionInterface $session
     * @param ProduitRepository $repository
     * @return Response
     */
    public function index(SessionInterface $session, ProduitRepository $repository): Response
    {
        $panier = $session->get("panier", []);
        $dataPanier = [];
        $total = 00.00;

        foreach ($panier as $id => $qtt){
            $prod = $repository->find($id);
            $dataPanier[]= [
                "produit" => $prod,
                "quantite" =>$qtt
            ];
            $total += $prod->getPrix() * $qtt;
        }
        return $this->render('cart/index.html.twig', compact("dataPanier","total"));
    }

    /**
     * @Route("/add/{id}", name="add")
     * @param Produit $produit
     * @param SessionInterface $session
     * @return JsonResponse
     */
    public function add(Produit $produit, SessionInterface $session){
        $panier = $session->get("panier", []);
        $id = $produit->getId();
        if(!empty($panier[$id])){
            $panier[$id]+= 1;
        }else{
            $panier[$id] = 1;
        }
        $session->set("panier", $panier);
        $message = ['message' => 'bien ajoute'];
        return new JsonResponse($panier);
    }
    /**
     * @Route("/remove/{id}", name="remove")
     * @param Produit $produit
     * @param SessionInterface $session
     * @return JsonResponse
     */
    public function remove(Produit $produit, SessionInterface $session){
        $panier = $session->get("panier", []);
        $id = $produit->getId();
        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]-= 1;
            }else{
                unset($panier[$id]);
            }
        }
        $session->set("panier", $panier);
        $message = ['message' => 'bien ajoute'];
        return new JsonResponse($message);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Produit $produit
     * @param SessionInterface $session
     * @return JsonResponse
     */
    public function delete(Produit $produit, SessionInterface $session){
        $panier = $session->get("panier", []);
        $id = $produit->getId();
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $session->set("panier", $panier);
        $message = ['message' => 'bien ajoute'];
        return $this->redirectToRoute('cart');
    }
}
