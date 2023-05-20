<?php

namespace App\Controller;

use App\Services\SteamApiServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class HomeController extends AbstractController
{
    /**
     *
     * @Route("/home", name="app_home")
     */
    public function index(SteamApiServices $steamServices): Response
    {


        $user = $this->getUser();
        if(empty($user)) {
            return  $this->redirectToRoute('app_login');

        }

        $steam_user = $steamServices->GetPlayerSummariesV2($user->getUserIdentifier());

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            "avatar"=>$steam_user["avatar"],
            "pseudo"=>$steam_user["personaname"],
            "profile"=> $steam_user["profileurl"]

        ]);
    }
}
