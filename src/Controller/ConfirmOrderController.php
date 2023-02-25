<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmOrderController extends AbstractController
{
    #[Route('/confirm/order', name: 'app_confirm_order')]
    public function index(): Response
    {
        return $this->render('confirm_order/index.html.twig', [
            'controller_name' => 'ConfirmOrderController',
        ]);
    }
}
