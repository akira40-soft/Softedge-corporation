<?php
// Health Check Endpoint for Render.com
// This keeps the service active by preventing sleep mode

header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Basic health check
$health = [
    'status' => 'healthy',
    'timestamp' => date('c'),
    'service' => 'SoftEdge Corporation Website',
    'version' => '2.0.0',
    'uptime' => time() - ($_SERVER['REQUEST_TIME'] ?? time()),
    'checks' => [
        'database' => 'not_required',
        'filesystem' => is_writable(__DIR__) ? 'writable' : 'read_only',
        'php' => PHP_VERSION,
        'memory' => memory_get_peak_usage(true) . ' bytes',
        'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'unknown'
    ]
];

// Check if critical files exist
$criticalFiles = [
    'index.php',
    'composer.json',
    'vendor/autoload.php',
    'assets/logo.jpeg'
];

foreach ($criticalFiles as $file) {
    if (!file_exists(__DIR__ . '/' . $file)) {
        $health['status'] = 'degraded';
        $health['checks']['missing_files'][] = $file;
    }
}

// Check if email service is configured
$emailConfigured = false;
if (file_exists(__DIR__ . '/.env')) {
    $envContent = file_get_contents(__DIR__ . '/.env');
    $emailConfigured = strpos($envContent, 'SMTP_HOST=') !== false;
}
$health['checks']['email_configured'] = $emailConfigured;

// Return appropriate HTTP status
if ($health['status'] === 'healthy') {
    http_response_code(200);
} elseif ($health['status'] === 'degraded') {
    http_response_code(200); // Still return 200 for uptime monitors
} else {
    http_response_code(503);
}

echo json_encode($health, JSON_PRETTY_PRINT);
?>
