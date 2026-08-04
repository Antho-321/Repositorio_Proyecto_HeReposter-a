<?php

namespace App\Http\Controllers;

use App\Models\Pastel;
use App\Models\Cliente;
use App\Models\Dibujo_Img_Especial;
use App\Models\Adorno_Fondant;
use App\Models\Especificacion_Adicional;
use Nesk\Puphpeteer\Puppeteer;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->input('cerrar_sesion') == "true") {
            session()->forget('cliente');
            session()->forget('pasteles_carrito');
        }
        $pasteles = Pastel::orderBy('pastel_id', 'DESC')->get();
        Session::put('pasteles', $pasteles);
        if ($request->input('cerrar_sesion') == "true") {
            return redirect()->route('cliente.index');
        }
        return view('cliente.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $random = Session::get('random');
        $cliente = Session::get('cliente');

        // Sin codigo en sesion o sin cliente no hay nada que confirmar: null == null
        // daba por valido el codigo y reventaba al leer $cliente->email.
        if ($random !== null && $cliente !== null && $random == $request->input('random')) {
            if (Session::get('tipo_ingreso_aux') == "registrarse") {
                $cliente->save();
            }
            $cliente_search = new Cliente();
            $cliente_aux = $cliente_search->getClienteByEmail($cliente->email);
            $cliente = $cliente_aux;
            Session::put('cliente', $cliente); // Storing the cliente object after saving

            Session::put('codigo_correcto', true);

            // Optionally, pass the cliente_id to the view
            return redirect()->route('cliente.index');
        }

        Session::put('codigo_correcto', false);
        return view('cliente.envio_correo', compact('cliente'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('cliente.sobre_nosotros');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $pastel)
    {
        //
    }

    /**
     * Send email to client
     */
    public function ingreso(Request $request)
    {
        $cliente = new Cliente();
        $cliente->fill($request->all());
        // Ensure that the email field is not empty
        if (empty($cliente->email)) {
            Log::error("Error in ingreso: Email address is empty.");
            return response()->json(['error' => "Email address is required"], 400);
        }
        $email_receiver = $cliente->email;
        // Create a new Google Client
        $client = new Client();

        // Set the path to the JSON file with your credentials
        $client->setAuthConfig(storage_path('app/google-credentials.json'));

        // Set the required scopes
        $client->setScopes(['https://www.googleapis.com/auth/gmail.send']);

        $jsonString = Storage::disk('local')->get('google-credentials.json');

        // Convertir la cadena JSON en un array
        $jsonArray = json_decode($jsonString, true);

        // Extraer el valor de refresh_token
        $refreshToken = $jsonArray['installed']['refresh_token'];
        $client->refreshToken($refreshToken);

        // Get the new access token
        //$accessToken = $client->getAccessToken();

        // Initialize the Gmail service with the configured client
        if ($request->input('registro') == "false") {
            $tipo_ingreso = "ingreso";
            $tipo_ingreso_aux = "ingresar";
        } else {
            $tipo_ingreso = "registro";
            $tipo_ingreso_aux = "registrarse";
        }
        $service = new Gmail($client);
        $random = rand(10000, 100000);
        $texto1 = "Código de verificación de $tipo_ingreso en Pankey";
        $texto2 = "Hemos recibido una solicitud de $tipo_ingreso en nuestro sitio web de pastelería utilizando tu dirección de correo electrónico. Tu código de verificación de $tipo_ingreso es:";
        $texto3 = "Si no has solicitado este código, puede que alguien esté intentando $tipo_ingreso_aux en nuestro sitio web utilizando tu dirección de correo electrónico. No compartas este correo electrónico ni des el código a nadie. Has recibido este mensaje porque esta dirección de correo electrónico figura como dirección de contacto en la solicitud de $tipo_ingreso en nuestro sitio web. Si crees que esto es un error, por favor ignora este mensaje o ponte en contacto con nosotros para solucionarlo. Gracias por elegir nuestro sitio web de pastelería.";
        // Ensure that your HTML content is properly formatted with UTF-8 encoding
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
                                                                                                <p style="font-family: Garamond, serif; font-size: 20px;"><b>$random</b></p>
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

        // Construct the email body with HTML content
        $subject = 'Código de verificación';
        $encoding = 'UTF-8';

        // $encoding is the character set of the string, such as 'UTF-8'
        $encoded_subject = iconv_mime_encode(
            'Subject',
            $subject,
            array(
                'scheme' => 'B', // use base64 encoding
                'input-charset' => $encoding, // specify the input character set
                'output-charset' => $encoding, // specify the output character set
                'line-length' => 76, // specify the maximum line length
                'line-break-chars' => "\r\n" // specify the line break characters
            )
        );
        $encoded_subject = substr($encoded_subject, 9);
        // Ensure proper formatting of the email headers
        $emailBody = "To: " . $email_receiver . "\r\n";
        $emailBody .= "Subject: " . $encoded_subject . "\r\n";
        $emailBody .= "MIME-Version: 1.0\r\n";
        $emailBody .= "Content-Type: text/html; charset=UTF-8\r\n";
        $emailBody .= "\r\n";
        $emailBody .= $htmlContent;

        // Encode the body to base64url
        $encodedMessage = rtrim(strtr(base64_encode($emailBody), '+/', '-_'), '=');

        // Prepare the message in the required format
        $message = new Message();
        $message->setRaw($encodedMessage);

        try {
            // Send the message
            $service->users_messages->send('me', $message);
            Session::put('random', $random);
            Session::put('cliente', $cliente);
            // Return the view after sending the email
            Session::put('tipo_ingreso_aux', $tipo_ingreso_aux);
            return view('cliente.envio_correo');
        } catch (\Exception $e) {
            // Log the detailed error message
            Log::error("Error in ingreso: " . $e->getMessage());
            return response()->json(['error' => "An error occurred: " . $e->getMessage()], 500);
        }
    }
    public function pastel_seleccionado(Request $request)
    {
        $img = $request->input('img');
        $pastel_search = new Pastel();
        $pastel = $pastel_search->getPastelByImg($img);
        return view('cliente.pastel_seleccionado', compact('pastel'));
    }

    public function pasteles_personalizados()
    {
        return view('cliente.pasteles_personalizados');
    }

    public function categoria_seleccionada(Request $request)
    {
        $categoria = $request->input('categoria_value');
        $pastel_search = new Pastel();

        $pasteles = $pastel_search->getPastelesByCategoria($categoria);
        $array_categoria_pasteles = array($categoria, $pasteles);
        return view("cliente.categoria_seleccionada", compact('array_categoria_pasteles'));
    }

    public function carrito()
    {
        return view('cliente.carrito');
    }
    public function pastelPersonalizado() {}
    public function uploadPastelPersonalizado(Request $request)
    {
        // Handle the file upload logic here
    }
    public function get_direct_image_url($initial_url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $initial_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $html = curl_exec($ch);

        curl_close($ch);

        if ($html === false || $html === '') {
            throw new \Exception('No HTML received from ' . $initial_url);
        }

        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $input = $dom->getElementById('code_direct');

        if ($input === null) {
            throw new \Exception('Element #code_direct not found in ' . $initial_url);
        }

        return $input->getAttribute('value');
    }
    public function upload_image($api_url, $token, $image_path, $upload_session)
    {

        $data = [
            'token' => $token,
            'upload_session' => $upload_session,
            'numfiles' => '1',
            'upload_referer' => 'https://www.phpbb.com',
            'file' => new \CURLFile($image_path)
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headers = curl_getinfo($ch);

        curl_close($ch);

        return [
            'status_code' => $http_code,
            'headers' => $headers,
            'content' => $response
        ];
    }
    public function deleteFile($filePath) {
        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                return "File deleted successfully.";
            } else {
                return "Error deleting the file.";
            }
        } else {
            return "File not found.";
        }
    }
    public function send(Request $request)
    {
        $directUrl = null;
        $errorDetails = null;
        $cypressOutput = null;
        $image_path = null;

        try {
            if (!$request->hasFile('file')) {
                throw new \Exception('No file received.');
            }

            $file = $request->file('file');
            $uploadDir = base_path('cypress/cypress/fixtures');
            $fileName = $file->getClientOriginalName();

            if (!$file->move($uploadDir, $fileName)) {
                throw new \Exception('Failed to move uploaded file.');
            }

            $image_path = $uploadDir . '/' . $fileName;

            $api_url = "https://postimg.cc/json?q=a";
            $token = "61aa06d6116f7331ad7b2ba9c7fb707ec9b182e8";
            $upload_session = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";

            $api_response = $this->upload_image($api_url, $token, $image_path, $upload_session);

            if (!isset($api_response['content'])) {
                throw new \Exception('No content received from API');
            }

            $json_response = json_decode($api_response['content'], true);
            $initial_url = $json_response['url'] ?? null;

            if (!$initial_url) {
                throw new \Exception('No URL received from API');
            }
            
            $directUrl = $this->get_direct_image_url($initial_url);
        } catch (\Exception $e) {
            $errorDetails = [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ];
            $cypressOutput = json_encode($this->convertTextToObject($this->runCypressTest()), JSON_PRETTY_PRINT);
        }

        if ($image_path !== null) {
            $this->deleteFile($image_path);
        }

        return response()->json([
            'direct_url' => $directUrl,
            'cypress_output' => $cypressOutput,
            'error_details' => $errorDetails
        ]);
    }
    function convertTextToObject($text)
    {
        // Remove newlines and extra spaces
        $text = preg_replace('/\s+/', ' ', $text);

        // Extract the JSON-like part
        if (preg_match('/({.*})/', $text, $matches)) {
            $jsonLike = $matches[1];
        } else {
            return new \stdClass(); // Return empty object if no match
        }

        // Replace single quotes with double quotes
        $jsonLike = str_replace("'", '"', $jsonLike);

        // Decode the JSON string
        $object = json_decode($jsonLike);

        // If json_decode fails, fallback to manual parsing
        if (json_last_error() !== JSON_ERROR_NONE) {
            $object = new \stdClass();

            // Remove curly braces
            $jsonLike = trim($jsonLike, '{}');

            // Split into key-value pairs
            $pairs = explode(',', $jsonLike);

            foreach ($pairs as $pair) {
                list($key, $value) = explode(':', $pair, 2);
                $key = trim($key, ' "');
                $value = trim($value, ' "');
                $object->$key = $value;
            }
        }

        return $object;
    }

    private function runCypressTest()
    {
        set_time_limit(300);
        $command = sprintf(
            'npx cypress run --spec "%s" --config-file "%s" --quiet',
            base_path('cypress/cypress/e2e/get_image_link.cy.js'),
            base_path('cypress/cypress.config.js')
        );

        exec($command, $output, $return_var);
        $cypressOutput = implode("\n", $output);

        if ($return_var !== 0) {
            $cypressOutput = "Error occurred. Error code: $return_var\n";
            $cypressOutput .= $this->checkCypressSetup();
        }

        return $cypressOutput;
    }

    private function checkCypressSetup()
    {
        $checks = [
            'npm' => 'npm -v',
            'node' => 'node -v',
            'npx' => 'npx -v',
            'cypress' => 'npx cypress -v'
        ];

        $results = [];
        foreach ($checks as $name => $command) {
            exec($command . ' 2>&1', $output, $returnVar);
            $results[$name] = [
                'installed' => $returnVar === 0,
                'version' => $returnVar === 0 ? implode("\n", $output) : 'Not installed or not accessible'
            ];
        }

        return json_encode($results, JSON_PRETTY_PRINT) . "\n";
    }
    public function get_upload_image(Request $request)
    {
        // $spanText = $request->input('spanText');
        // $pastel = new Pastel();
        // $pastel->img = $spanText;
        // $pastel->save();
        return response()->json(['received' => true]);
    }

    public function delete(Request $request)
    {
        $file_path = $request->input('ruta');
        try {
            unlink($file_path);
            return response()->json(['success' => 'File deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e, 'ruta' => $file_path], 400);
        }
    }
}
