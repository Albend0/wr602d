<?php

namespace App\Controller;

use App\Service\GotenbergService;
use App\Entity\Pdf;
use App\Entity\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GotenbergController extends AbstractController
{
    private GotenbergService $gotenbergService;

    public function __construct(GotenbergService $gotenbergService)
    {
        $this->gotenbergService = $gotenbergService;
    }

    #[Route('/gotenberg', name: 'app_gotenberg')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $subscription = $this->getUser()->getSubscription();
        $pdfLimit = $subscription->getPdfLimit();

        $pdfCount = $entityManager->getRepository(Pdf::class)->countPdfLimit($this->getUser());

        $pdfRemaining = max(0, $pdfLimit - $pdfCount);

        if ($pdfRemaining == 0) {
            notyf()->addError('Maximum PDF limit reached. Please upgrade your subscription.');
        }

        return $this->render('gotenberg/index.html.twig', [
            'pdfCount' => $pdfCount,
            'pdfRemaining' => $pdfRemaining,
        ]);
    }

    #[Route('/gotenberg/convert', name: 'app_gotenberg_convert', methods: ['POST'])]
    public function convert(Request $request, EntityManagerInterface $entityManager): Response {
        $url = $request->request->get('url');
        $pdfTitle = $request->request->get('title');
        $pdfFilePath = $this->gotenbergService->generatePdfFromUrl($url, $pdfTitle);

        //add pdf to bdd
        $pdf = new Pdf();
        $pdf->setUser($this->getUser());
        $pdf->setTitle($pdfTitle);
        $pdf->setFilePath($pdfFilePath);
        $pdf->setCreatedAt(new \DateTimeImmutable());
        $entityManager->persist($pdf);
        $entityManager->flush();

        return $this->file($pdfFilePath);

    }



}