<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Repository\CommentaireRepository;
use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController
{
    #[Route('/conference', name: 'app_conference')]
    public function index(ConferenceRepository $conferenceRepository): Response
    {
        return $this->render('conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll()
        ]);
    }

    //Une conférence => details
    #[Route('/conference/${id}', name: 'app_conference_details')]
    public  function detailsConference(Request $request, Conference $conference, CommentaireRepository $commentaireRepository):Response{

        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $commentaireRepository->getCommentairePagination($conference, $offset);

        return $this->render('conference/details-conference.html.twig',[
            'conference' => $conference,
            'commentaires' => $paginator,
            'precedent' => $offset - CommentaireRepository::COMMENTAIRE_PAR_PAGE,
            'suivant' => min(count($paginator), $offset + CommentaireRepository::COMMENTAIRE_PAR_PAGE)

        ]);
    }
}
