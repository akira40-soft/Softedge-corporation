<?php
require_once __DIR__ . '/src/Bootstrap.php';
\SoftEdge\Env::load(__DIR__);
\SoftEdge\Bootstrap::init();
include 'components/header.php';
?>

<!-- HERO SECTION -->
<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">
  <!-- Background -->
  <div class="absolute inset-0 -z-10">
    <div class="absolute inset-0 bg-linear-to-br from-slate-950 via-slate-900 to-slate-950"></div>
    <div class="absolute inset-0 opacity-30">
      <div class="absolute top-20 left-20 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 right-20 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>
    </div>
  </div>

  <!-- Content -->
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="space-y-8">
      <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold leading-tight">
        Do sonho<br>
        <span class="text-slate-300">
          à realidade lógica
        </span>
      </h1>

      <p class="text-lg sm:text-xl md:text-2xl text-slate-400 max-w-3xl mx-auto leading-relaxed">
        Começamos com uma ideia simples.<br class="hidden sm:block">
        Hoje criamos softwares que as pessoas amam usar.
      </p>
    </div>
  </div>

  <!-- Scroll indicator -->
  <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
    <i data-lucide="chevron-down" class="w-8 h-8 text-white/40"></i>
  </div>
</section>

<!-- MAIN CONTENT -->
<main class="relative py-20 lg:py-32">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- NOSSA HISTÓRIA -->
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center mb-32">
      
      <!-- Texto -->
      <div class="space-y-8">
        <div class="inline-block px-4 py-2 bg-cyan-500/10 rounded-full border border-cyan-500/20 mb-4">
          <span class="text-cyan-400 text-sm font-semibold uppercase tracking-wider">Nossa História</span>
        </div>
        
        <div class="space-y-6 text-gray-300 text-base sm:text-lg leading-relaxed">
          <p>
            Tudo começou em <span class="text-cyan-400 font-semibold">2023</span>, quando quatro amigos decidiram que o mundo precisava de softwares mais <span class="text-white font-medium">humanos</span>.
          </p>
          
          <p>
            <span class="text-white font-bold text-xl">Isaac Quarenta</span> <span class="text-gray-400 text-sm">(CEO)</span> juntou forças com os co-fundadores
            <span class="text-cyan-300 font-medium">José Lopes</span>,
            <span class="text-blue-300 font-medium">Stefânio Costa</span> e
            <span class="text-purple-300 font-medium">Tiago Rodrigues</span>.
          </p>
          
          <p>
            Juntos criaram a <span class="bg-linear-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent font-bold text-xl">SoftEdge</span> — uma empresa que transforma ideias em experiências digitais e softwares légitmos.
          </p>
          
          <div class="pt-6 mt-8 border-t border-white/10">
            <p class="text-xl sm:text-2xl font-semibold text-cyan-400 leading-relaxed">
              Começamos com um sonho.<br>
              Hoje desenvolvemos realidades lógicas e softwares mais amáveis.
            </p>
          </div>
        </div>
      </div>

      <!-- Imagem da Equipe -->
      <div class="relative">
        <div class="relative group">
          <!-- Card Container -->
          <div class="relative overflow-hidden rounded-3xl bg-linear-to-br from-cyan-500/10 to-blue-500/10 p-1 transition-all duration-500 hover:scale-[1.02]">
            <div class="relative overflow-hidden rounded-3xl bg-slate-900/80 backdrop-blur-xl">
              
              <!-- Image -->
              <div class="relative aspect-square overflow-hidden">
                <img src="/assets/placeholder.svg"
                     alt="Equipe SoftEdge Corporation - Isaac, José, Stefânio e Tiago"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                
                <!-- Overlay Gradient -->
                <div class="absolute inset-0 bg-linear-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
                
                <!-- Text Overlay -->
                <div class="absolute bottom-0 left-0 right-0 p-8 text-center">
                  <h3 class="text-2xl sm:text-3xl font-bold text-white mb-2">Nossa Equipe</h3>
                  <p class="text-gray-300 text-sm sm:text-base">Isaac • José • Stefâncio • Tiago</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Decorative Elements -->
          <div class="absolute -top-4 -right-4 w-24 h-24 bg-cyan-500/20 rounded-full blur-2xl"></div>
          <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-blue-500/20 rounded-full blur-2xl"></div>
        </div>
      </div>
    </div>

    <!-- NÚMEROS IMPACTANTES -->
    <div class="mb-32">
      <div class="text-center mb-16">
        <div class="inline-block px-4 py-2 bg-cyan-500/10 rounded-full border border-cyan-500/20 mb-4">
          <span class="text-cyan-400 text-sm font-semibold uppercase tracking-wider">Nossos Números</span>
        </div>
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white">
          Resultados que inspiram
        </h2>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
        <!-- Stat 1 -->
        <div class="relative group">
          <div class="absolute inset-0 bg-linear-to-br from-cyan-500/20 to-blue-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/5 rounded-2xl p-8 text-center transition-all duration-500 hover:border-cyan-500/30">
            <div class="text-4xl sm:text-5xl md:text-6xl font-bold bg-linear-to-br from-cyan-400 to-cyan-600 bg-clip-text text-transparent mb-3">
              70+
            </div>
            <p class="text-gray-300 text-sm sm:text-base">Projetos entregues</p>
          </div>
        </div>

        <!-- Stat 2 -->
        <div class="relative group">
          <div class="absolute inset-0 bg-linear-to-br from-blue-500/20 to-purple-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/5 rounded-2xl p-8 text-center transition-all duration-500 hover:border-blue-500/30">
            <div class="text-4xl sm:text-5xl md:text-6xl font-bold bg-linear-to-br from-blue-400 to-blue-600 bg-clip-text text-transparent mb-3">
              4.9★
            </div>
            <p class="text-gray-300 text-sm sm:text-base">Satisfação média</p>
          </div>
        </div>

        <!-- Stat 3 -->
        <div class="relative group">
          <div class="absolute inset-0 bg-linear-to-br from-purple-500/20 to-pink-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/5 rounded-2xl p-8 text-center transition-all duration-500 hover:border-purple-500/30">
            <div class="text-4xl sm:text-5xl md:text-6xl font-bold bg-linear-to-br from-purple-400 to-purple-600 bg-clip-text text-transparent mb-3">
              24/7
            </div>
            <p class="text-gray-300 text-sm sm:text-base">Suporte dedicado</p>
          </div>
        </div>

        <!-- Stat 4 -->
        <div class="relative group">
          <div class="absolute inset-0 bg-linear-to-br from-green-500/20 to-emerald-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/5 rounded-2xl p-8 text-center transition-all duration-500 hover:border-green-500/30">
            <div class="text-4xl sm:text-5xl md:text-6xl font-bold bg-linear-to-br from-green-400 to-green-600 bg-clip-text text-transparent mb-3">
              100%
            </div>
            <p class="text-gray-300 text-sm sm:text-base">Código limpo</p>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA SECTION -->
    <div class="relative">
      <!-- Background -->
      <div class="absolute inset-0 bg-linear-to-r from-cyan-500/10 via-blue-500/10 to-purple-500/10 rounded-3xl blur-3xl"></div>
      
      <!-- Content -->
      <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/10 rounded-3xl p-12 lg:p-16 text-center">
        <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
          Pronto para criar algo<br class="hidden sm:block">
          <span class="bg-linear-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
            incrível juntos?
          </span>
        </h2>
        
        <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-10">
          Vamos transformar sua ideia em realidade. Entre em contato e descubra como podemos ajudar.
        </p>
        
        <a href="feedback.php"
           class="inline-flex items-center gap-3 bg-slate-700 hover:bg-slate-600 border border-slate-600 text-slate-200 font-medium text-lg px-8 py-4 rounded-lg transition-all duration-300">
          Falar conosco
          <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </a>
      </div>
    </div>

  </div>
</main>

<?php include 'components/footer.php'; ?>

<!-- SCRIPTS -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons
    lucide.createIcons();

    // Smooth scroll behavior
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

    // Intersection Observer for fade-in animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe all sections
    document.querySelectorAll('section, main > div > div').forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(30px)';
      el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
      observer.observe(el);
    });
  });
</script>

<style>
  /* Smooth scrolling */
  html {
    scroll-behavior: smooth;
  }

  /* Image hover effects */
  img {
    will-change: transform;
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

  .bg-linear-to-r {
    background-size: 200% 200%;
    animation: gradient-shift 8s ease infinite;
  }

  /* Custom scrollbar */
  ::-webkit-scrollbar {
    width: 10px;
  }

  ::-webkit-scrollbar-track {
    background: #0f172a;
  }

  ::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #06b6d4, #3b82f6);
    border-radius: 5px;
  }

  ::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #0891b2, #2563eb);
  }
</style>
