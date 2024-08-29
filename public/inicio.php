<?php
set_time_limit(300);

function checkLocalServer($url, $timeout = 5) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => $timeout,
        CURLOPT_CONNECTTIMEOUT => $timeout,
        CURLOPT_VERBOSE => true,
        CURLOPT_HEADER => true
    ]);
    
    $verbose = fopen('php://temp', 'w+');
    curl_setopt($ch, CURLOPT_STDERR, $verbose);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    $error = curl_error($ch);
    $errorNo = curl_errno($ch);
    
    rewind($verbose);
    $verboseLog = stream_get_contents($verbose);
    
    curl_close($ch);
    
    $details = [
        'httpCode' => $httpCode,
        'error' => $error,
        'errorNo' => $errorNo,
        'verboseLog' => $verboseLog
    ];
    
    if ($response === false || $httpCode >= 400) {
        // Change: Encode the details as JSON and include them in the exception message
        throw new Exception('Local server is not responding correctly. Details: ' . json_encode($details));
    }
    
    return $details;
}

try {
    $serverDetails = checkLocalServer('http://127.0.0.1:8000');
    echo "Server is accessible. HTTP Code: " . $serverDetails['httpCode'] . "\n";
} catch (Exception $e) {
    echo "Error: Local server at http://127.0.0.1:8000 is not accessible. Please ensure your Laravel server is running.\n";
    echo "Details: " . $e->getMessage() . "\n";
    
    $errorDetails = $e->getTrace()[0]['args'][3] ?? [];
    
    if (!empty($errorDetails)) {
        echo "HTTP Code: " . $errorDetails['httpCode'] . "\n";
        echo "cURL Error: " . $errorDetails['error'] . "\n";
        echo "cURL Error Number: " . $errorDetails['errorNo'] . "\n";
        echo "Verbose Log:\n" . $errorDetails['verboseLog'] . "\n";
    }
    
    echo "PHP Version: " . phpversion() . "\n";
    echo "Loaded PHP Extensions:\n" . implode(", ", get_loaded_extensions()) . "\n";
    
    exit(1);
}

$command = 'npx cypress run --spec "../vendor/laracasts/cypress/src/stubs/integration/example.cy.js" --config-file "../vendor/laracasts/cypress/src/stubs/cypress.config.js"';

$output = array();
$return_var = null;

echo "Executing command: $command\n";

$last_line = exec($command, $output, $return_var);

echo "Command output:\n";
echo !empty($output) ? implode("\n", $output) . "\n" : "No output captured.\n";

echo "Exit status: $return_var\n";

if ($return_var !== 0) {
    echo "Error occurred. Details:\n";
    echo "Error code: $return_var\n";
    
    if ($last_line !== false) {
        echo "Last line of output: $last_line\n";
    }
    
    $error = error_get_last();
    if ($error !== null) {
        echo "PHP error type: " . $error['type'] . "\n";
        echo "PHP error message: " . $error['message'] . "\n";
        echo "PHP error file: " . $error['file'] . "\n";
        echo "PHP error line: " . $error['line'] . "\n";
    }
    
    // Check if npm is installed and accessible
    $npmVersion = exec('npm -v', $npmOutput, $npmReturnVar);
    echo $npmReturnVar !== 0 ? "Error: npm is not installed or not accessible in the system PATH.\n" : "npm version: $npmVersion\n";
    
    // Check if Cypress is installed
    $cypressVersion = exec('npx cypress -v', $cypressOutput, $cypressReturnVar);
    echo $cypressReturnVar !== 0 ? "Error: Cypress is not installed or not accessible.\n" : "Cypress version: " . implode("\n", $cypressOutput) . "\n";
    
    echo "Current working directory: " . getcwd() . "\n";
    echo "Script location: " . __FILE__ . "\n";
    
    $envVars = getenv();
    echo "Relevant environment variables:\n";
    foreach (['PATH', 'NODE_PATH', 'CYPRESS_CACHE_FOLDER'] as $var) {
        echo "$var: " . ($envVars[$var] ?? 'Not set') . "\n";
    }
}