<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_app")
     */
    public function index(): Response
    {
        if($this->getUser()){
            if($this->getUser()->getRoles() == ["ROLE_ADMIN"]){
                return $this->redirectToRoute('dasboard');
            }else{
                return $this->render('app/index.html.twig', [
                    'controller_name' => 'AppController',
                ]);
            }
        }else{
            return $this->render('app/index.html.twig', [
                'controller_name' => 'AppController',
            ]);
        }
    }
}
