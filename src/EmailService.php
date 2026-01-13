<?php

namespace SoftEdge;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Email Service for SoftEdge Corporation
 * Handles contact form submissions and email sending
 */
class EmailService
{
    private PHPMailer $mailer;
    private array $config;

    public function __construct()
    {
        $this->config = $this->loadConfig();
        $this->setupMailer();
    }

    /**
     * Load email configuration from environment
     */
    private function loadConfig(): array
    {
        return [
            'host' => $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com',
            'port' => (int)($_ENV['SMTP_PORT'] ?? 587),
            'username' => $_ENV['SMTP_USERNAME'] ?? '',
            'password' => $_ENV['SMTP_PASSWORD'] ?? '',
            'encryption' => $_ENV['SMTP_ENCRYPTION'] ?? 'tls',
            'from_email' => $_ENV['SMTP_FROM_EMAIL'] ?? 'softedgecorporation@gmail.com',
            'from_name' => $_ENV['SMTP_FROM_NAME'] ?? 'SoftEdge Corporation'
        ];
    }

    /**
     * Setup PHPMailer instance
     */
    private function setupMailer(): void
    {
        $this->mailer = new PHPMailer(true);

        // Server settings
        $this->mailer->isSMTP();
        $this->mailer->Host = $this->config['host'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $this->config['username'];
        $this->mailer->Password = $this->config['password'];
        $this->mailer->SMTPSecure = $this->config['encryption'];
        $this->mailer->Port = $this->config['port'];

        // Sender
        $this->mailer->setFrom($this->config['from_email'], $this->config['from_name']);

        // Encoding and charset
        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->Encoding = 'base64';
    }

    /**
     * Send contact email
     */
    public function sendContactEmail(array $data): bool
    {
        try {
            // Validate required fields
            $this->validateContactData($data);

            // Recipients
            $this->mailer->addAddress('softedgecorporation@gmail.com', 'SoftEdge Corporation');

            // Content
            $this->mailer->isHTML(false);
            $this->mailer->Subject = '🚀 Novo Contato do Site - ' . $data['nome'];
            $this->mailer->Body = $this->buildContactEmailBody($data);

            // Send email
            $result = $this->mailer->send();

            // Log success
            error_log("Email sent successfully to: softedgecorporation@gmail.com from: {$data['email']}");

            return $result;

        } catch (Exception $e) {
            error_log("Email sending failed: " . $this->mailer->ErrorInfo);
            throw new \RuntimeException('Erro ao enviar email: ' . $e->getMessage());
        }
    }

    /**
     * Validate contact form data
     */
    private function validateContactData(array $data): void
    {
        $required = ['nome', 'email', 'mensagem'];
        $missing = [];

        foreach ($required as $field) {
            if (empty(trim($data[$field] ?? ''))) {
                $missing[] = $field;
            }
        }

        if (!empty($missing)) {
            throw new \InvalidArgumentException('Campos obrigatórios não preenchidos: ' . implode(', ', $missing));
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('E-mail inválido');
        }

        // Additional validation
        if (strlen($data['nome']) < 2) {
            throw new \InvalidArgumentException('Nome deve ter pelo menos 2 caracteres');
        }

        if (strlen($data['mensagem']) < 10) {
            throw new \InvalidArgumentException('Mensagem deve ter pelo menos 10 caracteres');
        }
    }

    /**
     * Build contact email body
     */
    private function buildContactEmailBody(array $data): string
    {
        $empresa = $data['empresa'] ?? '(não informado)';
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $timestamp = date('d/m/Y H:i:s');

        return "═══════════════════════════════════════\n" .
               "  NOVO CONTATO DO SITE SOFTEDGE\n" .
               "═══════════════════════════════════════\n\n" .
               "👤 NOME:\n   {$data['nome']}\n\n" .
               "📧 E-MAIL:\n   {$data['email']}\n\n" .
               "🏢 EMPRESA/PROJETO:\n   {$empresa}\n\n" .
               "💬 MENSAGEM:\n   " . str_replace("\n", "\n   ", $data['mensagem']) . "\n\n" .
               "═══════════════════════════════════════\n" .
               "📅 Data: {$timestamp}\n" .
               "🌐 IP: {$ip}\n" .
               "═══════════════════════════════════════\n";
    }

    /**
     * Send notification email (for internal use)
     */
    public function sendNotification(string $subject, string $message): bool
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress('softedgecorporation@gmail.com', 'SoftEdge Corporation');

            $this->mailer->isHTML(false);
            $this->mailer->Subject = '🔔 ' . $subject;
            $this->mailer->Body = $message;

            return $this->mailer->send();

        } catch (Exception $e) {
            error_log("Notification email failed: " . $this->mailer->ErrorInfo);
            return false;
        }
    }
}
