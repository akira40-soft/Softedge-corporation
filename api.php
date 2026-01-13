<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Bootstrap.php';
\SoftEdge\Env::load(__DIR__);
\SoftEdge\Bootstrap::init();

use SoftEdge\Response;
use SoftEdge\Validation;
use SoftEdge\AuthService;
use SoftEdge\RateLimiter;
use SoftEdge\DB;
use PDO;

// Default JSON header
if (!headers_sent()) {
    header('Content-Type: application/json; charset=utf-8');
    header('X-Powered-By: SoftEdge');
}

// Handle OPTIONS (CORS preflight for development/SPA usage)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, X-CSRF-Token, Authorization');
    header('Access-Control-Max-Age: 86400');
    http_response_code(204);
    exit;
}

// Very limited CORS allowance if same-origin or configured
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$host = $_SERVER['HTTP_HOST'] ?? '';
if ($origin && str_contains($origin, $host)) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Vary: Origin');
    header('Access-Control-Allow-Credentials: true');
}

function path(): string {
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    // Support both /api.php?r=... and /api/... styles
    if (isset($_GET['r'])) {
        $r = '/' . ltrim((string)$_GET['r'], '/');
        return $r;
    }
    if (preg_match('#/api(?:\.php)?(.*)$#', $uri, $m)) {
        return $m[1] ? (string)$m[1] : '/';
    }
    return $uri;
}

function json_body(): array {
    $raw = file_get_contents('php://input');
    $data = json_decode((string)$raw, true);
    return is_array($data) ? $data : [];
}

$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
$route  = rtrim(path(), '/') ?: '/';

try {
    switch (true) {
        case $method === 'GET' && $route === '/health':
            Response::json([
                'ok' => true,
                'time' => date('c'),
                'app' => 'SoftEdge API',
                'env' => \SoftEdge\Env::get('APP_ENV', 'production'),
            ]);
            break;

        case $method === 'POST' && $route === '/auth/login':
            $body = json_body();
            $csrf = (string)($body['csrf'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? ''));
            if (!\SoftEdge\Csrf::validate($csrf)) {
                Response::json(['ok' => false, 'error' => 'CSRF inválido'], 400);
                break;
            }
            $email = trim((string)($body['email'] ?? ''));
            $password = (string)($body['password'] ?? '');
            if (!Validation::email($email)) {
                Response::json(['ok' => false, 'error' => 'Email inválido'], 422);
                break;
            }
            $res = AuthService::login($email, $password);
            Response::json($res, (int)($res['status'] ?? 200));
            break;

        case $method === 'POST' && $route === '/auth/logout':
            AuthService::logout();
            Response::json(['ok' => true]);
            break;

        case $method === 'POST' && $route === '/contact':
            $body = json_body();
            $csrf = (string)($body['csrf'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? ''));
            if (!\SoftEdge\Csrf::validate($csrf)) {
                Response::json(['ok' => false, 'error' => 'CSRF inválido'], 400);
                break;
            }
            $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            if (!RateLimiter::allow('contact:' . $ip, \SoftEdge\Env::int('RATE_LIMIT_CONTACT', 3), 3600)) {
                Response::json(['ok' => false, 'error' => 'Muitas solicitações. Tente mais tarde.'], 429);
                break;
            }
            $name = trim((string)($body['name'] ?? ''));
            $email = trim((string)($body['email'] ?? ''));
            $message = trim((string)($body['message'] ?? ''));
            $phone = trim((string)($body['phone'] ?? ''));
            $company = trim((string)($body['company'] ?? ''));
            $subject = trim((string)($body['subject'] ?? ''));

            $errors = Validation::required(['name' => $name, 'email' => $email, 'message' => $message], ['name','email','message']);
            if (!empty($errors) || !Validation::email($email)) {
                $errors['email'] = $errors['email'] ?? (!Validation::email($email) ? 'Email inválido' : null);
                Response::json(['ok' => false, 'errors' => array_filter($errors)], 422);
                break;
            }

            $pdo = DB::pdo();
            $stmt = $pdo->prepare('INSERT INTO contact_submissions (name, email, phone, company, subject, message, status) VALUES (:name,:email,:phone,:company,:subject,:message,\'new\')');
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone ?: null,
                ':company' => $company ?: null,
                ':subject' => $subject ?: null,
                ':message' => $message,
            ]);
            Response::json(['ok' => true, 'id' => (int)$pdo->lastInsertId()], 201);
            break;

        default:
            Response::json(['ok' => false, 'error' => 'Rota não encontrada', 'route' => $route], 404);
            break;
    }
} catch (Throwable $e) {
    Response::json([
        'ok' => false,
        'error' => 'Erro interno',
    ], 500);
}
