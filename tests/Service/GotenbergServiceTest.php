<?php

namespace App\Tests\Service;

use App\Service\GotenbergService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
class GotenbergServiceTest extends TestCase
{
    public function testGeneratePdfFromUrl(): void
    {

        $httpClient = new MockHttpClient([
            new MockResponse('PDF content'),
        ]);

        $symfonyDocsService = new GotenbergService($httpClient);

        $pdfFilePath = $symfonyDocsService->generatePdfFromUrl('https://example.com/');

        $this->assertStringEndsWith('.pdf', $pdfFilePath);
        $this->assertFileExists($pdfFilePath);

        unlink($pdfFilePath);
    }
}