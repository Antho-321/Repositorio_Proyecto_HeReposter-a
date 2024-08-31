<?php
set_time_limit(300);
$idTempClient = $_GET['idTempClient'] ?? 'Default Value';

function checkLocalServer($url, $timeout = 5) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => $timeout,
        CURLOPT_CONNECTTIMEOUT => $timeout,
        CURLOPT_HEADER => true
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    $error = curl_error($ch);
    $errorNo = curl_errno($ch);
    
    curl_close($ch);
    
    $details = [
        'httpCode' => $httpCode,
        'error' => $error,
        'errorNo' => $errorNo
    ];
    
    if ($response === false || $httpCode >= 400) {
        throw new Exception('Local server is not responding correctly. Details: ' . json_encode($details));
    }
    
    return $details;
}

function checkCypressSetup() {
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
        $output = []; // Clear output array for next iteration
    }

    return $results;
}

function checkFileExists($path) {
    return file_exists($path) ? "File exists" : "File does not exist";
}

$command = sprintf(
    'npx cypress run --spec "./cypress/cypress/e2e/get_image_link.cy.js" --config-file "./cypress/cypress.config.js" --env message="%s" --quiet',
    escapeshellarg($idTempClient)
);

exec($command, $output, $return_var);
echo !empty($output) ? implode("\n", $output) . "\n" : "No output captured.\n";

if ($return_var !== 0) {
    echo "Error occurred. Details:\n";
    echo "Error code: $return_var\n";

    if (!empty($output)) {
        echo "Last line of output: " . end($output) . "\n";
    }

    $error = error_get_last();
    if ($error !== null) {
        echo "PHP error details:\n";
        echo json_encode($error, JSON_PRETTY_PRINT) . "\n";
    }

    $cypressSetup = checkCypressSetup();
    echo "Cypress setup details:\n";
    echo json_encode($cypressSetup, JSON_PRETTY_PRINT) . "\n";

    echo "File checks:\n";
    $filesToCheck = [
        './cypress/cypress/support/e2e.js',
        './cypress/cypress/e2e/get_image_link.cy.js',
        './cypress/cypress.config.js'
    ];
    foreach ($filesToCheck as $file) {
        echo "$file: " . checkFileExists($file) . "\n";
    }

    echo "Current working directory: " . getcwd() . "\n";
    echo "Script location: " . __FILE__ . "\n";

    $relevantVars = ['PATH', 'NODE_PATH', 'CYPRESS_CACHE_FOLDER', 'HOME', 'USER'];
    echo "Relevant environment variables:\n";
    foreach ($relevantVars as $var) {
        echo "$var: " . (getenv($var) ?: 'Not set') . "\n";
    }

    $configFile = './cypress/cypress.config.js';
    if (file_exists($configFile) && is_readable($configFile)) {
        echo "Contents of $configFile:\n";
        echo file_get_contents($configFile) . "\n";
    } else {
        echo "Unable to read $configFile\n";
    }
}