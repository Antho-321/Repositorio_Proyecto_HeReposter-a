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

        // Retrieve the access token from the session or storage
        $accessToken = $request->session()->get('access_token');
        if (!$accessToken) {
            // Initialize the Google Client
            $client = new Client();
            $client->setAuthConfig(storage_path('app/google-credentials.json'));
            $client->setScopes(['https://www.googleapis.com/auth/gmail.send']);
    
            // Here, instead of redirecting for OAuth flow, you can use a refresh token to get a new access token
            // Check if a refresh token is available
            $refreshToken = $request->session()->get('refresh_token'); // or however you have stored the refresh token
            if ($refreshToken) {
                $client->fetchAccessTokenWithRefreshToken($refreshToken);
                $newAccessToken = $client->getAccessToken();
                $request->session()->put('access_token', $newAccessToken);
                $accessToken = $newAccessToken;
            } else {
                // Handle the case where a refresh token is not available
                // You might need to log this and handle it accordingly
                Log::error("Refresh token not available.");
                return response()->json(['error' => "Authentication required"], 401);
            }
        }

        $client = new Client();
        // Set the path to the JSON file with your credentials
        $client->setAuthConfig(storage_path('app/google-credentials.json'));

        // Set the required scopes
        $client->setScopes(['https://www.googleapis.com/auth/gmail.send']);

        // Set the access token from the session
        $client->setAccessToken($accessToken);

        // Check if the access token is expired and refresh it if necessary
        if ($client->isAccessTokenExpired()) {
            $refreshToken = $client->getRefreshToken();
            $client->fetchAccessTokenWithRefreshToken($refreshToken);
            // Store the new access token back into the session or your storage system
        }

        // Initialize the Gmail service with the configured client
        $service = new Gmail($client);



        // Construct the email message
        $subject = 'Testing subject1 of Your Email';
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

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleClient = new Client();
            $googleClient->setAuthConfig(storage_path('app/google-credentials.json'));
            $googleClient->setRedirectUri('https://developers.google.com/oauthplayground');

            $token = $googleClient->fetchAccessTokenWithAuthCode($request->code);
            $request->session()->put('access_token', $token);

            return view('cliente.envio_correo_registro');
        } catch (\Exception $e) {
            // Log the detailed error message
            Log::error("Error in handleGoogleCallback: " . $e->getMessage());
            return "An error occurred: " . $e->getMessage();
        }
    }
}
