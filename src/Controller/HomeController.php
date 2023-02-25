<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Product::class)->findAll();

        return $this->render('home/index.html.twig', [
            'products' => $products,
        ]);

    }

    #[Route('/charte-donnees-personnelles', name: 'charte-donnee-perso')]
    public function chart_donnees_personnel()
    {

        return $this->render('chartedonnees/charte_donnees.html.twig', []);
    }

    #[Route('/cgv', name: 'cgv')]
    public function condition_general_vente()
    {

        return $this->render('CGV/cgv.html.twig', []);
    }
}
