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
        // Get subscriptions
        $subscriptions = $entityManager->getRepository(Subscription::class)->findAll();

        // Get active subscription
        $subscription = $this->getUser()->getSubscription()->getTitle();

        return $this->render('subscription/index.html.twig', [
            'controller_name' => 'SubscriptionController',
            'subscriptions' => $subscriptions,
            'activeSubscription' => $subscription
        ]);
    }

    #[Route('/subscription/change/{id}', name: 'app_subscription_change')]
    public function change(Subscription $subscription, EntityManagerInterface $entityManager): Response
    {
        //change subscription
        $user = $this->getUser();
        $user->setSubscription($subscription);
        $entityManager->flush();

        notyf()->addSuccess('Subscription changed.');

        return $this->redirectToRoute('app_subscription');
    }

}
