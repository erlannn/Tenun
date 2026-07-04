<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsappService
{
    protected $token;
    protected $defaultAttachmentMessage = 'Struk PDF terlampir.';

    public function __construct()
    {
        $this->token = env('FONNTE_TOKEN');
    }

    /**
     * Mengirim pesan WhatsApp ke nomor tertentu
     */
    public function sendMessage($target, $message)
    {
        $target = $this->normalizeTarget($target);

        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => $target,
            'message' => $message,
            'countryCode' => '62', // Default Indonesia
        ]);

        return $response->json();
    }

    /**
     * Mengirim file (PDF) beserta pesan WhatsApp ke nomor tertentu
     */
    // public function sendFile($target, $filePath, $filename, $message = '')
    // {
    //     $target = $this->normalizeTarget($target);

    //     if (!is_file($filePath) || !is_readable($filePath)) {
    //         logger()->error('Failed to read PDF file for WhatsApp sending: ' . $filePath);
    //         return ['status' => false, 'reason' => 'Unable to read PDF file'];
    //     }

    //     $fileSize = filesize($filePath);
    //     if ($fileSize === false) {
    //         logger()->error('Failed to detect PDF file size for WhatsApp sending: ' . $filePath);
    //         return ['status' => false, 'reason' => 'Unable to determine PDF file size'];
    //     }

    //     if ($fileSize > 4 * 1024 * 1024) {
    //         logger()->warning('PDF file exceeds Fonnte attachment limit: ' . $filePath . ' (' . $fileSize . ' bytes)');
    //         return ['status' => false, 'reason' => 'PDF file size exceeds Fonnte limit of 4MB'];
    //     }

    //     logger()->info('Sending WhatsApp PDF attachment', [
    //         'target' => $target,
    //         'file_path' => $filePath,
    //         'file_name' => $filename,
    //         'file_size' => $fileSize,
    //     ]);

    //     $message = trim((string) $message);
    //     if ($message === '') {
    //         $message = $this->defaultAttachmentMessage;
    //     }

    //     if (function_exists('curl_init') && function_exists('curl_mime_init')) {
    //         $curl = curl_init();

    //         $mime = \curl_mime_init($curl);

    //         $targetPart = \curl_mime_addpart($mime);
    //         \curl_mime_name($targetPart, 'target');
    //         \curl_mime_data($targetPart, $target, CURL_ZERO_TERMINATED);

    //         $countryCodePart = \curl_mime_addpart($mime);
    //         \curl_mime_name($countryCodePart, 'countryCode');
    //         \curl_mime_data($countryCodePart, '62', CURL_ZERO_TERMINATED);

    //         $filenamePart = \curl_mime_addpart($mime);
    //         \curl_mime_name($filenamePart, 'filename');
    //         \curl_mime_data($filenamePart, $filename, CURL_ZERO_TERMINATED);

    //         $messagePart = \curl_mime_addpart($mime);
    //         \curl_mime_name($messagePart, 'message');
    //         \curl_mime_data($messagePart, $message, CURL_ZERO_TERMINATED);

    //         $filePart = \curl_mime_addpart($mime);
    //         \curl_mime_name($filePart, 'file');
    //         \curl_mime_filedata($filePart, $filePath);
    //         \curl_mime_filename($filePart, $filename);
    //         \curl_mime_type($filePart, 'application/pdf');

    //         curl_setopt_array($curl, [
    //             CURLOPT_URL => 'https://api.fonnte.com/send',
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_ENCODING => '',
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 0,
    //             CURLOPT_FOLLOWLOCATION => true,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_CUSTOMREQUEST => 'POST',
    //             CURLOPT_MIMEPOST => $mime,
    //             CURLOPT_HTTPHEADER => [
    //                 'Authorization: ' . $this->token,
    //             ],
    //         ]);

    //         $responseBody = curl_exec($curl);

    //         \curl_mime_free($mime);

    //         if ($responseBody === false) {
    //             $errorMessage = curl_error($curl);
    //             curl_close($curl);

    //             logger()->error('Fonnte local file upload failed: ' . $errorMessage);

    //             return ['status' => false, 'reason' => $errorMessage ?: 'Unknown cURL error'];
    //         }

    //         curl_close($curl);

    //         $decodedResponse = json_decode($responseBody, true);

    //         if (!is_array($decodedResponse)) {
    //             logger()->error('Fonnte returned invalid JSON for local file upload: ' . $responseBody);

    //             return [
    //                 'status' => false,
    //                 'reason' => 'Invalid response from Fonnte',
    //                 'raw' => $responseBody,
    //             ];
    //         }

    //         logger()->info('Fonnte response: ' . json_encode($decodedResponse));

    //         return $decodedResponse;
    //     }

    //     $response = Http::withHeaders([
    //         'Authorization' => $this->token,
    //     ])
    //         ->attach('file', file_get_contents($filePath), $filename, [
    //             'Content-Type' => 'application/pdf',
    //         ])
    //         ->post('https://api.fonnte.com/send', [
    //             'target' => $target,
    //             'countryCode' => '62',
    //             'filename' => $filename,
    //             'message' => $message,
    //         ]);

    //     $decodedResponse = $response->json();

    //     if (!is_array($decodedResponse)) {
    //         logger()->error('Fonnte returned invalid JSON for file upload: ' . $response->body());

    //         return [
    //             'status' => false,
    //             'reason' => 'Invalid response from Fonnte',
    //             'raw' => $response->body(),
    //         ];
    //     }

    //     logger()->info('Fonnte response: ' . json_encode($decodedResponse));

    //     return $decodedResponse;
    // }

    /**
     * Mengirim file PDF dari URL publik beserta pesan WhatsApp ke nomor tertentu.
     */
    // public function sendFileByUrl($target, $fileUrl, $filename, $message = '')
    // {
    //     $target = $this->normalizeTarget($target);
    //     $fileUrl = trim((string) $fileUrl);

    //     if (!filter_var($fileUrl, FILTER_VALIDATE_URL)) {
    //         logger()->error('Invalid PDF URL for WhatsApp sending: ' . $fileUrl);
    //         return ['status' => false, 'reason' => 'Invalid PDF URL'];
    //     }

    //     $message = trim((string) $message);
    //     if ($message === '') {
    //         $message = $this->defaultAttachmentMessage;
    //     }

    //     logger()->info('Sending WhatsApp PDF by public URL', [
    //         'target' => $target,
    //         'file_url' => $fileUrl,
    //         'file_name' => $filename,
    //     ]);

    //     $response = Http::withHeaders([
    //         'Authorization' => $this->token,
    //     ])->asForm()->post('https://api.fonnte.com/send', [
    //         'target' => $target,
    //         'url' => $fileUrl,
    //         'message' => $message,
    //         'filename' => $filename,
    //         'countryCode' => '62',
    //     ]);

    //     $decodedResponse = $response->json();

    //     if (!is_array($decodedResponse)) {
    //         logger()->error('Fonnte returned invalid JSON for URL-based file upload: ' . $response->body());

    //         return [
    //             'status' => false,
    //             'reason' => 'Invalid response from Fonnte',
    //             'raw' => $response->body(),
    //         ];
    //     }

    //     logger()->info('Fonnte response: ' . json_encode($decodedResponse));

    //     return $decodedResponse;
    // }

    protected function normalizeTarget($target)
    {
        $target = preg_replace('/\D+/', '', (string) $target);

        if ($target === '') {
            return $target;
        }

        if (str_starts_with($target, '0')) {
            return '62' . substr($target, 1);
        }

        return $target;
    }
}