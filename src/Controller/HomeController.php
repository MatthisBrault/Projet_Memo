<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/hello/{prenom}", name="bonjour")
     */
    public function hello($prenom = "anonyme"){
        return $this->render(
            'hello.html.twig',
            [
                'prenom' => $prenom
            ]
        );
    }

    /**
     * @Route("/", name="homepage")
     */
    public function home(){
        $tab = ["Billy", "Bobby", "Barry"];

        return $this->render(
            'home.html.twig',
            [
                'idTask' => 1
            ]
        );
    }
}