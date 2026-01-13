<?php include 'components/header.php'; ?>

<!-- HERO SECTION -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
  <!-- Modern Sea Background -->
  <div class="fixed inset-0 -z-10">
    <div class="absolute inset-0">
      <img src="/assets/mar.jpg" alt="Sea Background" class="w-full h-full object-cover fixed">
    </div>
    <div class="absolute inset-0 bg-linear-to-br from-slate-950/85 via-slate-900/75 to-slate-950/85 backdrop-blur-[1px] -webkit-backdrop-filter-blur-[1px]"></div>
  </div>

  <!-- Floating Particles -->
  <div class="fixed inset-0 pointer-events-none -z-5">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
  </div>

  <!-- Content -->
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center space-y-12">

      <!-- Badge -->
      <div class="inline-block px-4 py-2 bg-cyan-500/10 rounded-full border border-cyan-500/20 backdrop-blur-sm fade-in-up">
        <span class="text-cyan-400 text-xs sm:text-sm font-semibold uppercase tracking-wider">
          💻 SoftEdge Corporation
        </span>
      </div>

      <!-- Main Heading -->
      <div class="space-y-6">
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-bold leading-tight fade-in-up stagger-1">
          <span class="block text-white mb-2">Transformando ideias</span>
          <span class="block text-gradient-animated">
            em realidade digital
          </span>
        </h1>

        <p class="text-base sm:text-lg md:text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed fade-in-up stagger-2">
          Somos especialistas em desenvolvimento de software, soluções tecnológicas e consultoria digital.
          <br class="hidden sm:block">
          Transformamos seu negócio com tecnologia de ponta.
        </p>
      </div>

      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 lg:gap-6 fade-in-up stagger-3">
        <a href="servicos.php"
           class="inline-flex items-center justify-center gap-3 bg-slate-700 hover:bg-slate-600 border border-slate-600 text-slate-200 font-medium text-lg px-8 py-4 rounded-lg transition-all duration-300">
          Nossos Serviços
          <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </a>

        <a href="contato.php"
           class="inline-flex items-center justify-center gap-3 bg-slate-800/50 hover:bg-slate-700/50 border border-slate-600 text-slate-300 font-medium text-lg px-8 py-4 rounded-lg transition-all duration-300">
          Falar Conosco
          <i data-lucide="message-circle" class="w-5 h-5"></i>
        </a>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 mt-16 max-w-4xl mx-auto fade-in-up stagger-4">
        <!-- Stat 1 -->
        <div class="stat-card">
          <div class="text-3xl sm:text-4xl md:text-5xl font-bold bg-linear-to-br from-cyan-400 to-cyan-600 bg-clip-text text-transparent mb-2">
            70+
          </div>
          <p class="text-gray-400 text-sm">Projetos Entregues</p>
        </div>

        <!-- Stat 2 -->
        <div class="stat-card">
          <div class="text-3xl sm:text-4xl md:text-5xl font-bold bg-linear-to-br from-blue-400 to-blue-600 bg-clip-text text-transparent mb-2">
            4.9★
          </div>
          <p class="text-gray-400 text-sm">Satisfação</p>
        </div>

        <!-- Stat 3 -->
        <div class="stat-card">
          <div class="text-3xl sm:text-4xl md:text-5xl font-bold bg-linear-to-br from-purple-400 to-purple-600 bg-clip-text text-transparent mb-2">
            24/7
          </div>
          <p class="text-gray-400 text-sm">Suporte</p>
        </div>

        <!-- Stat 4 -->
        <div class="stat-card">
          <div class="text-3xl sm:text-4xl md:text-5xl font-bold bg-linear-to-br from-green-400 to-green-600 bg-clip-text text-transparent mb-2">
            100%
          </div>
          <p class="text-gray-400 text-sm">Código Limpo</p>
        </div>
      </div>

    </div>
  </div>

  <!-- Scroll indicator -->
  <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce fade-in-up stagger-5">
    <i data-lucide="chevron-down" class="w-8 h-8 text-white/40"></i>
  </div>
</section>

<!-- REACT INTEGRATION SECTION -->
<section class="relative py-20 lg:py-32 bg-slate-900/50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <div class="inline-block px-4 py-2 bg-cyan-500/10 rounded-full border border-cyan-500/20 mb-4">
        <span class="text-cyan-400 text-sm font-semibold uppercase tracking-wider">🚀 React Integration</span>
      </div>
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white">
        Tecnologia Moderna em Ação
      </h2>
      <p class="text-gray-300 text-lg max-w-2xl mx-auto mt-4">
        Integramos React com PHP para oferecer a melhor experiência possível aos nossos usuários.
      </p>
    </div>

    <!-- React App Container -->
    <div class="relative">
      <div class="absolute inset-0 bg-linear-to-r from-cyan-500/10 via-blue-500/10 to-purple-500/10 rounded-3xl blur-3xl"></div>
      <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/10 rounded-3xl p-8 lg:p-12">
        <!-- React App será carregado aqui -->
        <div id="react-app" class="min-h-[600px] flex items-center justify-center">
          <div class="text-center space-y-6">
            <div class="w-20 h-20 bg-cyan-500/20 rounded-full flex items-center justify-center mx-auto animate-pulse">
              <i data-lucide="code-2" class="w-10 h-10 text-cyan-400"></i>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-white mb-2">Aplicação React Carregando...</h3>
              <p class="text-gray-400 text-lg">Demonstração de integração React + PHP</p>
            </div>
            <div class="flex flex-wrap justify-center gap-4">
              <div class="px-4 py-2 bg-cyan-500/20 border border-cyan-500/30 rounded-lg">
                <span class="text-cyan-400 font-medium">React 18.2.0</span>
              </div>
              <div class="px-4 py-2 bg-blue-500/20 border border-blue-500/30 rounded-lg">
                <span class="text-blue-400 font-medium">Webpack 5</span>
              </div>
              <div class="px-4 py-2 bg-purple-500/20 border border-purple-500/30 rounded-lg">
                <span class="text-purple-400 font-medium">Babel 7</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Integration Info -->
    <div class="mt-12 grid md:grid-cols-3 gap-8 text-center">
      <div class="space-y-4">
        <div class="w-12 h-12 bg-cyan-500/20 rounded-xl flex items-center justify-center mx-auto">
          <i data-lucide="zap" class="w-6 h-6 text-cyan-400"></i>
        </div>
        <h3 class="text-xl font-bold text-white">Performance</h3>
        <p class="text-gray-400">Componentes React otimizados com lazy loading e code splitting</p>
      </div>

      <div class="space-y-4">
        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mx-auto">
          <i data-lucide="shield" class="w-6 h-6 text-blue-400"></i>
        </div>
        <h3 class="text-xl font-bold text-white">Segurança</h3>
        <p class="text-gray-400">Integração segura com APIs PHP protegidas por CSRF e rate limiting</p>
      </div>

      <div class="space-y-4">
        <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mx-auto">
          <i data-lucide="smartphone" class="w-6 h-6 text-purple-400"></i>
        </div>
        <h3 class="text-xl font-bold text-white">Responsivo</h3>
        <p class="text-gray-400">Interface adaptável que funciona perfeitamente em todos os dispositivos</p>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES PREVIEW -->
<section class="relative py-20 lg:py-32">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Section Header -->
    <div class="text-center mb-16">
      <div class="inline-block px-4 py-2 bg-cyan-500/10 rounded-full border border-cyan-500/20 mb-4 fade-in-up">
        <span class="text-cyan-400 text-sm font-semibold uppercase tracking-wider">O que fazemos</span>
      </div>
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white fade-in-up stagger-1">
        Serviços especializados para seu negócio
      </h2>
    </div>

    <!-- Services Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

      <!-- Service 1 -->
      <div class="service-card fade-in-up stagger-1">
        <div class="service-icon">
          <i data-lucide="code-2" class="w-7 h-7 text-white"></i>
        </div>
        <h3 class="text-xl font-bold text-white mb-4">Desenvolvimento Full Stack</h3>
        <p class="text-gray-300 leading-relaxed mb-6">
          Criamos aplicações web e mobile completas com as tecnologias mais modernas do mercado.
        </p>
        <a href="servicos.php" class="inline-flex items-center gap-2 text-cyan-400 hover:text-cyan-300 font-medium transition-colors">
          Saiba mais
          <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
      </div>

      <!-- Service 2 -->
      <div class="service-card fade-in-up stagger-2">
        <div class="service-icon">
          <i data-lucide="brain" class="w-7 h-7 text-white"></i>
        </div>
        <h3 class="text-xl font-bold text-white mb-4">IA & Automação</h3>
        <p class="text-gray-300 leading-relaxed mb-6">
          Implementamos inteligência artificial e automação para otimizar processos e aumentar eficiência.
        </p>
        <a href="servicos.php" class="inline-flex items-center gap-2 text-purple-400 hover:text-purple-300 font-medium transition-colors">
          Saiba mais
          <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
      </div>

      <!-- Service 3 -->
      <div class="service-card fade-in-up stagger-3">
        <div class="service-icon">
          <i data-lucide="zap" class="w-7 h-7 text-white"></i>
        </div>
        <h3 class="text-xl font-bold text-white mb-4">Consultoria & Performance</h3>
        <p class="text-gray-300 leading-relaxed mb-6">
          Otimizamos sistemas existentes e oferecemos consultoria especializada para máxima performance.
        </p>
        <a href="servicos.php" class="inline-flex items-center gap-2 text-green-400 hover:text-green-300 font-medium transition-colors">
          Saiba mais
          <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
      </div>

    </div>

    <!-- CTA -->
    <div class="text-center mt-12 fade-in-up stagger-4">
      <a href="servicos.php"
         class="inline-flex items-center gap-3 bg-slate-700 hover:bg-slate-600 border border-slate-600 text-slate-200 font-medium text-lg px-8 py-4 rounded-lg transition-all duration-300">
        Ver todos os serviços
        <i data-lucide="arrow-right" class="w-5 h-5"></i>
      </a>
    </div>
  </div>
</section>

<!-- CTA FINAL -->
<section class="relative py-20 lg:py-32">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="relative fade-in-up">
      <div class="absolute inset-0 bg-linear-to-r from-cyan-500/10 via-blue-500/10 to-purple-500/10 rounded-3xl blur-3xl"></div>

      <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/10 rounded-3xl p-8 lg:p-12">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
          Pronto para transformar seu negócio?
        </h2>

        <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-10">
          Entre em contato hoje mesmo e descubra como podemos ajudar você a alcançar seus objetivos com tecnologia de ponta.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="contato.php"
             class="btn-primary magnetic">
            Começar Projeto
            <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
          </a>

          <a href="projetos.php"
             class="inline-flex items-center gap-3 w-full sm:w-auto bg-slate-800/50 hover:bg-slate-700/50 backdrop-blur-xl border border-white/10 text-white font-semibold text-lg px-10 py-4 rounded-full transition-all duration-300 magnetic">
            Ver Portfolio
            <i data-lucide="folder-open" class="w-5 h-5"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'components/footer.php'; ?>

<!-- SCRIPTS -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons
    lucide.createIcons();

    // Intersection Observer for scroll animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          // Add staggered animation delay
          const delay = index * 100;
          setTimeout(() => {
            entry.target.classList.add('scroll-fade-in', 'in-view');
          }, delay);
        }
      });
    }, observerOptions);

    // Observe elements for scroll animations
    document.querySelectorAll('.service-card, .stat-card, .fade-in-up').forEach(el => {
      observer.observe(el);
    });

    // Smooth scroll for chevron
    document.querySelector('.animate-bounce')?.addEventListener('click', () => {
      window.scrollTo({
        top: window.innerHeight,
        behavior: 'smooth'
      });
    });

    // Magnetic effect for buttons
    document.querySelectorAll('.magnetic').forEach(btn => {
      btn.addEventListener('mousemove', (e) => {
        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;

        btn.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px) scale(1.05)`;
      });

      btn.addEventListener('mouseleave', () => {
        btn.style.transform = 'translate(0, 0) scale(1)';
      });
    });

    // Typing effect for main heading (optional)
    const mainHeading = document.querySelector('h1');
    if (mainHeading) {
      mainHeading.classList.add('typing-effect');
    }

    // Parallax effect for background orbs
    window.addEventListener('scroll', () => {
      const scrolled = window.pageYOffset;
      const rate = scrolled * -0.5;

      document.querySelectorAll('.hero-orb-1, .hero-orb-2, .hero-orb-3').forEach(orb => {
        orb.style.transform = `translateY(${rate * 0.1}px)`;
      });
    });

    // Add loading states to buttons
    document.querySelectorAll('.btn-primary, .magnetic').forEach(btn => {
      btn.addEventListener('click', function() {
        if (this.href && !this.href.includes('#')) {
          this.innerHTML = '<div class="loading-spinner mx-auto"></div>';
          this.classList.add('btn-loading');
        }
      });
    });

    // Load React app dynamically
    const loadReactApp = async () => {
      const reactContainer = document.getElementById('react-app');

      if (!reactContainer) return;

      try {
        // Check if React bundle exists
        const response = await fetch('/dist/static/js/bundle.js', { method: 'HEAD' });
        if (!response.ok) {
          throw new Error('React bundle not found');
        }

        // Load React bundle
        const script = document.createElement('script');
        script.src = '/dist/static/js/bundle.js';
        script.onload = () => {
          console.log('✅ React app loaded successfully');
          // Add class to hide loading state
          reactContainer.classList.add('react-loaded');
        };
        script.onerror = () => {
          throw new Error('Failed to load React bundle');
        };

        // Also load CSS if it exists
        const cssLink = document.createElement('link');
        cssLink.rel = 'stylesheet';
        cssLink.href = '/dist/static/css/main.css';
        cssLink.onload = () => console.log('✅ React CSS loaded');
        cssLink.onerror = () => console.warn('⚠️ React CSS not found');

        document.head.appendChild(cssLink);
        document.head.appendChild(script);

      } catch (error) {
        console.warn('⚠️ React app not available:', error.message);
        // Show fallback content
        reactContainer.innerHTML = `
          <div class="text-center space-y-6">
            <div class="w-20 h-20 bg-green-500/20 rounded-full flex items-center justify-center mx-auto">
              <i data-lucide="check-circle" class="w-10 h-10 text-green-400"></i>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-white mb-2">Integração React Configurada!</h3>
              <p class="text-gray-400 text-lg">Para ativar a aplicação React completa:</p>
            </div>
            <div class="bg-slate-800/50 rounded-lg p-4 text-left max-w-md mx-auto">
              <code class="text-cyan-400 text-sm">
                npm install<br>
                npm run build<br>
                # React estará disponível em /dist/
              </code>
            </div>
            <div class="flex flex-wrap justify-center gap-4">
              <div class="px-4 py-2 bg-cyan-500/20 border border-cyan-500/30 rounded-lg">
                <span class="text-cyan-400 font-medium">React 18.2.0</span>
              </div>
              <div class="px-4 py-2 bg-blue-500/20 border border-blue-500/30 rounded-lg">
                <span class="text-blue-400 font-medium">Webpack 5</span>
              </div>
              <div class="px-4 py-2 bg-purple-500/20 border border-purple-500/30 rounded-lg">
                <span class="text-purple-400 font-medium">Babel 7</span>
              </div>
            </div>
          </div>
        `;
        lucide.createIcons();
      }
    };

    // Load React app after page loads
    setTimeout(loadReactApp, 1000);
  });
</script>

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

  /* Glass Cards */
  .glass-card {
    background: rgba(30, 41, 59, 0.15);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border: 1px solid rgba(148, 163, 184, 0.08);
    box-shadow:
      0 8px 32px rgba(0, 0, 0, 0.12),
      inset 0 1px 0 rgba(255, 255, 255, 0.05);
  }

  /* Gradient animation */
  @keyframes gradient-shift {
    0%, 100% {
      background-position: 0% 50%;
    }
    50% {
      background-position: 100% 50%;
    }
  }

  .bg-linear-to-r,
  .bg-linear-to-br {
    background-size: 200% 200%;
    animation: gradient-shift 8s ease infinite;
  }

  /* Pulse animation for background orbs */
  @keyframes pulse-slow {
    0%, 100% {
      opacity: 0.3;
      transform: scale(1);
    }
    50% {
      opacity: 0.5;
      transform: scale(1.1);
    }
  }

  .animate-pulse {
    animation: pulse-slow 8s ease-in-out infinite;
  }

  /* Smooth hover transitions */
  .group {
    will-change: transform;
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

  /* React App Container */
  #react-app.react-loaded {
    background: transparent;
  }

  #react-app.react-loaded > div:first-child {
    display: none;
  }
</style>

</file_content>
</create_file>
