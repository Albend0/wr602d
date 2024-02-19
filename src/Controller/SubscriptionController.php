<?php

namespace App\Controller;

use App\Entity\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionController extends AbstractController
{
    #[Route('/subscription', name: 'app_subscription')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        //get subscriptions
        $subscriptions = $entityManager->getRepository(Subscription::class)
        ->findAll();

        return $this->render('subscription/index.html.twig', [
            'controller_name' => 'SubscriptionController',
            'subscriptions' => $subscriptions
        ]);
    }
    #[Route('/subscription/change/{id}', name: 'app_subscription_change')]
    public function change(Subscription $subscription, EntityManagerInterface $entityManager): Response
    {
        //change subscription
        $user = $this->getUser();
        $user->setSubscription($subscription);
        $entityManager->flush();

        return $this->redirectToRoute('app_homepage');
    }

}
