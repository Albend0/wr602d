<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        //get username
        $username = $this->getUser()->getFirstname();
        $lastname = $this->getUser()->getLastname();
        $subscription = $this->getUser()->getSubscription()->getTitle();

        // get all pdf by user to render in a foreach loop
        $user = $this->getUser();
        $pdfs = $user->getPdf();

        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'username' => $username,
            'lastname' => $lastname,
            'subscription' => $subscription,
            'pdfs' => $pdfs,
        ]);
    }
}
