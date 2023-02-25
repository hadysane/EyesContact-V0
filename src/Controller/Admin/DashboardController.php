<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\ColorAttribute;
use App\Entity\Product;
use App\Entity\Variation;
use App\Entity\Order;
use App\Entity\Supplier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Controller\HomeController;
use App\Entity\Contact;

class DashboardController extends AbstractDashboardController
{


    public function __construct(private AdminUrlGenerator $adminUrlGenerator )
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl();
       return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EyesContact Admin');
    }

    // public function configureHomeController(): HomeController
    // {
    //     return HomeController::new()
    //         ->setsubTitle('Home');
    // }

    public function configureMenuItems(): iterable
    {
        // Menu du dashboard
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToRoute('Aller à la boutique ', 'fa-solid fa-store', 'app_home');
        yield MenuItem::section(); 

        yield MenuItem::linkToCrud('Catégorie', 'fa-solid fa-tags', Category::class);

        yield MenuItem::section('Gestions de commandes');
        yield MenuItem::linkToCrud('Commandes', 'fa-solid fa-receipt', Order::class);

        yield MenuItem::section('Gestions de fournisseurs');
        yield MenuItem::linkToCrud('Fournisseurs ', 'fa-solid fa-truck', Supplier::class);

        yield MenuItem::section('Gestions de produits');
        yield MenuItem::linkToCrud('Produits', 'fa-solid fa-shirt', Product::class);
        yield MenuItem::linkToCrud('Variations de produit', 'fas fa-list', Variation::class);
        yield MenuItem::linkToCrud('Attributs Couleurs', 'fa-solid fa-palette', ColorAttribute::class);

        yield MenuItem::section('Gestions d\'utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-users', User::class);
        yield MenuItem::linkToCrud('Adresses des utilisateurs', 'fa-solid fa-location-dot', Address::class);

        yield MenuItem::section('Messagerie');
        yield MenuItem::linkToCrud('Contact', 'fa-regular fa-envelope', Contact::class);
    }
}
