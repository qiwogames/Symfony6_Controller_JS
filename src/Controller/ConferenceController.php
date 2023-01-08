<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController
{
    #[Route('/conference', name: 'app_conference')]
    public function index(Request $request): Response
    {
        $bienvenue = sprintf("<h2>SALUT LES GARS %s!</h2>", htmlspecialchars(""));

        return $this->render('conference/index.html.twig', [
            'controller_name' => 'ConferenceController',
            'bienvenue' => $bienvenue
        ]);
    }
}
