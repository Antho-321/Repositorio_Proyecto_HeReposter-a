<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cliente.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Cliente $cliente)
    {
        // Save the model
        $cliente->save();

        return view('cliente.index', compact('cliente'));
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
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
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

        // Create a new Google Client
        $client = new Client();

        // Set the path to the JSON file with your credentials
        $client->setAuthConfig(storage_path('app/google-credentials.json'));

        // Set the required scopes
        $client->setScopes(['https://www.googleapis.com/auth/gmail.send']);

        // Get and set the refresh token
        $refreshToken = '1//04I03yTtUV79dCgYIARAAGAQSNwF-L9IrCDWIJy_5_nu5tuErUuFKoN55ZB87ZW6QPsfoNuRQtILriw2jCT9V_ca1Jgp47qGIYZY'; // Replace with your refresh token
        $client->refreshToken($refreshToken);

        // Get the new access token
        $accessToken = $client->getAccessToken();
        // Initialize the Gmail service with the configured client
        $service = new Gmail($client);

        // Construct the email message
        $subject = 'Test3 Subject of Your Email';
        $bodyText = 'Your email body here';
        $emailBody = "To: anthonyluisluna225@gmail.com\r\n";
        $emailBody .= "Subject: $subject\r\n";
        $emailBody .= "\r\n";
        $emailBody .= $bodyText;

        // Encode the body to base64url
        $encodedMessage = rtrim(strtr(base64_encode($emailBody), '+/', '-_'), '=');

        // Prepare the message in the required format
        $message = new Message();
        $message->setRaw($encodedMessage);

        try {
            // Send the message
            $service->users_messages->send('me', $message);

            // Return the view after sending the email
            return view('cliente.envio_correo_registro', compact('cliente'));
        } catch (\Exception $e) {
            // Log the detailed error message
            Log::error("Error in ingreso: " . $e->getMessage());
            return response()->json(['error' => "An error occurred: " . $e->getMessage()], 500);
        }
    }
}
