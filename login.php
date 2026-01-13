<?php
require_once __DIR__ . '/src/Bootstrap.php';
\SoftEdge\Env::load(__DIR__);
\SoftEdge\Bootstrap::init();

$loginError = '';
$loginSuccess = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $csrf = $_POST['csrf_token'] ?? '';
    if (!\SoftEdge\Csrf::validate($csrf)) {
        $loginError = 'Falha de segurança: token CSRF inválido.';
    } else {
        $email = trim((string)($_POST['email'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        if (!\SoftEdge\Validation::email($email)) {
            $loginError = 'Email inválido';
        } else {
            $result = \SoftEdge\AuthService::login($email, $password);
            if (($result['ok'] ?? false) === true) {
                $loginSuccess = 'Login realizado com sucesso!';
                $role = $result['user']['role'] ?? 'user';
                if (in_array($role, ['admin','super_admin'], true)) {
                    header('Location: admin.php');
                } elseif (file_exists(__DIR__ . '/dashboard.php')) {
                    header('Location: dashboard.php');
                } else {
                    header('Location: index.php');
                }
                exit;
            } else {
                $loginError = $result['error'] ?? 'Credenciais inválidas';
                if (!headers_sent()) {
                    http_response_code((int)($result['status'] ?? 401));
                }
            }
        }
    }
}

// Social login URLs (se configurados)
$googleLoginUrl = '';
$githubLoginUrl = '';

if (!empty($_ENV['GOOGLE_CLIENT_ID'])) {
    $googleLoginUrl = "https://accounts.google.com/oauth/authorize?" . http_build_query([
        'client_id' => $_ENV['GOOGLE_CLIENT_ID'],
        'redirect_uri' => (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/auth/google',
        'scope' => 'openid email profile',
        'response_type' => 'code',
        'state' => bin2hex(random_bytes(16))
    ]);
}

if (!empty($_ENV['GITHUB_CLIENT_ID'])) {
    $githubLoginUrl = "https://github.com/login/oauth/authorize?" . http_build_query([
        'client_id' => $_ENV['GITHUB_CLIENT_ID'],
        'redirect_uri' => (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/auth/github',
        'scope' => 'user:email',
        'state' => bin2hex(random_bytes(16))
    ]);
}
?>

<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - SoftEdge Corporation</title>

  <!-- SEO -->
  <meta name="description" content="Acesse sua conta na SoftEdge Corporation">
  <meta name="robots" content="noindex, nofollow">

  <!-- Favicon -->
  <link rel="icon" href="/assets/placeholder.svg" type="image/svg+xml">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'system-ui', 'sans-serif'],
          },
          colors: {
            primary: {
              50: '#f8fafc',
              100: '#f1f5f9',
              200: '#e2e8f0',
              300: '#cbd5e1',
              400: '#94a3b8',
              500: '#64748b',
              600: '#475569',
              700: '#334155',
              800: '#1e293b',
              900: '#0f172a',
            }
          }
        }
      }
    }
  </script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <style>
    /* Modern Sea Background */
    body {
      background: url('/assets/mar.jpg') center/cover fixed no-repeat;
      position: relative;
    }

    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(30, 41, 59, 0.75) 50%, rgba(15, 23, 42, 0.85) 100%);
      backdrop-filter: blur(1px);
      -webkit-backdrop-filter: blur(1px);
      z-index: -1;
    }

    /* Ultra Transparent Glass Card */
    .glass-card {
      background: rgba(30, 41, 59, 0.15);
      backdrop-filter: blur(25px);
      -webkit-backdrop-filter: blur(25px);
      border: 1px solid rgba(148, 163, 184, 0.08);
      box-shadow:
        0 8px 32px rgba(0, 0, 0, 0.12),
        inset 0 1px 0 rgba(255, 255, 255, 0.05);
    }

    /* Neon Border Effect */
    .neon-border {
      position: relative;
      background: linear-gradient(135deg, rgba(30, 41, 59, 0.15), rgba(30, 41, 59, 0.1));
      border: 1px solid rgba(148, 163, 184, 0.08);
      transition: all 0.3s ease;
    }

    .neon-border::before {
      content: '';
      position: absolute;
      inset: 0;
      padding: 1px;
      background: linear-gradient(135deg, rgba(6, 182, 212, 0.3), rgba(59, 130, 246, 0.3), rgba(147, 51, 234, 0.3));
      border-radius: inherit;
      mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      mask-composite: exclude;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .neon-border:hover::before,
    .neon-border:focus-within::before {
      opacity: 1;
    }

    /* Modern Input Focus Effects */
    .input-focus {
      transition: all 0.3s ease;
      background: rgba(30, 41, 59, 0.2);
      border: 1px solid rgba(148, 163, 184, 0.1);
    }

    .input-focus:focus {
      background: rgba(30, 41, 59, 0.3);
      border-color: rgba(6, 182, 212, 0.4);
      box-shadow:
        0 0 0 3px rgba(6, 182, 212, 0.1),
        0 0 20px rgba(6, 182, 212, 0.1);
    }

    /* Typing Animation */
    .typing-text {
      overflow: hidden;
      border-right: 2px solid rgba(6, 182, 212, 0.8);
      white-space: nowrap;
      animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
    }

    @keyframes typing {
      from { width: 0; }
      to { width: 100%; }
    }

    @keyframes blink-caret {
      from, to { border-color: transparent; }
      50% { border-color: rgba(6, 182, 212, 0.8); }
    }

    /* Floating Particles */
    .particle {
      position: absolute;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      pointer-events: none;
      animation: float 8s ease-in-out infinite;
    }

    .particle:nth-child(1) { width: 4px; height: 4px; top: 20%; left: 10%; animation-delay: 0s; }
    .particle:nth-child(2) { width: 6px; height: 6px; top: 60%; left: 80%; animation-delay: 2s; }
    .particle:nth-child(3) { width: 3px; height: 3px; top: 40%; left: 60%; animation-delay: 4s; }
    .particle:nth-child(4) { width: 5px; height: 5px; top: 80%; left: 30%; animation-delay: 1s; }
    .particle:nth-child(5) { width: 4px; height: 4px; top: 10%; left: 70%; animation-delay: 3s; }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.1; }
      50% { transform: translateY(-20px) rotate(180deg); opacity: 0.3; }
    }

    /* Logo Glow Animation */
    .logo-glow {
      animation: logoGlow 4s ease-in-out infinite;
    }

    @keyframes logoGlow {
      0%, 100% { filter: drop-shadow(0 0 5px rgba(6, 182, 212, 0.3)); }
      50% { filter: drop-shadow(0 0 20px rgba(6, 182, 212, 0.6)); }
    }

    /* Shimmer Effect */
    .shimmer {
      position: relative;
      overflow: hidden;
    }

    .shimmer::after {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }

    /* Social Button Hover Effects */
    .social-btn {
      transition: all 0.3s ease;
      background: rgba(30, 41, 59, 0.2);
      border: 1px solid rgba(148, 163, 184, 0.1);
    }

    .social-btn:hover {
      background: rgba(30, 41, 59, 0.4);
      border-color: rgba(6, 182, 212, 0.3);
      transform: translateY(-2px);
      box-shadow:
        0 10px 25px rgba(0, 0, 0, 0.15),
        0 0 20px rgba(6, 182, 212, 0.1);
    }

    /* Fade In Animation */
    .fade-in {
      animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    /* Loading Spinner */
    .loading-spinner {
      border: 2px solid rgba(226, 232, 240, 0.3);
      border-top: 2px solid #06b6d4;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: rgba(15, 23, 42, 0.5);
    }

    ::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, #06b6d4, #3b82f6);
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(180deg, #0891b2, #2563eb);
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
  <!-- Floating Particles -->
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>

  <!-- Main Container -->
  <div class="w-full max-w-md fade-in relative z-10">
    <!-- Logo Section -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center space-x-3 mb-6">
        <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-800/50 border border-cyan-500/20 logo-glow">
          <img src="/assets/logo.jpeg" alt="SoftEdge Logo" class="w-full h-full object-cover">
        </div>
        <span class="text-xl font-bold text-white tracking-tight bg-linear-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
          SoftEdge
        </span>
      </div>

      <h1 class="text-3xl font-bold text-white mb-3 typing-text">
        Bem-vindo de volta
      </h1>
      <p class="text-slate-300 text-sm opacity-80">
        Entre na sua conta para continuar
      </p>
    </div>

    <!-- Login Form -->
    <div class="glass-card neon-border rounded-2xl p-8 relative">
      <!-- Success Message -->
      <?php if ($loginSuccess): ?>
        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-lg backdrop-blur-sm">
          <div class="flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-green-400"></i>
            <span class="text-green-400 text-sm font-medium"><?php echo htmlspecialchars($loginSuccess); ?></span>
          </div>
        </div>
      <?php endif; ?>

      <!-- Error Message -->
      <?php if ($loginError): ?>
        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg backdrop-blur-sm">
          <div class="flex items-center gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 text-red-400"></i>
            <span class="text-red-400 text-sm font-medium"><?php echo htmlspecialchars($loginError); ?></span>
          </div>
        </div>
      <?php endif; ?>

      <form method="POST" class="space-y-6" id="loginForm">
        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(\SoftEdge\Csrf::token()); ?>">

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-slate-200 mb-2">
            Email
          </label>
          <div class="relative">
            <input
              type="email"
              id="email"
              name="email"
              required
              class="input-focus w-full px-4 py-3 rounded-lg text-white placeholder-slate-400 focus:outline-none transition-all pr-12"
              placeholder="seu@email.com"
              value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
            >
            <i data-lucide="mail" class="absolute right-3 top-3.5 w-5 h-5 text-slate-400"></i>
          </div>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-slate-200 mb-2">
            Senha
          </label>
          <div class="relative">
            <input
              type="password"
              id="password"
              name="password"
              required
              class="input-focus w-full px-4 py-3 rounded-lg text-white placeholder-slate-400 focus:outline-none transition-all pr-12"
              placeholder="••••••••"
            >
            <button type="button" class="absolute right-3 top-3.5 text-slate-400 hover:text-cyan-400 transition-colors" id="togglePassword">
              <i data-lucide="eye" class="w-5 h-5"></i>
            </button>
          </div>
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
          <label class="flex items-center group cursor-pointer">
            <input type="checkbox" class="rounded border-slate-600 bg-slate-800/50 text-cyan-500 focus:ring-cyan-500 group-hover:border-cyan-400 transition-colors">
            <span class="ml-2 text-sm text-slate-400 group-hover:text-slate-300 transition-colors">Lembrar-me</span>
          </label>
          <a href="forgot-password.php" class="text-sm text-slate-400 hover:text-cyan-400 transition-colors">
            Esqueceu a senha?
          </a>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          name="login"
          class="w-full bg-linear-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/25 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-slate-900 shimmer"
          id="loginBtn"
        >
          <span class="flex items-center justify-center gap-2">
            <span>Entrar</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
          </span>
        </button>
      </form>

      <!-- Divider -->
      <div class="relative my-8">
        <div class="absolute inset-0 flex items-center">
          <div class="w-full border-t border-slate-600/50"></div>
        </div>
        <div class="relative flex justify-center">
          <span class="px-4 bg-slate-900/50 text-slate-400 text-sm backdrop-blur-sm rounded-full">ou</span>
        </div>
      </div>

      <!-- Social Login -->
      <div class="space-y-3">
        <?php if ($googleLoginUrl): ?>
          <a href="<?php echo htmlspecialchars($googleLoginUrl); ?>"
             class="social-btn w-full flex items-center justify-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:text-white transition-all group">
            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
              <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
              <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
              <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
              <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            <span class="font-medium">Continuar com Google</span>
          </a>
        <?php endif; ?>

        <?php if ($githubLoginUrl): ?>
          <a href="<?php echo htmlspecialchars($githubLoginUrl); ?>"
             class="social-btn w-full flex items-center justify-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:text-white transition-all group">
            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
            </svg>
            <span class="font-medium">Continuar com GitHub</span>
          </a>
        <?php endif; ?>
      </div>

      <!-- Sign Up Link -->
      <div class="text-center mt-8">
        <p class="text-slate-400">
          Não tem uma conta?
          <a href="register.php" class="text-cyan-400 hover:text-cyan-300 font-medium transition-colors hover:underline">
            Criar conta
          </a>
        </p>
      </div>
    </div>

    <!-- Back to Home -->
    <div class="text-center mt-8">
      <a href="index.php" class="inline-flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors group">
        <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
        <span class="text-sm">Voltar ao início</span>
      </a>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Initialize Lucide icons
      lucide.createIcons();

      // Password toggle with animation
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');

      togglePassword?.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        const icon = togglePassword.querySelector('i');
        icon.setAttribute('data-lucide', type === 'password' ? 'eye' : 'eye-off');
        lucide.createIcons();

        // Add subtle animation
        icon.style.transform = 'scale(1.2)';
        setTimeout(() => {
          icon.style.transform = 'scale(1)';
        }, 150);
      });

      // Form submission with enhanced feedback
      const loginForm = document.getElementById('loginForm');
      const loginBtn = document.getElementById('loginBtn');

      loginForm?.addEventListener('submit', (e) => {
        loginBtn.disabled = true;
        loginBtn.innerHTML = '<div class="loading-spinner mx-auto"></div>';

        // Add loading state to form
        loginForm.style.opacity = '0.7';
        loginForm.style.pointerEvents = 'none';

        // Re-enable after 5 seconds as fallback
        setTimeout(() => {
          loginBtn.disabled = false;
          loginBtn.innerHTML = `
            <span class="flex items-center justify-center gap-2">
              <span>Entrar</span>
              <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </span>
          `;
          loginForm.style.opacity = '1';
          loginForm.style.pointerEvents = 'auto';
          lucide.createIcons();
        }, 5000);
      });

      // Auto-focus email field with smooth animation
      const emailField = document.getElementById('email');
      if (emailField) {
        setTimeout(() => {
          emailField.focus();
          emailField.style.transform = 'scale(1.02)';
          setTimeout(() => {
            emailField.style.transform = 'scale(1)';
          }, 200);
        }, 1000);
      }

      // Add subtle animations to social buttons
      document.querySelectorAll('.social-btn').forEach(btn => {
        btn.addEventListener('mouseenter', () => {
          btn.style.transform = 'translateY(-2px) scale(1.02)';
        });

        btn.addEventListener('mouseleave', () => {
          btn.style.transform = 'translateY(0) scale(1)';
        });
      });

      // Typing effect for welcome text
      const typingText = document.querySelector('.typing-text');
      if (typingText) {
        typingText.style.width = '0';
        setTimeout(() => {
          typingText.style.width = '100%';
        }, 500);
      }
    });
  </script>
</body>
</html>
