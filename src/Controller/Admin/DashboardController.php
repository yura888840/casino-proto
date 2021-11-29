<?php

namespace App\Controller\Admin;

use App\Entity\Casino;
use App\Entity\CasinoRating;
use App\Entity\FormFieldReference;
use App\Entity\Page;
use App\Entity\Post;
use App\Entity\Tag;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Site Management');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('To main page', 'fas fa-angle-double-right', 'main', ['page' => 1, '_format' => 'html']);
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Resources');
        yield MenuItem::linkToCrud('Pages', 'fa fa-file', Page::class);
        yield MenuItem::linkToCrud('Casinos', 'fa fa-list', Casino::class);
        yield MenuItem::linkToCrud('Ratings Management', 'fa fa-star', CasinoRating::class);
//        yield MenuItem::subMenu('experimental', 'fa fa-flask')
//            ->setSubItems(
//                [
//                    MenuItem::linkToCrud('Casino Features', null, Feature::class),
//                    MenuItem::linkToCrud('Rates', null, RatingsRate::class)
//                ]
//            );
        yield MenuItem::linkToCrud('Posts / News pages', 'fa fa-file-text-o', Post::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tags', Tag::class);

        yield MenuItem::section('Settings');
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class);
        yield MenuItem::section('Logout');
        yield MenuItem::linkToLogout('Logout', 'fa fa-sign-out');
        yield MenuItem::section('Development');
        yield MenuItem::linkToCrud('Form Field Reference', 'far fa-file-code', FormFieldReference::class)->setAction(Action::NEW);

        //yield MenuItem::linkToCrud('Comments', 'far fa-comments', Comment::class);
    }
}
