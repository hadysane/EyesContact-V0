<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\MailerService;
use Symfony\Component\HttpFoundation\Request;
use App\Form\OrderType;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(Request $request, MailerService $mailer): Response
    {
        $form = $this->createForm(OrderType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $orderFormData = $form->getData();

            $subject = 'Confirmation de votre commande à l adresse : ' . $orderFormData['home_street'];
            
            $content = '<br> <br>Informations : ' . '<b>' . $orderFormData['city'] . ' '  . $orderFormData['postal_code'] . '</b>'. '<br> <br>'. 
            '' . $orderFormData['pays'] . '<br> <br>'.$orderFormData['number_card'] . '<br> <br>'.$orderFormData['secure_numb'] . '<br> <br>'.$orderFormData['date_expire'];

            
            $mailer->sendEmail(
                subject: $subject, 
                content: $content
            );

            $this->addFlash('success', 'Votre commande bien été pris en compte.');
            return $this->redirectToRoute('app_order');
        }
        return $this->render('order/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
