<?php

namespace App\Controller\Admin;

use App\Entity\Casino;
use App\Entity\CasinoRating;
use App\Entity\Feature;
use App\Entity\Page;
use App\Entity\RatingsRate;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Casino Rates');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('To main page', 'fa fa-running', 'main');
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Pages', null, Page::class);
        yield MenuItem::linkToCrud('Casinos', null, Casino::class);
        yield MenuItem::linkToCrud('Ratings Management', null, CasinoRating::class);
        yield MenuItem::subMenu('experimental', 'fa fa-flask')
            ->setSubItems(
                [
                    MenuItem::linkToCrud('Casino Features', null, Feature::class),
                    MenuItem::linkToCrud('Rates', null, RatingsRate::class)
                ]
            );
        yield MenuItem::linkToLogout('Logout', 'fa fa-sign-out');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
