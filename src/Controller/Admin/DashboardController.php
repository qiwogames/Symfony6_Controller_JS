<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ConferenceCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Livre Or Sf6');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('ACCUEIL', 'fas fa-home', 'admin');
        yield MenuItem::linkToCrud('CONFERENCES', 'fas fa-map-marker-alt', Conference::class);
        yield MenuItem::linkToCrud('COMMENTAIRES', 'fas fa-comments', Commentaire::class);
    }
}
