<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DashboardClientType;

class DashboardClientController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard_client')]
    public function index(Request $request): Response
    {
        // // $form = $this->createForm(DashboardClientType::class);
        // // $form->handleRequest($request);
        // // if ($form->isSubmitted() && $form->isValid()) {
            
           
        //     $this->addFlash('success', 'Vos données ont bien été enregistrés');
        //     return $this->redirectToRoute('app_dashboard_client');
        // }
        return $this->render('dashboard_client/index.html.twig', [
            // 'form' => $form->createView()
        ]);
    }
}
