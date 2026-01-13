<?php

namespace SoftEdge;

use PDO;
use PDOException;

/**
 * User Management Class
 * Handles user registration, authentication, and profile management
 */
class User
{
    private PDO $db;
    private array $config;

    public function __construct(PDO $db = null)
    {
        $this->config = $this->loadConfig();
        $this->db = $db ?? $this->getDatabaseConnection();
    }

    /**
     * Load configuration
     */
    private function loadConfig(): array
    {
        return [
            'db_host' => $_ENV['DB_HOST'] ?? 'localhost',
            'db_name' => $_ENV['DB_NAME'] ?? 'softedge_db',
            'db_user' => $_ENV['DB_USER'] ?? 'root',
            'db_pass' => $_ENV['DB_PASS'] ?? '',
            'jwt_secret' => $_ENV['JWT_SECRET'] ?? 'your-jwt-secret-key',
            'google_client_id' => $_ENV['GOOGLE_CLIENT_ID'] ?? '',
            'google_client_secret' => $_ENV['GOOGLE_CLIENT_SECRET'] ?? '',
            'github_client_id' => $_ENV['GITHUB_CLIENT_ID'] ?? '',
            'github_client_secret' => $_ENV['GITHUB_CLIENT_SECRET'] ?? ''
        ];
    }

    /**
     * Get database connection
     */
    private function getDatabaseConnection(): PDO
    {
        try {
            $dsn = "mysql:host={$this->config['db_host']};dbname={$this->config['db_name']};charset=utf8mb4";
            $pdo = new PDO($dsn, $this->config['db_user'], $this->config['db_pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new \RuntimeException('Database connection failed');
        }
    }

    /**
     * Create users table if it doesn't exist
     */
    public function createTables(): void
    {
        try {
            // Users table
            $this->db->exec("
                CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    password VARCHAR(255),
                    avatar VARCHAR(500),
                    provider VARCHAR(50) DEFAULT 'local',
                    provider_id VARCHAR(255),
                    role ENUM('user', 'admin') DEFAULT 'user',
                    email_verified BOOLEAN DEFAULT FALSE,
                    verification_token VARCHAR(255),
                    reset_token VARCHAR(255),
                    reset_expires DATETIME,
                    last_login DATETIME,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
            ");

            // Page visits table
            $this->db->exec("
                CREATE TABLE IF NOT EXISTS page_visits (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT,
                    page VARCHAR(255) NOT NULL,
                    ip_address VARCHAR(45),
                    user_agent TEXT,
                    referrer VARCHAR(500),
                    session_id VARCHAR(255),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
            ");

            // User sessions table
            $this->db->exec("
                CREATE TABLE IF NOT EXISTS user_sessions (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT NOT NULL,
                    session_token VARCHAR(255) UNIQUE NOT NULL,
                    ip_address VARCHAR(45),
                    user_agent TEXT,
                    expires_at DATETIME NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
            ");

        } catch (PDOException $e) {
            error_log("Table creation failed: " . $e->getMessage());
            throw new \RuntimeException('Failed to create database tables');
        }
    }

    /**
     * Register a new user
     */
    public function register(array $data): array
    {
        $this->validateRegistrationData($data);

        try {
            $this->db->beginTransaction();

            // Check if email already exists
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$data['email']]);
            if ($stmt->fetch()) {
                throw new \InvalidArgumentException('Email já cadastrado');
            }

            // Hash password
            $hashedPassword = password_hash($data['password'], PASSWORD_ARGON2ID);

            // Generate verification token
            $verificationToken = bin2hex(random_bytes(32));

            // Insert user
            $stmt = $this->db->prepare("
                INSERT INTO users (name, email, password, verification_token, created_at)
                VALUES (?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $data['name'],
                $data['email'],
                $hashedPassword,
                $verificationToken
            ]);

            $userId = $this->db->lastInsertId();

            $this->db->commit();

            return [
                'success' => true,
                'user_id' => $userId,
                'verification_token' => $verificationToken,
                'message' => 'Usuário registrado com sucesso. Verifique seu email.'
            ];

        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Registration failed: " . $e->getMessage());
            throw new \RuntimeException('Erro ao registrar usuário');
        }
    }

    /**
     * Authenticate user
     */
    public function login(string $email, string $password): array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT id, name, email, password, role, email_verified
                FROM users
                WHERE email = ? AND provider = 'local'
            ");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if (!$user || !password_verify($password, $user['password'])) {
                throw new \InvalidArgumentException('Email ou senha incorretos');
            }

            if (!$user['email_verified']) {
                throw new \InvalidArgumentException('Email não verificado. Verifique sua caixa de entrada.');
            }

            // Update last login
            $stmt = $this->db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $stmt->execute([$user['id']]);

            // Create session
            $sessionToken = $this->createSession($user['id']);

            // Log page visit
            $this->logPageVisit($user['id'], 'login', $_SERVER['HTTP_USER_AGENT'] ?? '');

            return [
                'success' => true,
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ],
                'session_token' => $sessionToken
            ];

        } catch (PDOException $e) {
            error_log("Login failed: " . $e->getMessage());
            throw new \RuntimeException('Erro ao fazer login');
        }
    }

    /**
     * Social login (Google, GitHub)
     */
    public function socialLogin(string $provider, array $profile): array
    {
        try {
            $this->db->beginTransaction();

            // Check if user exists
            $stmt = $this->db->prepare("
                SELECT id, name, email, role, email_verified
                FROM users
                WHERE provider = ? AND provider_id = ?
            ");
            $stmt->execute([$provider, $profile['id']]);
            $user = $stmt->fetch();

            if (!$user) {
                // Create new user
                $stmt = $this->db->prepare("
                    INSERT INTO users (name, email, avatar, provider, provider_id, email_verified, created_at)
                    VALUES (?, ?, ?, ?, ?, TRUE, NOW())
                ");
                $stmt->execute([
                    $profile['name'],
                    $profile['email'],
                    $profile['avatar'] ?? null,
                    $provider,
                    $profile['id']
                ]);

                $userId = $this->db->lastInsertId();

                $user = [
                    'id' => $userId,
                    'name' => $profile['name'],
                    'email' => $profile['email'],
                    'role' => 'user',
                    'email_verified' => true
                ];
            }

            // Update last login
            $stmt = $this->db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $stmt->execute([$user['id']]);

            // Create session
            $sessionToken = $this->createSession($user['id']);

            // Log page visit
            $this->logPageVisit($user['id'], 'social_login', $_SERVER['HTTP_USER_AGENT'] ?? '');

            $this->db->commit();

            return [
                'success' => true,
                'user' => $user,
                'session_token' => $sessionToken
            ];

        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Social login failed: " . $e->getMessage());
            throw new \RuntimeException('Erro ao fazer login social');
        }
    }

    /**
     * Create user session
     */
    private function createSession(int $userId): string
    {
        $sessionToken = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+24 hours'));

        $stmt = $this->db->prepare("
            INSERT INTO user_sessions (user_id, session_token, ip_address, user_agent, expires_at, created_at)
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $userId,
            $sessionToken,
            $_SERVER['REMOTE_ADDR'] ?? '',
            $_SERVER['HTTP_USER_AGENT'] ?? '',
            $expiresAt
        ]);

        return $sessionToken;
    }

    /**
     * Validate session
     */
    public function validateSession(string $sessionToken): ?array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT u.id, u.name, u.email, u.role, u.email_verified, s.expires_at
                FROM user_sessions s
                JOIN users u ON s.user_id = u.id
                WHERE s.session_token = ? AND s.expires_at > NOW()
            ");
            $stmt->execute([$sessionToken]);
            $result = $stmt->fetch();

            return $result ?: null;

        } catch (PDOException $e) {
            error_log("Session validation failed: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Log page visit
     */
    public function logPageVisit(?int $userId, string $page, string $userAgent = ''): void
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO page_visits (user_id, page, ip_address, user_agent, referrer, session_id, created_at)
                VALUES (?, ?, ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $userId,
                $page,
                $_SERVER['REMOTE_ADDR'] ?? '',
                $userAgent,
                $_SERVER['HTTP_REFERER'] ?? '',
                session_id()
            ]);
        } catch (PDOException $e) {
            error_log("Page visit logging failed: " . $e->getMessage());
        }
    }

    /**
     * Get admin statistics
     */
    public function getAdminStats(): array
    {
        try {
            // Total users
            $stmt = $this->db->query("SELECT COUNT(*) as total FROM users");
            $totalUsers = $stmt->fetch()['total'];

            // Total page visits
            $stmt = $this->db->query("SELECT COUNT(*) as total FROM page_visits");
            $totalVisits = $stmt->fetch()['total'];

            // Recent visits (last 30 days)
            $stmt = $this->db->prepare("
                SELECT COUNT(*) as total
                FROM page_visits
                WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            ");
            $stmt->execute();
            $recentVisits = $stmt->fetch()['total'];

            // Top pages
            $stmt = $this->db->prepare("
                SELECT page, COUNT(*) as visits
                FROM page_visits
                GROUP BY page
                ORDER BY visits DESC
                LIMIT 10
            ");
            $stmt->execute();
            $topPages = $stmt->fetchAll();

            // Recent users
            $stmt = $this->db->prepare("
                SELECT id, name, email, created_at
                FROM users
                ORDER BY created_at DESC
                LIMIT 10
            ");
            $stmt->execute();
            $recentUsers = $stmt->fetchAll();

            return [
                'total_users' => $totalUsers,
                'total_visits' => $totalVisits,
                'recent_visits' => $recentVisits,
                'top_pages' => $topPages,
                'recent_users' => $recentUsers
            ];

        } catch (PDOException $e) {
            error_log("Admin stats failed: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Validate registration data
     */
    private function validateRegistrationData(array $data): void
    {
        $required = ['name', 'email', 'password'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new \InvalidArgumentException("Campo {$field} é obrigatório");
            }
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email inválido');
        }

        if (strlen($data['name']) < 2) {
            throw new \InvalidArgumentException('Nome deve ter pelo menos 2 caracteres');
        }

        if (strlen($data['password']) < 8) {
            throw new \InvalidArgumentException('Senha deve ter pelo menos 8 caracteres');
        }
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(int $userId): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT role FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch();

            return $user && $user['role'] === 'admin';

        } catch (PDOException $e) {
            error_log("Admin check failed: " . $e->getMessage());
            return false;
        }
    }
}
