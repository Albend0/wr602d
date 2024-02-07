<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GotenbergService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    public function generatePdfFromUrl(string $url): string{

        $htmlContent = file_get_contents($url);

        $response = $this->client->request(
            'POST',
            'http://localhost:3000/forms/chromium/convert/url',
            [
                'headers' => [
                    'Content-Type' => 'multipart/form-data',
                ],
                'body' => [
                    'url' => $url,
                ]
            ]);

        if ($response->getStatusCode() !== 200) {

            throw new \Exception('Failed to generate PDF from URL.');
        }

        $pdfContent = $response->getContent();

        $pdfFilePath = sys_get_temp_dir() . '/' . uniqid('generated_pdf') . '.pdf';
        file_put_contents($pdfFilePath, $pdfContent);

        return $pdfFilePath;
    }
}