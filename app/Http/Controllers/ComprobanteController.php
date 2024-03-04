<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comprobante;
use App\Models\Pedido;
use Barryvdh\DomPDF\Facade\Pdf;
use Google\Service\Gmail\Message;
use App\Models\Cliente;
use Google\Client;
use Illuminate\Support\Facades\Storage;
use Google\Service\Gmail;
use Illuminate\Support\Facades\Log;

class ComprobanteController extends Controller
{
    public function insert(Request $request)
    {
        $updateFields = $request->all();
        // Create a new Comprobante using the request data
        $comprobante = Comprobante::create($updateFields);
        $pedido_id = $comprobante->pedido_id;
        $pedido_search = new Pedido();
        $pedido = $pedido_search->getPedidoById($pedido_id);
        $pedido->pedido_confirmado = true;
        $pedido->save();

        $cliente_search = new Cliente();
        $cliente = $cliente_search->getClienteById($request->cliente_id);
        $cliente->update($updateFields);
        return response()->json($comprobante);
    }
    public function send(Request $request)
{
    try {
        $pdfData = $request->input('pdfData');
        if (!$pdfData) {
            return response()->json(['error' => 'No PDF data provided'], 400);
        }
        $pdfDecoded = base64_decode($pdfData);

        $filePath = 'pdfs/' . uniqid() . '.pdf';
        if (!file_exists('pdfs')) {
            mkdir('pdfs', 0777, true);
        }
        Storage::disk('local')->put($filePath, $pdfDecoded);
        if (!Storage::disk('local')->exists($filePath)) {
            Log::error("Failed to create PDF file: " . $filePath);
            return response()->json(['error' => 'Failed to create PDF file'], 500);
        }        
        $fullPath = storage_path('app/' . $filePath);
        $cliente = new Cliente($request->all());
        if (empty($cliente->email)) {
            return response()->json(['error' => "Email address is required"], 400);
        }

        $client = new Client();
        $client->setAuthConfig(storage_path('app/google-credentials.json'));
        $client->setScopes(['https://www.googleapis.com/auth/gmail.send']);

        try {
            $jsonString = Storage::disk('local')->get('google-credentials.json');
            $jsonArray = json_decode($jsonString, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Invalid JSON format in credentials.");
            }
            $refreshToken = $jsonArray['installed']['refresh_token'];
            $client->refreshToken($refreshToken);
        } catch (\Exception $e) {
            Log::error("JSON Parsing Exception: " . $e->getMessage());
            return response()->json(['error' => 'Invalid JSON format in credentials.'], 500);
        }

        $service = new Gmail($client);

        // Email content setup
        $texto1 = "Comprobante de venta";
        $texto2 = "¡Gracias por elegir Pastelería Pankey para endulzar tus momentos especiales! Nos complace confirmar que tu compra ha sido procesada exitosamente. Apreciamos tu preferencia y estamos emocionados de ser parte de tus celebraciones.";
        $texto3 = "Adjunto a este correo, encontrarás el comprobante de venta generado por tu reciente compra en nuestra página web. Por favor, revisa el adjunto para ver todos los detalles de tu transacción. Si tienes alguna pregunta o necesitas asistencia adicional, no dudes en contactarnos al 0988363503 o enviarnos un correo electrónico a pankey.ibarra@gmail.com. Estamos aquí para asegurarnos de que tu experiencia con Pastelería Pankey sea lo más placentera posible. Esperamos que disfrutes de tus pasteles tanto como nosotros disfrutamos preparándolos para ti. ¡Gracias por confiar en nosotros!";
        $htmlContent = $this->composeEmailHtmlContent($texto1, $texto2, $texto3);
        $subject = 'Comprobante de venta';
        $email_receiver = $cliente->email;

        $emailBody = $this->composeEmailBody($subject, $email_receiver, $htmlContent, $fullPath);

        $message = new Message();
        $encodedMessage = rtrim(strtr(base64_encode($emailBody), '+/', '-_'), '=');
        $message->setRaw($encodedMessage);
        $service->users_messages->send('me', $message);

        return response()->json(['message' => 'PDF processed and email sent']);
    } catch (\Exception $e) {
        // Log the error details for debugging
        Log::error("Exception: " . $e->getMessage());
        Log::error("In file: " . $e->getFile());
        Log::error("On line: " . $e->getLine());
        Log::error("Stack Trace: " . $e->getTraceAsString());
    
        // You may choose to return a more generic error message to the client
        return response()->json([
            'error' => 'An error occurred while processing your request. Please try again later.',
            'details' => $e->getMessage()
        ], 500);
    }
    
}


    private function composeEmailHtmlContent($texto1, $texto2, $texto3)
    {
        // Here, build your HTML content for the email
        // Replace this with your actual HTML content
        $htmlContent = <<<HTML
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta name="x-apple-disable-message-reformatting">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="telephone=no" name="format-detection">
            <title></title>
            <!--[if (mso 16)]>
            <style type="text/css">
            a {text-decoration: none;}
            </style>
            <![endif]-->
            <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
            <!--[if gte mso 9]>
        <xml>
            <o:OfficeDocumentSettings>
            <o:AllowPNG></o:AllowPNG>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
        </head>
        <body>
            <div class="es-wrapper-color">
                <!--[if gte mso 9]>
                    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                        <v:fill type="tile" color="#f6f6f6"></v:fill>
                    </v:background>
                <![endif]-->
                <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="esd-email-paddings" valign="top">
                                <table class="esd-header-popover es-header" cellspacing="0" cellpadding="0" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" align="center">
                                                <table class="es-header-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="left" class="esd-block-text">
                                                                                                <h1 style="font-family: Garamond, serif; text-align: center; color: black;"><b>$texto1</b></h1>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" align="center">
                                                <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                    <tbody>
                                                        <tr>
                                                            <td class="es-p20t es-p20r es-p20l esd-structure" align="left">
                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="left" class="esd-block-text">
                                                                                                <p style="font-family: Garamond, serif; font-size: 20px; color: black; text-align: justify;">Estimado usuario:<br><br>$texto2</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="esd-footer-popover es-footer" cellspacing="0" cellpadding="0" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" align="center">
                                                <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="center" class="esd-block-text">
                                                                                                <p style="font-family: Garamond, serif; font-size: 20px;"><b></b></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="left" class="esd-block-text">
                                                                                                <p style="font-family: Garamond, serif; font-size: 20px; text-align: justify;">$texto3<br><br>Atentamente,</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="center" class="esd-block-image" style="font-size: 0px;"><a target="_blank"><img class="adapt-img" src="https://dipruu.stripocdn.email/content/guids/CABINET_1782a0105a8e97581d2e6ae2057001d0b9a3dce0a67b2f9de86c5e982f45d837/images/logo_pankey1.png" alt style="display: block;" width="100"></a></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </body>
        </html>
        HTML;

        return $htmlContent;
    }

    private function composeEmailBody($subject, $email_receiver, $htmlContent, $filePath)
    {
        // Encode subject line to comply with RFC 2047
        $encoded_subject = '=?utf-8?B?' . base64_encode($subject) . '?=';

        // Email headers
        $emailBody = "To: {$email_receiver}\r\n";
        $emailBody .= "Subject: {$encoded_subject}\r\n";
        $emailBody .= "MIME-Version: 1.0\r\n";
        $emailBody .= "Content-Type: multipart/mixed; boundary=\"foo_bar_baz\"\r\n\r\n";

        // Email body with HTML content
        $emailBody .= "--foo_bar_baz\r\n";
        $emailBody .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
        $emailBody .= $htmlContent . "\r\n\r\n";

        // Attachment - PDF file
        $fileData = file_get_contents($filePath);
        $base64File = base64_encode($fileData);
        $emailBody .= "--foo_bar_baz\r\n";
        $emailBody .= "Content-Type: application/pdf; name=\"document.pdf\"\r\n";
        $emailBody .= "Content-Transfer-Encoding: base64\r\n";
        $emailBody .= "Content-Disposition: attachment; filename=\"document.pdf\"\r\n\r\n";
        $emailBody .= chunk_split($base64File, 76, "\r\n") . "\r\n";
        $emailBody .= "--foo_bar_baz--";

        return $emailBody;
    }
}

