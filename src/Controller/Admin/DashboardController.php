<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Entity\Commentaire;
use App\Entity\User;
use App\Controller\Admin\ProduitCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // return parent::index();
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ProduitCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Guestbook');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_product');
        yield MenuItem::linkToCrud('User', 'fas fa-comments', User::class);
        yield MenuItem::linkToCrud('Produit', 'fas fa-comments', Produit::class);
        yield MenuItem::linkToCrud('Comments', 'fas fa-comments', Commentaire::class);
    }
}