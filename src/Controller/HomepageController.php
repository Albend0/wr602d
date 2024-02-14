<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Subscription;
use Symfony\Component\Security\Core\User\UserInterface;

class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'app_homepage')]
    public function index(UserInterface $username): Response
    {
        //get username
        $username = $this->getUser()->getFirstname();

        //get subscription
        $subscription = $this->getUser()->getSubscription()->getTitle();

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'username' => $username,
            'subscription' => $subscription
        ]);
    }
}
