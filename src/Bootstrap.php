<?php
declare(strict_types=1);

namespace SoftEdge;

use PDO;
use PDOException;
use Throwable;

// Try to load Composer autoload if not already loaded
if (!class_exists(\Composer\Autoload\ClassLoader::class)) {
    $autoload = __DIR__ . '/../vendor/autoload.php';
    if (is_file($autoload)) {
        require_once $autoload;
    }
}

/**
 * Env loader with Dotenv support and fallback parser
 */
final class Env
{
    private static bool $loaded = false;
    private static array $cache = [];

    public static function load(?string $dir = null): void
    {
        if (self::$loaded) return;
        $dir = $dir ?? dirname(__DIR__);

        // Load from $_ENV/$_SERVER first
        self::$cache = array_merge($_SERVER, $_ENV);

        // Prefer vlucas/phpdotenv when available
        if (class_exists(\Dotenv\Dotenv::class)) {
            try {
                $dotenv = \Dotenv\Dotenv::createImmutable($dir, ['.env']);
                $dotenv->safeLoad();
                self::$cache = array_merge(self::$cache, $_ENV);
            } catch (Throwable $e) {
                // ignore, fallback to manual parse
            }
        } else {
            // Fallback: manual parse basic .env
            $envFile = $dir . DIRECTORY_SEPARATOR . '.env';
            if (is_file($envFile)) {
                $lines = @file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
                foreach ($lines as $line) {
                    if (preg_match('/^\s*#/',$line)) continue;
                    if (!str_contains($line, '=')) continue;
                    [$k,$v] = array_map('trim', explode('=', $line, 2));
                    $v = trim($v, "\"' ");
                    self::$cache[$k] = $v;
                }
            }
        }

        // Defaults
        self::$cache['APP_ENV'] = self::$cache['APP_ENV'] ?? 'production';
        self::$cache['TIMEZONE'] = self::$cache['TIMEZONE'] ?? 'Africa/Luanda';
        self::$cache['JWT_SECRET'] = self::$cache['JWT_SECRET'] ?? base64_encode(random_bytes(32));
        self::$cache['APP_KEY'] = self::$cache['APP_KEY'] ?? base64_encode(random_bytes(32));

        self::$loaded = true;
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        return self::$cache[$key] ?? $default;
    }

    public static function bool(string $key, bool $default = false): bool
    {
        $v = self::get($key);
        if ($v === null) return $default;
        $v = strtolower($v);
        return in_array($v, ['1','true','yes','on'], true);
    }

    public static function int(string $key, int $default = 0): int
    {
        $v = self::get($key);
        return $v !== null && is_numeric($v) ? (int)$v : $default;
    }
}

/**
 * Security headers
 */
final class SecurityHeaders
{
    public static function apply(): void
    {
        // Only add if headers not sent
        if (headers_sent()) return;

        $csp = "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https:; style-src 'self' 'unsafe-inline' https:; img-src 'self' data: https:; font-src 'self' data: https:; connect-src 'self' https:; frame-ancestors 'none'; base-uri 'self'; form-action 'self'";
        header('Content-Security-Policy: ' . $csp);
        header('X-Frame-Options: DENY');
        header('X-Content-Type-Options: nosniff');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: geolocation=(), microphone=(), camera=()');

        // HSTS only when HTTPS
        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
        }
    }
}

/**
 * Standardized JSON responses
 */
final class Response
{
    public static function json(array $data, int $status = 200): void
    {
        if (!headers_sent()) {
            http_response_code($status);
            header('Content-Type: application/json; charset=utf-8');
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

/**
 * Simple validation helpers
 */
final class Validation
{
    public static function required(array $data, array $fields): array
    {
        $errors = [];
        foreach ($fields as $f) {
            if (!isset($data[$f]) || $data[$f] === '') {
                $errors[$f] = 'Campo obrigatório';
            }
        }
        return $errors;
    }

    public static function email(string $email): bool
    {
        return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}

/**
 * Very light file/APCu based rate limiter
 */
final class RateLimiter
{
    public static function allow(string $key, int $maxRequests, int $windowSeconds): bool
    {
        $now = time();
        $id = 'rate_' . sha1($key);

        if (function_exists('apcu_fetch')) {
            $entry = apcu_fetch($id, $success);
            if (!$success || !is_array($entry) || $entry['reset'] <= $now) {
                apcu_store($id, ['count' => 1, 'reset' => $now + $windowSeconds], $windowSeconds);
                return true;
            }
            if ($entry['count'] < $maxRequests) {
                $entry['count']++;
                apcu_store($id, $entry, $entry['reset'] - $now);
                return true;
            }
            return false;
        }

        // Fallback: file-based
        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'storage';
        if (!is_dir($dir)) @mkdir($dir, 0775, true);
        $file = $dir . DIRECTORY_SEPARATOR . $id . '.json';
        $entry = ['count' => 0, 'reset' => $now + $windowSeconds];
        if (is_file($file)) {
            $content = json_decode((string)@file_get_contents($file), true) ?: [];
            if (isset($content['reset']) && $content['reset'] > $now) {
                $entry = $content;
            }
        }
        if ($entry['reset'] <= $now) {
            $entry = ['count' => 1, 'reset' => $now + $windowSeconds];
            @file_put_contents($file, json_encode($entry));
            return true;
        }
        if ($entry['count'] < $maxRequests) {
            $entry['count']++;
            @file_put_contents($file, json_encode($entry));
            return true;
        }
        return false;
    }
}

/**
 * CSRF token utilities for forms and fetch requests
 */
final class Csrf
{
    private const KEY = '_csrf';

    public static function ensure(): void
    {
        if (!isset($_SESSION[self::KEY])) {
            $_SESSION[self::KEY] = bin2hex(random_bytes(32));
        }
    }

    public static function token(): string
    {
        return (string)($_SESSION[self::KEY] ?? '');
    }

    public static function validate(?string $token): bool
    {
        return is_string($token) && hash_equals(self::token(), $token);
    }
}

/**
 * JWT service using firebase/php-jwt when available
 */
final class JwtService
{
    public static function sign(array $payload, ?int $ttlSeconds = 3600): string
    {
        $now = time();
        $payload = array_merge([
            'iat' => $now,
            'nbf' => $now,
            'exp' => $now + (int)$ttlSeconds,
            'iss' => $_SERVER['HTTP_HOST'] ?? 'localhost',
        ], $payload);

        $secret = Env::get('JWT_SECRET');
        if (class_exists(\Firebase\JWT\JWT::class)) {
            return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
        }
        // Minimal fallback: base64 signature (NOT recommended for production if library missing)
        $header = base64_encode(json_encode(['alg' => 'HS256','typ' => 'JWT']));
        $body = base64_encode(json_encode($payload));
        $sig = rtrim(strtr(base64_encode(hash_hmac('sha256', "$header.$body", $secret, true)), '+/', '-_'), '=');
        return "$header.$body.$sig";
    }
}

/**
 * PDO connection provider + migrations
 */
final class DB
{
    private static ?PDO $pdo = null;

    public static function pdo(): PDO
    {
        if (self::$pdo) return self::$pdo;
        $url = Env::get('DATABASE_URL');

        try {
            if ($url && str_starts_with($url, 'mysql://')) {
                // mysql://user:pass@host:port/db
                $parts = parse_url($url);
                $user = $parts['user'] ?? '';
                $pass = $parts['pass'] ?? '';
                $host = $parts['host'] ?? '127.0.0.1';
                $port = $parts['port'] ?? 3306;
                $db   = ltrim($parts['path'] ?? '/softedge', '/');
                $dsn  = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
                $pdo  = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
                self::$pdo = $pdo;
            } else {
                // Default to SQLite file in /storage
                $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'storage';
                if (!is_dir($dir)) @mkdir($dir, 0775, true);
                $path = $dir . DIRECTORY_SEPARATOR . 'softedge.sqlite';
                $dsn  = 'sqlite:' . $path;
                $pdo  = new PDO($dsn, null, null, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
                // Ensures WAL for better concurrency
                $pdo->exec('PRAGMA journal_mode = WAL');
                $pdo->exec('PRAGMA foreign_keys = ON');
                self::$pdo = $pdo;
            }
        } catch (PDOException $e) {
            http_response_code(500);
            die('Database connection error');
        }
        return self::$pdo;
    }

    public static function migrate(): void
    {
        $pdo = self::pdo();
        $driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);

        if ($driver === 'sqlite') {
            $pdo->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT NOT NULL UNIQUE,
                password TEXT NOT NULL,
                name TEXT,
                role TEXT DEFAULT 'user',
                status TEXT DEFAULT 'active',
                last_login TEXT,
                last_ip TEXT,
                login_attempts INTEGER DEFAULT 0,
                locked_until TEXT,
                created_at TEXT DEFAULT (datetime('now'))
            );
            SQL);

            $pdo->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS contact_submissions (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT,
                email TEXT,
                phone TEXT,
                company TEXT,
                subject TEXT,
                message TEXT NOT NULL,
                status TEXT DEFAULT 'new',
                created_at TEXT DEFAULT (datetime('now'))
            );
            SQL);
        } else {
            // Basic MySQL-compatible schema (minimal)
            $pdo->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                name VARCHAR(255),
                role VARCHAR(50) DEFAULT 'user',
                status VARCHAR(50) DEFAULT 'active',
                last_login DATETIME NULL,
                last_ip VARCHAR(45) NULL,
                login_attempts INT DEFAULT 0,
                locked_until DATETIME NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            SQL);

            $pdo->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS contact_submissions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255),
                email VARCHAR(255),
                phone VARCHAR(20),
                company VARCHAR(255),
                subject VARCHAR(500),
                message TEXT NOT NULL,
                status VARCHAR(50) DEFAULT 'new',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            SQL);
        }
    }

    public static function seedAdmin(): void
    {
        $pdo = self::pdo();
        $email = Env::get('ADMIN_EMAIL', 'admin@softedge.com');
        $name  = Env::get('ADMIN_NAME', 'Admin');
        $pass  = Env::get('ADMIN_PASSWORD', 'Admin@123456');
        $hash  = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 10]);

        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        if (!$stmt->fetch()) {
            $ins = $pdo->prepare('INSERT INTO users (email, password, name, role, status) VALUES (:email,:password,:name,\'super_admin\',\'active\')');
            $ins->execute([':email' => $email, ':password' => $hash, ':name' => $name]);
        }
    }
}

/**
 * Authentication service
 */
final class AuthService
{
    public static function login(string $email, string $password): array
    {
        $pdo = DB::pdo();
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';

        // Rate limit by IP & email
        $key = 'login:' . $ip . ':' . strtolower($email);
        if (!RateLimiter::allow($key, Env::int('RATE_LIMIT_LOGIN', 5), 60)) {
            return ['ok' => false, 'status' => 429, 'error' => 'Muitas tentativas. Tente novamente mais tarde.'];
        }

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
        if (!$user) {
            return ['ok' => false, 'status' => 401, 'error' => 'Credenciais inválidas'];
        }

        // Check lockout
        if (!empty($user['locked_until'])) {
            $now = time();
            $locked = strtotime((string)$user['locked_until']);
            if ($locked && $locked > $now) {
                return ['ok' => false, 'status' => 423, 'error' => 'Conta temporariamente bloqueada'];
            }
        }

        if (!password_verify($password, (string)$user['password'])) {
            // increment attempts
            $attempts = (int)$user['login_attempts'] + 1;
            $lockFor = 0;
            $max = Env::int('MAX_LOGIN_ATTEMPTS', 5);
            if ($attempts >= $max) {
                $lockSeconds = Env::int('LOCKOUT_SECONDS', 900);
                $lockFor = time() + $lockSeconds;
            }
            $pdo->prepare('UPDATE users SET login_attempts = :a, locked_until = :l WHERE id = :id')
                ->execute([':a' => $attempts, ':l' => $lockFor ? date('Y-m-d H:i:s', $lockFor) : null, ':id' => $user['id']]);
            return ['ok' => false, 'status' => 401, 'error' => 'Credenciais inválidas'];
        }

        // Reset attempts and update metadata
        $pdo->prepare('UPDATE users SET login_attempts = 0, locked_until = NULL, last_login = :ll, last_ip = :ip WHERE id = :id')
            ->execute([':ll' => date('Y-m-d H:i:s'), ':ip' => $ip, ':id' => $user['id']]);

        // Session security
        self::secureSession();
        $_SESSION['uid'] = (int)$user['id'];
        $_SESSION['role'] = (string)$user['role'];
        session_regenerate_id(true);

        // Optional JWT for API usage
        $jwt = JwtService::sign(['sub' => $user['id'], 'email' => $user['email'], 'role' => $user['role']], Env::int('JWT_TTL', 3600));

        return [
            'ok' => true,
            'status' => 200,
            'user' => [
                'id' => (int)$user['id'],
                'email' => (string)$user['email'],
                'name' => (string)($user['name'] ?? ''),
                'role' => (string)$user['role'],
            ],
            'token' => $jwt,
        ];
    }

    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = [];
            if (ini_get('session.use_cookies')) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            }
            session_destroy();
        }
    }

    public static function secureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
            session_set_cookie_params([
                'lifetime' => Env::int('SESSION_LIFETIME', 86400),
                'path' => '/',
                'domain' => '',
                'secure' => $secure,
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
            session_start();
        }
    }
}

/**
 * Application bootstrapper
 */
final class Bootstrap
{
    public static function init(): void
    {
        // Timezone
        date_default_timezone_set(Env::get('TIMEZONE', 'Africa/Luanda'));

        // Start secure session
        AuthService::secureSession();

        // CSRF token
        Csrf::ensure();

        // Security headers
        SecurityHeaders::apply();

        // Database and migrations
        DB::migrate();

        // Seed admin user if missing
        DB::seedAdmin();
    }
}
