<?php
require_once __DIR__ . '/src/Bootstrap.php';
\SoftEdge\Env::load(__DIR__);
\SoftEdge\Bootstrap::init();
include 'components/header.php';
?>

<!-- HERO SECTION -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
  <!-- Background -->
  <div class="absolute inset-0 -z-10">
    <div class="absolute inset-0 bg-linear-to-br from-slate-950 via-slate-900 to-slate-950"></div>
    <div class="absolute inset-0 opacity-30">
      <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-pulse"></div>
      <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-purple-500/10 rounded-full blur-3xl"></div>
    </div>
  </div>

  <!-- Content -->
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center space-y-12">
      
      <!-- Badge -->
      <div class="inline-block px-4 py-2 bg-cyan-500/10 rounded-full border border-cyan-500/20 backdrop-blur-sm">
        <span class="text-cyan-400 text-xs sm:text-sm font-semibold uppercase tracking-wider">
          💬 Entre em Contato
        </span>
      </div>

      <!-- Main Heading -->
      <div class="space-y-6">
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-bold leading-tight">
          <span class="block text-white mb-2">Vamos conversar</span>
          <span class="block bg-linear-to-r from-cyan-400 via-blue-500 to-purple-500 bg-clip-text text-transparent">
            sobre seu projeto?
          </span>
        </h1>
        
        <p class="text-base sm:text-lg md:text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed">
          Estamos prontos para transformar suas ideias em realidade.<br class="hidden sm:block">
          Escolha o melhor canal para falar conosco.
        </p>
      </div>

      <!-- Contact Cards Grid -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mt-16 max-w-5xl mx-auto">
        
        <!-- Card 1: Email -->
        <a href="mailto:softedgecorporation@gmail.com" 
           class="group relative">
          <div class="absolute inset-0 bg-linear-to-br from-cyan-500/20 to-blue-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/10 hover:border-cyan-500/50 rounded-2xl p-8 transition-all duration-300 group-hover:scale-105 h-full flex flex-col items-center text-center">
            <div class="w-16 h-16 bg-cyan-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <i data-lucide="mail" class="w-8 h-8 text-cyan-400"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-3">Email Direto</h3>
            <p class="text-gray-400 text-sm mb-4 grow">
              Envie sua mensagem e receba resposta em até 24 horas
            </p>
            <div class="text-cyan-400 font-medium text-sm break-all">
              softedgecorporation@gmail.com
            </div>
            <div class="mt-4 inline-flex items-center gap-2 text-cyan-400 text-sm font-medium">
              <span>Enviar email</span>
              <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
            </div>
          </div>
        </a>

        <!-- Card 2: WhatsApp -->
        <a href="https://whatsapp.com/channel/0029VawQLpGHltY2Y87fR83m" 
           target="_blank"
           rel="noopener noreferrer"
           class="group relative">
          <div class="absolute inset-0 bg-linear-to-br from-green-500/20 to-emerald-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/10 hover:border-green-500/50 rounded-2xl p-8 transition-all duration-300 group-hover:scale-105 h-full flex flex-col items-center text-center">
            <div class="w-16 h-16 bg-green-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <i data-lucide="message-circle" class="w-8 h-8 text-green-400"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-3">Canal WhatsApp</h3>
            <p class="text-gray-400 text-sm mb-4 grow">
              Junte-se ao nosso canal e receba novidades em primeira mão
            </p>
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-500/20 border border-green-500/30 rounded-lg">
              <i data-lucide="users" class="w-4 h-4 text-green-400"></i>
              <span class="text-green-400 font-medium text-sm">Canal Oficial</span>
            </div>
            <div class="mt-4 inline-flex items-center gap-2 text-green-400 text-sm font-medium">
              <span>Entrar agora</span>
              <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
            </div>
          </div>
        </a>

        <!-- Card 3: Twitter/X -->
        <a href="https://x.com/softedge40" 
           target="_blank"
           rel="noopener noreferrer"
           class="group relative sm:col-span-2 lg:col-span-1">
          <div class="absolute inset-0 bg-linear-to-br from-blue-500/20 to-purple-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/10 hover:border-blue-500/50 rounded-2xl p-8 transition-all duration-300 group-hover:scale-105 h-full flex flex-col items-center text-center">
            <div class="w-16 h-16 bg-blue-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <i data-lucide="twitter" class="w-8 h-8 text-blue-400"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-3">Twitter / X</h3>
            <p class="text-gray-400 text-sm mb-4 grow">
              Siga-nos para dicas, projetos e conteúdo sobre tecnologia
            </p>
            <div class="text-blue-400 font-medium text-sm">
              @softedge40
            </div>
            <div class="mt-4 inline-flex items-center gap-2 text-blue-400 text-sm font-medium">
              <span>Seguir agora</span>
              <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
            </div>
          </div>
        </a>
      </div>

      <!-- Divider -->
      <div class="relative py-12">
        <div class="absolute inset-0 flex items-center">
          <div class="w-full border-t border-white/10"></div>
        </div>
        <div class="relative flex justify-center">
          <span class="px-6 bg-slate-950 text-gray-400 text-sm uppercase tracking-wider">Ou</span>
        </div>
      </div>

      <!-- CTA Section -->
      <div class="max-w-3xl mx-auto">
        <div class="relative">
          <div class="absolute inset-0 bg-linear-to-r from-cyan-500/10 via-blue-500/10 to-purple-500/10 rounded-3xl blur-2xl"></div>
          
          <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/10 rounded-3xl p-8 lg:p-12">
            <div class="space-y-6">
              <div class="w-14 h-14 bg-linear-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto">
                <i data-lucide="send" class="w-7 h-7 text-white"></i>
              </div>
              
              <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white">
                Prefere um formulário completo?
              </h2>
              
              <p class="text-gray-300 text-base sm:text-lg">
                Preencha nosso formulário de contato com todos os detalhes do seu projeto e receba uma resposta personalizada em até 24 horas.
              </p>
              
              <a href="feedback.php"
                 class="inline-flex items-center justify-center gap-3 bg-slate-700 hover:bg-slate-600 border border-slate-600 text-slate-200 font-medium text-lg px-8 py-4 rounded-lg transition-all duration-300">
                Preencher Formulário
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Info Section -->
      <div class="grid sm:grid-cols-3 gap-6 lg:gap-8 mt-16 max-w-4xl mx-auto">
        <!-- Info 1 -->
        <div class="text-center">
          <div class="w-12 h-12 bg-cyan-500/10 rounded-xl flex items-center justify-center mx-auto mb-4">
            <i data-lucide="clock" class="w-6 h-6 text-cyan-400"></i>
          </div>
          <h3 class="text-white font-semibold mb-2">Resposta Rápida</h3>
          <p class="text-gray-400 text-sm">Até 24 horas úteis</p>
        </div>

        <!-- Info 2 -->
        <div class="text-center">
          <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center mx-auto mb-4">
            <i data-lucide="shield-check" class="w-6 h-6 text-blue-400"></i>
          </div>
          <h3 class="text-white font-semibold mb-2">100% Seguro</h3>
          <p class="text-gray-400 text-sm">Seus dados protegidos</p>
        </div>

        <!-- Info 3 -->
        <div class="text-center">
          <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center mx-auto mb-4">
            <i data-lucide="headphones" class="w-6 h-6 text-purple-400"></i>
          </div>
          <h3 class="text-white font-semibold mb-2">Suporte 24/7</h3>
          <p class="text-gray-400 text-sm">Sempre disponível</p>
        </div>
      </div>

      <!-- Location -->
      <div class="pt-12">
        <div class="inline-flex items-center gap-2 text-gray-400">
          <i data-lucide="map-pin" class="w-5 h-5"></i>
          <span>Localizado em Luanda, Angola 🇦🇴</span>
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

    // Fade in animations on scroll
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe all cards and sections
    document.querySelectorAll('.group, section > div > div').forEach((el, index) => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
      observer.observe(el);
    });

    // Add click tracking (optional)
    document.querySelectorAll('a[href^="mailto:"], a[href*="whatsapp"], a[href*="twitter"]').forEach(link => {
      link.addEventListener('click', function(e) {
        const channel = this.href.includes('mailto') ? 'Email' : 
                       this.href.includes('whatsapp') ? 'WhatsApp' : 'Twitter';
        console.log(`Usuário clicou em: ${channel}`);
      });
    });
  });
</script>

<style>
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
