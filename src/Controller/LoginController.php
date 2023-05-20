<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        if(!empty($user)) {
            return  $this->redirectToRoute('app_home');

        }



        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }


        /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): Response
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }


}
