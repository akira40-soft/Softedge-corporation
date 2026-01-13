<?php
// Start session and check authentication
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user']) || !isset($_SESSION['session_token'])) {
    header('Location: login.php');
    exit;
}

// Autoload Composer dependencies
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

// Initialize User class
$user = new \SoftEdge\User();

// Validate session
$sessionUser = $user->validateSession($_SESSION['session_token']);
if (!$sessionUser || $sessionUser['role'] !== 'admin') {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Get admin statistics
$stats = $user->getAdminStats();

// Log admin page visit
$user->logPageVisit($sessionUser['id'], 'admin_dashboard', $_SERVER['HTTP_USER_AGENT'] ?? '');

// Handle logout
if (isset($_POST['logout'])) {
    // Invalidate session
    try {
        $db = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASS']);
        $stmt = $db->prepare("DELETE FROM user_sessions WHERE session_token = ?");
        $stmt->execute([$_SESSION['session_token']]);
    } catch (Exception $e) {
        error_log("Session cleanup failed: " . $e->getMessage());
    }

    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Painel Administrativo - SoftEdge Corporation</title>

  <!-- SEO -->
  <meta name="description" content="Painel administrativo SoftEdge Corporation">
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

  <!-- Chart.js for analytics -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    .glass-card {
      background: rgba(30, 41, 59, 0.8);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(148, 163, 184, 0.1);
    }

    .stat-card {
      transition: all 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .fade-in {
      animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .sidebar {
      transform: translateX(-100%);
      transition: transform 0.3s ease;
    }

    .sidebar.open {
      transform: translateX(0);
    }

    @media (min-width: 768px) {
      .sidebar {
        transform: translateX(0);
      }
    }
  </style>
</head>

<body class="bg-slate-950 min-h-screen">
  <!-- Sidebar -->
  <div class="sidebar fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 border-r border-slate-700 md:relative md:translate-x-0">
    <div class="flex flex-col h-full">
      <!-- Logo -->
      <div class="flex items-center justify-center p-6 border-b border-slate-700">
        <div class="flex items-center space-x-3">
          <div class="w-8 h-8 rounded-lg overflow-hidden bg-slate-700 border border-slate-600">
            <img src="/assets/logo.jpeg" alt="SoftEdge Logo" class="w-full h-full object-cover">
          </div>
          <span class="text-lg font-semibold text-slate-200 tracking-tight">
            Admin Panel
          </span>
        </div>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="#dashboard" class="nav-link flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-800 rounded-lg transition-colors active">
          <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
          <span>Dashboard</span>
        </a>

        <a href="#users" class="nav-link flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-colors">
          <i data-lucide="users" class="w-5 h-5"></i>
          <span>Usuários</span>
        </a>

        <a href="#analytics" class="nav-link flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-colors">
          <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
          <span>Analytics</span>
        </a>

        <a href="#settings" class="nav-link flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-colors">
          <i data-lucide="settings" class="w-5 h-5"></i>
          <span>Configurações</span>
        </a>
      </nav>

      <!-- User Info & Logout -->
      <div class="p-4 border-t border-slate-700">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center">
            <i data-lucide="user" class="w-4 h-4 text-slate-400"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-slate-200 truncate">
              <?php echo htmlspecialchars($sessionUser['name']); ?>
            </p>
            <p class="text-xs text-slate-400">Administrador</p>
          </div>
        </div>

        <form method="POST" class="w-full">
          <button type="submit" name="logout" class="w-full flex items-center gap-3 px-4 py-2 text-slate-400 hover:text-white hover:bg-red-500/10 hover:border-red-500/20 border border-transparent rounded-lg transition-all">
            <i data-lucide="log-out" class="w-4 h-4"></i>
            <span class="text-sm">Sair</span>
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Mobile Overlay -->
  <div class="sidebar-overlay fixed inset-0 bg-black/50 z-40 md:hidden opacity-0 pointer-events-none transition-opacity"></div>

  <!-- Main Content -->
  <div class="md:ml-64">
    <!-- Header -->
    <header class="bg-slate-900/50 backdrop-blur-xl border-b border-slate-700 p-4 md:p-6">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
          <button class="md:hidden text-slate-400 hover:text-white p-2" id="sidebarToggle">
            <i data-lucide="menu" class="w-6 h-6"></i>
          </button>
          <div>
            <h1 class="text-2xl font-bold text-white">Dashboard Administrativo</h1>
            <p class="text-slate-400 text-sm">Bem-vindo de volta, <?php echo htmlspecialchars(explode(' ', $sessionUser['name'])[0]); ?>!</p>
          </div>
        </div>

        <div class="flex items-center gap-4">
          <div class="hidden md:flex items-center gap-2 text-slate-400 text-sm">
            <i data-lucide="clock" class="w-4 h-4"></i>
            <span><?php echo date('d/m/Y H:i'); ?></span>
          </div>
        </div>
      </div>
    </header>

    <!-- Dashboard Content -->
    <main class="p-4 md:p-6 space-y-6">
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="stat-card glass-card p-6 rounded-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-slate-400 text-sm font-medium">Total de Usuários</p>
              <p class="text-2xl font-bold text-white"><?php echo number_format($stats['total_users'] ?? 0); ?></p>
            </div>
            <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
              <i data-lucide="users" class="w-6 h-6 text-blue-400"></i>
            </div>
          </div>
        </div>

        <div class="stat-card glass-card p-6 rounded-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-slate-400 text-sm font-medium">Total de Visitas</p>
              <p class="text-2xl font-bold text-white"><?php echo number_format($stats['total_visits'] ?? 0); ?></p>
            </div>
            <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
              <i data-lucide="eye" class="w-6 h-6 text-green-400"></i>
            </div>
          </div>
        </div>

        <div class="stat-card glass-card p-6 rounded-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-slate-400 text-sm font-medium">Visitas (30 dias)</p>
              <p class="text-2xl font-bold text-white"><?php echo number_format($stats['recent_visits'] ?? 0); ?></p>
            </div>
            <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
              <i data-lucide="trending-up" class="w-6 h-6 text-purple-400"></i>
            </div>
          </div>
        </div>

        <div class="stat-card glass-card p-6 rounded-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-slate-400 text-sm font-medium">Taxa de Conversão</p>
              <p class="text-2xl font-bold text-white">
                <?php
                  $conversion = $stats['total_users'] > 0 ? (($stats['total_visits'] ?? 0) / $stats['total_users']) : 0;
                  echo number_format($conversion, 1);
                ?>x
              </p>
            </div>
            <div class="w-12 h-12 bg-orange-500/20 rounded-lg flex items-center justify-center">
              <i data-lucide="target" class="w-6 h-6 text-orange-400"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Charts and Tables -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Pages Chart -->
        <div class="glass-card p-6 rounded-xl">
          <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
            <i data-lucide="bar-chart-3" class="w-5 h-5 text-slate-400"></i>
            Páginas Mais Visitadas
          </h3>
          <div class="space-y-3">
            <?php foreach (($stats['top_pages'] ?? []) as $page): ?>
              <div class="flex items-center justify-between p-3 bg-slate-800/50 rounded-lg">
                <span class="text-slate-300 capitalize"><?php echo htmlspecialchars($page['page']); ?></span>
                <span class="text-slate-400 text-sm"><?php echo number_format($page['visits']); ?> visitas</span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Recent Users -->
        <div class="glass-card p-6 rounded-xl">
          <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
            <i data-lucide="user-plus" class="w-5 h-5 text-slate-400"></i>
            Usuários Recentes
          </h3>
          <div class="space-y-3">
            <?php foreach (($stats['recent_users'] ?? []) as $recentUser): ?>
              <div class="flex items-center gap-3 p-3 bg-slate-800/50 rounded-lg">
                <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center">
                  <i data-lucide="user" class="w-4 h-4 text-slate-400"></i>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="text-slate-300 text-sm font-medium truncate"><?php echo htmlspecialchars($recentUser['name']); ?></p>
                  <p class="text-slate-400 text-xs"><?php echo date('d/m/Y', strtotime($recentUser['created_at'])); ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- System Info -->
      <div class="glass-card p-6 rounded-xl">
        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
          <i data-lucide="server" class="w-5 h-5 text-slate-400"></i>
          Informações do Sistema
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="p-4 bg-slate-800/50 rounded-lg">
            <p class="text-slate-400 text-sm">PHP Version</p>
            <p class="text-white font-medium"><?php echo PHP_VERSION; ?></p>
          </div>
          <div class="p-4 bg-slate-800/50 rounded-lg">
            <p class="text-slate-400 text-sm">Database</p>
            <p class="text-white font-medium">MySQL</p>
          </div>
          <div class="p-4 bg-slate-800/50 rounded-lg">
            <p class="text-slate-400 text-sm">Último Backup</p>
            <p class="text-white font-medium"><?php echo date('d/m/Y H:i'); ?></p>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Scripts -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Initialize Lucide icons
      lucide.createIcons();

      // Sidebar toggle for mobile
      const sidebar = document.querySelector('.sidebar');
      const overlay = document.querySelector('.sidebar-overlay');
      const sidebarToggle = document.getElementById('sidebarToggle');

      const toggleSidebar = () => {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('opacity-0');
        overlay.classList.toggle('pointer-events-none');
      };

      sidebarToggle?.addEventListener('click', toggleSidebar);
      overlay?.addEventListener('click', toggleSidebar);

      // Navigation active state
      const navLinks = document.querySelectorAll('.nav-link');
      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();

          // Remove active class from all links
          navLinks.forEach(l => l.classList.remove('active', 'text-white'));
          navLinks.forEach(l => l.classList.add('text-slate-400'));

          // Add active class to clicked link
          this.classList.add('active', 'text-white');
          this.classList.remove('text-slate-400');

          // Close sidebar on mobile
          if (window.innerWidth < 768) {
            toggleSidebar();
          }
        });
      });

      // Auto-refresh stats every 30 seconds
      setInterval(() => {
        // In a real application, you might want to implement AJAX calls here
        // to refresh the statistics without reloading the page
        console.log('Refreshing stats...');
      }, 30000);
    });
  </script>
</body>
</html>
