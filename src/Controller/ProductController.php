<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    #[Route('/products', name: 'app_products')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Product::class)->findAll();

        return $this->render('home/index.html.twig', [
            'products' => $products,
        ]);
    }


    #[Route('/category/{id}', name: 'app_product')]
    public function showProductsByCategory(ManagerRegistry $doctrine, string $id): Response
    {
       
        $products = $doctrine->getRepository(Product::class)->findBy(["category" => $id]); 
        $category = $doctrine->getRepository(Category::class)->find($id);

        return $this->render('product/lunette-de-vue.html.twig', [
            'category' =>$category,
            'products' => $products,
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_single')]
    public function product_show(ManagerRegistry $doctrine, int $id): Response
    {
        $product = $doctrine->getRepository(Product::class)->find($id);

        $articles_similaire= $doctrine->getRepository(Product::class)->findBy(["category" => $id]);

        return $this->render('product/product.html.twig', [
            'product' => $product, 
            'articles_similaire' => $articles_similaire
        ]);
    }

    
}

