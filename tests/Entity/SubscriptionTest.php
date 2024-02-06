<?php

namespace App\Tests\Entity;

use App\Entity\Subscription;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    public function testGetterAndSetter()
    {
        $subscription = new Subscription();

        // Définition de données de test
        $title = 'title';
        $description = 'description';
        $price = 10.5;
        $media = 'media';
        $pdfLimit = 5;


        // Utilisation des setters
        $subscription->setTitle($title);
        $subscription->setDescription($description);
        $subscription->setPrice($price);
        $subscription->setMedia($media);
        $subscription->setPdfLimit($pdfLimit);

        // Vérification des getters
        $this->assertEquals($title, $subscription->getTitle());
        $this->assertEquals($description, $subscription->getDescription());
        $this->assertEquals($price, $subscription->getPrice());
        $this->assertEquals($media, $subscription->getMedia());
        $this->assertEquals($pdfLimit, $subscription->getPdfLimit());

    }
}