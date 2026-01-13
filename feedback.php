<?php
// Autoload Composer dependencies
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables if .env exists
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

// Generate CSRF token for the form (must be before any output)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// PROCESSAMENTO DO ENVIO DE EMAIL
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');

    try {
        // Rate limiting - prevent spam
        $rateLimitFile = __DIR__ . '/logs/rate_limit_' . md5($_SERVER['REMOTE_ADDR'] ?? 'unknown') . '.txt';
        $currentTime = time();

        if (file_exists($rateLimitFile)) {
            $lastRequest = (int)file_get_contents($rateLimitFile);
            if ($currentTime - $lastRequest < 60) { // 1 minute cooldown
                echo json_encode(['success' => false, 'error' => 'Aguarde um momento antes de enviar outra mensagem.']);
                exit;
            }
        }

        // Update rate limit
        file_put_contents($rateLimitFile, $currentTime);

        // Sanitize and validate input
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $empresa = trim($_POST['empresa'] ?? '(não informado)');
        $mensagem = trim($_POST['mensagem'] ?? '');

        // CSRF protection (basic)
        $csrfToken = $_POST['csrf_token'] ?? '';
        $sessionToken = $_SESSION['csrf_token'] ?? '';

        if (empty($csrfToken) || $csrfToken !== $sessionToken) {
            echo json_encode(['success' => false, 'error' => 'Erro de segurança. Recarregue a página e tente novamente.']);
            exit;
        }

        // Prepare data for email service
        $contactData = [
            'nome' => $nome,
            'email' => $email,
            'empresa' => $empresa,
            'mensagem' => $mensagem
        ];

        // Use professional email service
        $emailService = new \SoftEdge\EmailService();

        if ($emailService->sendContactEmail($contactData)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erro ao enviar mensagem. Por favor, tente novamente ou entre em contato via WhatsApp.']);
        }

    } catch (\InvalidArgumentException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    } catch (\Exception $e) {
        error_log('Contact form error: ' . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Erro interno do servidor. Nossa equipe foi notificada.']);
    }

    exit;
}
?>
=======
<?php
// Autoload Composer dependencies
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables if .env exists
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

// PROCESSAMENTO DO ENVIO DE EMAIL
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');

    try {
        // Rate limiting - prevent spam
        $rateLimitFile = __DIR__ . '/logs/rate_limit_' . md5($_SERVER['REMOTE_ADDR'] ?? 'unknown') . '.txt';
        $currentTime = time();

        if (file_exists($rateLimitFile)) {
            $lastRequest = (int)file_get_contents($rateLimitFile);
            if ($currentTime - $lastRequest < 60) { // 1 minute cooldown
                echo json_encode(['success' => false, 'error' => 'Aguarde um momento antes de enviar outra mensagem.']);
                exit;
            }
        }

        // Update rate limit
        file_put_contents($rateLimitFile, $currentTime);

        // Sanitize and validate input
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $empresa = trim($_POST['empresa'] ?? '(não informado)');
        $mensagem = trim($_POST['mensagem'] ?? '');

        // CSRF protection (basic)
        $csrfToken = $_POST['csrf_token'] ?? '';
        $sessionToken = $_SESSION['csrf_token'] ?? '';

        if (empty($csrfToken) || $csrfToken !== $sessionToken) {
            echo json_encode(['success' => false, 'error' => 'Erro de segurança. Recarregue a página e tente novamente.']);
            exit;
        }

        // Prepare data for email service
        $contactData = [
            'nome' => $nome,
            'email' => $email,
            'empresa' => $empresa,
            'mensagem' => $mensagem
        ];

        // Use professional email service
        $emailService = new \SoftEdge\EmailService();

        if ($emailService->sendContactEmail($contactData)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erro ao enviar mensagem. Por favor, tente novamente ou entre em contato via WhatsApp.']);
        }

    } catch (\InvalidArgumentException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    } catch (\Exception $e) {
        error_log('Contact form error: ' . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Erro interno do servidor. Nossa equipe foi notificada.']);
    }

    exit;
}

// Generate CSRF token for the form
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
