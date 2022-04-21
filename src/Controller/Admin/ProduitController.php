<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/produit")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="app_produit_index", methods={"GET"})
     */
    public function index(ProduitRepository $produitRepository): Response
    {

        return $this->render('admin/produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_produit_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProduitRepository $produitRepository): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if(isset($_FILES['img']) && ($_FILES['img']['name'])){
                $produit->setStatus(true);
                $errors= array();
                $file_name = $_FILES['img']['name'];
                $file_size =$_FILES['img']['size'];
                $file_tmp =$_FILES['img']['tmp_name'];
                $file_type=$_FILES['img']['type'];
                $file_ext=strtolower(explode('.',$_FILES['img']['name'])[1]);
                $extensions= array("jpeg","jpg","png");
                if(in_array($file_ext,$extensions)=== false){
                    $errors[]="extension non supporté";
                }
                if($file_size > 4097152){
                    $errors[]='File size must be excately 4 MB';
                }
                if(empty($errors)==true){
                    move_uploaded_file($file_tmp,"assets/produits/".$file_name);
                    $produit->setImage($file_name);
                    $produitRepository->add($produit);
                    return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
                }else{
                    print_r($errors);
                }
            }
        }
        return $this->renderForm('admin/produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_produit_show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('admin/produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_produit_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(isset($_FILES['img']) and $_FILES['img']["name"] !== ""){
                $errors= array();
                $file_name = $_FILES['img']['name'];
                $file_size =$_FILES['img']['size'];
                $file_tmp =$_FILES['img']['tmp_name'];
                $file_type=$_FILES['img']['type'];
                $file_ext=strtolower(explode('.',$_FILES['img']['name'])[1]);
                $extensions= array("jpeg","jpg","png");
                if(in_array($file_ext,$extensions)=== false){
                    $errors[]="extension non supporté";
                }
                if($file_size > 4097152){
                    $errors[]='File size must be excately 4 MB';
                }
                if(empty($errors)==true){
                    move_uploaded_file($file_tmp,"assets/produits/".$file_name);
                    $produit->setImage($file_name);
                }else{
                    print_r($errors);
                }
            }
            $produitRepository->add($produit);
            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_produit_delete", methods={"POST"})
     */
    public function delete(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $produitRepository->remove($produit);
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
