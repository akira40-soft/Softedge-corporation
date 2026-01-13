<?php

/**
 * SoftEdge Corporation - Initialization File
 * Sets up the application environment and autoloading
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set timezone
date_default_timezone_set('Africa/Luanda');

// Error handling for production
if (getenv('APP_ENV') === 'production') {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
} else {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// Load environment variables if .env exists
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

// Set default environment variables
$_ENV['APP_NAME'] = $_ENV['APP_NAME'] ?? 'SoftEdge Corporation';
$_ENV['APP_URL'] = $_ENV['APP_URL'] ?? 'https://softedge-corporation.up.railway.app';
$_ENV['APP_ENV'] = $_ENV['APP_ENV'] ?? 'production';

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Content Security Policy
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://unpkg.com https://cdn.tailwindcss.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:; connect-src 'self'");

// Create logs directory if it doesn't exist
$logsDir = __DIR__ . '/../logs';
if (!is_dir($logsDir)) {
    mkdir($logsDir, 0755, true);
}

// Set custom error log
ini_set('error_log', $logsDir . '/php_errors.log');

// Function to get base URL
function getBaseUrl(): string
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $port = $_SERVER['SERVER_PORT'] ?? 80;

    // Don't include port if it's the default for the protocol
    if (($protocol === 'http' && $port == 80) || ($protocol === 'https' && $port == 443)) {
        return $protocol . '://' . $host;
    }

    return $protocol . '://' . $host . ':' . $port;
}

// Function to get current URL
function getCurrentUrl(): string
{
    return getBaseUrl() . $_SERVER['REQUEST_URI'];
}

// Function to redirect
function redirect(string $url, int $statusCode = 302): void
{
    header('Location: ' . $url, true, $statusCode);
    exit;
}

// Function to sanitize input
function sanitizeInput(string $input): string
{
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Function to generate CSRF token
function generateCsrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Function to validate CSRF token
function validateCsrfToken(string $token): bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Function to log activity
function logActivity(string $message, string $level = 'INFO'): void
{
    $logFile = __DIR__ . '/../logs/activity.log';
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    $logEntry = "[$timestamp] [$level] [$ip] [$userAgent] $message" . PHP_EOL;

    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Function to check if user is rate limited
function isRateLimited(string $identifier, int $maxRequests = 5, int $timeWindow = 300): bool
{
    $rateLimitFile = __DIR__ . "/../logs/rate_limit_{$identifier}.txt";
    $currentTime = time();

    // Read existing requests
    $requests = [];
    if (file_exists($rateLimitFile)) {
        $requests = json_decode(file_get_contents($rateLimitFile), true) ?? [];
    }

    // Filter out old requests
    $requests = array_filter($requests, function($timestamp) use ($currentTime, $timeWindow) {
        return ($currentTime - $timestamp) < $timeWindow;
    });

    // Check if rate limit exceeded
    if (count($requests) >= $maxRequests) {
        return true;
    }

    // Add current request
    $requests[] = $currentTime;

    // Save updated requests
    file_put_contents($rateLimitFile, json_encode($requests));

    return false;
}

// Initialize application
logActivity("Application initialized");

// Autoload classes (Composer will handle this)
require_once __DIR__ . '/../vendor/autoload.php';
