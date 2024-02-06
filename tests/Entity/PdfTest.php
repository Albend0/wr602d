<?php

namespace App\Tests\Entity;

use App\Entity\Pdf;
use PHPUnit\Framework\TestCase;

class PdfTest extends TestCase
{
    public function testGetterAndSetter()
    {
        $pdf = new Pdf();

        // Définition de données de test
        $title = 'title';
        $createdAt = new \DateTimeImmutable();

        // Utilisation des setters
        $pdf->setTitle($title);
        $pdf->setCreatedAt($createdAt);

        // Vérification des getters
        $this->assertEquals($title, $pdf->getTitle());
        $this->assertEquals($createdAt, $pdf->getCreatedAt());

    }
}