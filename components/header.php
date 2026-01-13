<!-- components/header.php -->
<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SoftEdge Corporation - Soluções em Tecnologia</title>

  <!-- SEO & SOCIAL -->
  <meta name="description" content="SoftEdge Corporation - Inovação em desenvolvimento de software, soluções digitais e consultoria tecnológica em Angola.">
  <meta name="keywords" content="software, tecnologia, desenvolvimento, Angola, Luanda">
  
  <!-- FAVICON -->
  <link rel="icon" href="/assets/placeholder.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="/assets/placeholder.svg">
  <meta property="og:image" content="https://softedge-corporation.up.railway.app/assets/placeholder.svg" />
  <meta property="og:title" content="SoftEdge Corporation" />
  <meta property="og:description" content="Soluções em tecnologia para transformar seu negócio" />
  <meta name="twitter:image" content="https://softedge-corporation.up.railway.app/assets/placeholder.svg" />
  <meta name="theme-color" content="#0891b2">

  <!-- FONTS (Inter - moderno e profissional) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  
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
              50: '#ecfeff',
              100: '#cffafe',
              500: '#06b6d4',
              600: '#0891b2',
              700: '#0e7490',
              900: '#164e63',
            }
          }
        }
      }
    }
  </script>
  
  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
  
  <!-- CSS Personalizado -->
  <link href="/assets/css/style.css" rel="stylesheet">

  <style>
    /* Smooth transitions */
    * {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Header glass effect */
    .glass-header {
      background: rgba(0, 0, 0, 0.8);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Logo hover effect */
    .logo-container {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .logo-container:hover {
      transform: scale(1.05);
    }

    /* Menu links */
    .nav-link {
      position: relative;
      transition: color 0.3s ease;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #06b6d4, #3b82f6);
      transition: width 0.3s ease;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    /* Dropdown animations */
    .dropdown-menu {
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px) scale(0.95);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dropdown:hover .dropdown-menu,
    .dropdown-menu:hover {
      opacity: 1;
      visibility: visible;
      transform: translateY(0) scale(1);
    }

    /* Mobile menu */
    .mobile-menu {
      transform: translateX(100%);
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .mobile-menu.active {
      transform: translateX(0);
    }

    /* CTA Button */
    .cta-button {
      background: linear-gradient(135deg, #06b6d4, #3b82f6);
      transition: all 0.4s ease;
      box-shadow: 0 10px 30px -10px rgba(6, 182, 212, 0.4);
    }

    .cta-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 20px 40px -10px rgba(6, 182, 212, 0.6);
    }

    /* Chevron rotation */
    .chevron-rotate {
      transition: transform 0.3s ease;
    }

    .dropdown:hover .chevron-rotate {
      transform: rotate(180deg);
    }

    /* Mobile overlay */
    .mobile-overlay {
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
    }
  </style>
</head>

<body class="min-h-screen bg-linear-to-br from-slate-950 via-slate-900 to-slate-950 text-white antialiased font-sans">

<!-- ==================== HEADER ==================== -->
<header class="fixed inset-x-0 top-0 z-50 glass-header">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-20">
      
      <!-- ========== LOGO ========== -->
      <a href="index.php" class="flex items-center space-x-3 logo-container">
        <div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-700 border border-slate-600">
          <img src="/assets/logo.jpeg" alt="SoftEdge Logo" class="w-full h-full object-cover">
        </div>
        <div class="flex flex-col">
          <span class="text-lg font-semibold text-slate-200 tracking-tight">
            SoftEdge Corporation
          </span>
          <span class="text-xs text-slate-400 hidden sm:block">
            Tecnologia Empresarial
          </span>
        </div>
      </a>

      <!-- ========== DESKTOP NAVIGATION ========== -->
      <nav class="hidden lg:flex items-center space-x-8">
        <a href="index.php" class="nav-link text-white/90 hover:text-cyan-400 font-medium text-sm">
          Início
        </a>
        
        <!-- Dropdown Empresa -->
        <div class="relative dropdown">
          <button class="nav-link flex items-center gap-1.5 text-white/90 hover:text-cyan-400 font-medium text-sm focus:outline-none">
            Empresa
            <i data-lucide="chevron-down" class="w-4 h-4 chevron-rotate"></i>
          </button>

          <!-- Submenu -->
          <div class="dropdown-menu absolute top-full left-1/2 -translate-x-1/2 mt-4 w-64">
            <div class="bg-slate-900/95 backdrop-blur-xl rounded-2xl border border-white/10 shadow-2xl overflow-hidden">
              <a href="sobre.php" class="flex items-center gap-4 px-6 py-4 hover:bg-white/5 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-cyan-500/10 flex items-center justify-center group-hover:bg-cyan-500/20 transition-colors">
                  <i data-lucide="users" class="w-5 h-5 text-cyan-400"></i>
                </div>
                <div>
                  <div class="font-semibold text-white text-sm">Sobre Nós</div>
                  <div class="text-xs text-gray-400">Nossa história</div>
                </div>
              </a>
              <a href="projetos.php" class="flex items-center gap-4 px-6 py-4 hover:bg-white/5 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center group-hover:bg-blue-500/20 transition-colors">
                  <i data-lucide="folder-open" class="w-5 h-5 text-blue-400"></i>
                </div>
                <div>
                  <div class="font-semibold text-white text-sm">Projetos</div>
                  <div class="text-xs text-gray-400">Portfolio completo</div>
                </div>
              </a>
            </div>
          </div>
        </div>

        <a href="servicos.php" class="nav-link text-white/90 hover:text-cyan-400 font-medium text-sm">
          Serviços
        </a>

        <a href="contato.php" class="nav-link text-white/90 hover:text-cyan-400 font-medium text-sm">
          Contato
        </a>

        <!-- CTA Button -->
        <a href="https://whatsapp.com/channel/0029VawQLpGHltY2Y87fR83m" 
           target="_blank"
           rel="noopener noreferrer"
           class="cta-button px-6 py-2.5 rounded-full font-semibold text-white text-sm flex items-center gap-2">
          <i data-lucide="message-circle" class="w-4 h-4"></i>
          WhatsApp
        </a>
      </nav>

      <!-- ========== MOBILE MENU BUTTON ========== -->
      <button id="mobile-menu-btn" 
              class="lg:hidden p-2.5 rounded-xl bg-white/10 hover:bg-white/20 transition-colors"
              aria-label="Menu">
        <i data-lucide="menu" class="w-6 h-6 text-white"></i>
      </button>
    </div>
  </div>
</header>

<!-- ========== MOBILE MENU ========== -->
<div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 mobile-overlay z-40 hidden lg:hidden"></div>

<aside id="mobile-menu" class="mobile-menu fixed top-0 right-0 bottom-0 w-full max-w-sm bg-slate-900 z-50 lg:hidden shadow-2xl">
  <div class="flex flex-col h-full">
    <!-- Header -->
    <div class="flex items-center justify-between p-6 border-b border-white/10">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg overflow-hidden bg-linear-to-br from-cyan-500 to-blue-600">
          <img src="/assets/placeholder.svg" alt="SoftEdge" class="w-full h-full object-cover">
        </div>
        <span class="text-lg font-bold bg-linear-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
          SoftEdge
        </span>
      </div>
      <button id="mobile-menu-close" class="p-2 rounded-lg hover:bg-white/10 transition-colors">
        <i data-lucide="x" class="w-6 h-6 text-white"></i>
      </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto p-6">
      <div class="space-y-1">
        <a href="index.php" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-700 transition-colors text-slate-200">
          <i data-lucide="home" class="w-5 h-5"></i>
          <span class="font-medium">Início</span>
        </a>

        <a href="sobre.php" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-700 transition-colors text-slate-200">
          <i data-lucide="building" class="w-5 h-5"></i>
          <span class="font-medium">Empresa</span>
        </a>

        <a href="servicos.php" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-700 transition-colors text-slate-200">
          <i data-lucide="briefcase" class="w-5 h-5"></i>
          <span class="font-medium">Serviços</span>
        </a>

        <a href="projetos.php" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-700 transition-colors text-slate-200">
          <i data-lucide="folder-open" class="w-5 h-5"></i>
          <span class="font-medium">Projetos</span>
        </a>

        <a href="contato.php" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-700 transition-colors text-slate-200">
          <i data-lucide="mail" class="w-5 h-5"></i>
          <span class="font-medium">Contato</span>
        </a>
      </div>

      <!-- CTA Mobile -->
      <div class="mt-8">
        <a href="https://whatsapp.com/channel/0029VawQLpGHltY2Y87fR83m"
           target="_blank"
           rel="noopener noreferrer"
           class="flex items-center justify-center gap-3 w-full px-6 py-4 rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-200 font-medium transition-colors border border-slate-600">
          <i data-lucide="message-circle" class="w-5 h-5"></i>
          Contato
        </a>
      </div>
    </nav>
  </div>
</aside>

<!-- ========== JAVASCRIPT ========== -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons
    lucide.createIcons();

    // Mobile menu elements
    const menuBtn = document.getElementById('mobile-menu-btn');
    const menuClose = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuOverlay = document.getElementById('mobile-menu-overlay');

    // Open mobile menu
    menuBtn?.addEventListener('click', () => {
      mobileMenu.classList.add('active');
      menuOverlay.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    });

    // Close mobile menu
    const closeMobileMenu = () => {
      mobileMenu.classList.remove('active');
      menuOverlay.classList.add('hidden');
      document.body.style.overflow = '';
    };

    menuClose?.addEventListener('click', closeMobileMenu);
    menuOverlay?.addEventListener('click', closeMobileMenu);

    // Close on navigation
    document.querySelectorAll('#mobile-menu a').forEach(link => {
      link.addEventListener('click', closeMobileMenu);
    });

    // Escape key to close
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
        closeMobileMenu();
      }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  });
</script>

<!-- Spacer for fixed header -->
<div class="h-20"></div>
