<?php
require_once __DIR__ . '/src/Bootstrap.php';
\SoftEdge\Env::load(__DIR__);
\SoftEdge\Bootstrap::init();
include 'components/header.php';
?>

<!-- HERO SECTION -->
<section class="relative pt-32 pb-20 overflow-hidden">
  <!-- Background -->
  <div class="absolute inset-0 -z-10">
    <div class="absolute inset-0 bg-linear-to-br from-slate-950 via-slate-900 to-slate-950"></div>
    <div class="absolute inset-0 opacity-30">
      <div class="absolute top-20 left-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 right-20 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>
    </div>
  </div>

  <!-- Content -->
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="space-y-6">
      <div class="inline-block px-4 py-2 bg-slate-700 border border-slate-600 mb-4">
        <span class="text-slate-300 text-sm font-medium uppercase tracking-wide">Nossos Serviços</span>
      </div>

      <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight">
        Transformamos suas ideias em
        <span class="block text-slate-300">
          soluções digitais
        </span>
      </h1>

      <p class="text-base sm:text-lg md:text-xl text-slate-400 max-w-3xl mx-auto leading-relaxed">
        Da consultoria ao desenvolvimento completo, oferecemos tudo o que você precisa para ter sucesso no mundo digital.
      </p>
    </div>
  </div>
</section>

<!-- SERVIÇOS GRID -->
<main class="relative py-20 lg:py-32">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6 lg:gap-8">

      <!-- SERVIÇO 1 - DESENVOLVIMENTO FULL STACK -->
      <div class="group relative">
        <div class="absolute inset-0 bg-linear-to-br from-cyan-500/20 to-blue-500/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/5 rounded-3xl p-8 lg:p-10 transition-all duration-500 hover:border-cyan-500/30 h-full flex flex-col">
          
          <!-- Icon -->
          <div class="w-16 h-16 bg-linear-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
            <i data-lucide="code-2" class="w-8 h-8 text-white"></i>
          </div>

          <!-- Title -->
          <h3 class="text-2xl sm:text-3xl font-bold text-white mb-4">
            Desenvolvimento Full Stack
          </h3>

          <!-- Description -->
          <p class="text-gray-300 text-base leading-relaxed mb-6 grow">
            Criamos aplicações web, mobile e desktop personalizadas para o seu negócio. Utilizamos as tecnologias mais modernas como React, Next.js, Node.js, Laravel, Flutter, PHP 8+, bancos SQL/NoSQL e muito mais.
          </p>

          <!-- Features List -->
          <ul class="space-y-3">
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-cyan-400 shrink-0 mt-0.5"></i>
              <span>APIs REST & GraphQL profissionais</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-cyan-400 shrink-0 mt-0.5"></i>
              <span>Progressive Web Apps (PWA) rápidos</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-cyan-400 shrink-0 mt-0.5"></i>
              <span>Integração com serviços externos</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-cyan-400 shrink-0 mt-0.5"></i>
              <span>Deploy automático e escalável</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- SERVIÇO 2 - SISTEMAS SOB MEDIDA -->
      <div class="group relative">
        <div class="absolute inset-0 bg-linear-to-br from-purple-500/20 to-pink-500/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/5 rounded-3xl p-8 lg:p-10 transition-all duration-500 hover:border-purple-500/30 h-full flex flex-col">
          
          <!-- Icon -->
          <div class="w-16 h-16 bg-linear-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
            <i data-lucide="layout-dashboard" class="w-8 h-8 text-white"></i>
          </div>

          <!-- Title -->
          <h3 class="text-2xl sm:text-3xl font-bold text-white mb-4">
            Sistemas Sob Medida
          </h3>

          <!-- Description -->
          <p class="text-gray-300 text-base leading-relaxed mb-6 grow">
            Desenvolvemos ERPs, CRMs, sistemas de gestão financeira, controle de estoque, portais internos e dashboards analíticos 100% personalizados para atender às necessidades específicas do seu negócio.
          </p>

          <!-- Features List -->
          <ul class="space-y-3">
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-purple-400 shrink-0 mt-0.5"></i>
              <span>Totalmente escalável e flexível</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-purple-400 shrink-0 mt-0.5"></i>
              <span>Multiplataforma (web + mobile + desktop)</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-purple-400 shrink-0 mt-0.5"></i>
              <span>Integração com ferramentas existentes</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-purple-400 shrink-0 mt-0.5"></i>
              <span>Suporte técnico 24/7 incluído</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- SERVIÇO 3 - CONSULTORIA & PERFORMANCE -->
      <div class="group relative">
        <div class="absolute inset-0 bg-linear-to-br from-green-500/20 to-emerald-500/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/5 rounded-3xl p-8 lg:p-10 transition-all duration-500 hover:border-green-500/30 h-full flex flex-col">
          
          <!-- Icon -->
          <div class="w-16 h-16 bg-linear-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
            <i data-lucide="zap" class="w-8 h-8 text-white"></i>
          </div>

          <!-- Title -->
          <h3 class="text-2xl sm:text-3xl font-bold text-white mb-4">
            Consultoria & Performance
          </h3>

          <!-- Description -->
          <p class="text-gray-300 text-base leading-relaxed mb-6 grow">
            Realizamos auditoria técnica completa, otimização de velocidade (Core Web Vitals 100), SEO técnico, migração para cloud e modernização de sistemas legados para melhorar a performance do seu negócio.
          </p>

          <!-- Features List -->
          <ul class="space-y-3">
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-green-400 shrink-0 mt-0.5"></i>
              <span>Score +95 no Google Lighthouse</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-green-400 shrink-0 mt-0.5"></i>
              <span>Redução significativa de custos de servidor</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-green-400 shrink-0 mt-0.5"></i>
              <span>Estratégia digital completa e assertiva</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-green-400 shrink-0 mt-0.5"></i>
              <span>Treinamento personalizado para sua equipe</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- SERVIÇO 4 - IA E AUTOMAÇÃO (NOVO!) -->
      <div class="group relative">
        <div class="absolute inset-0 bg-linear-to-br from-orange-500/20 to-red-500/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/5 rounded-3xl p-8 lg:p-10 transition-all duration-500 hover:border-orange-500/30 h-full flex flex-col">
          
          <!-- Icon + Badge -->
          <div class="flex items-center gap-3 mb-6">
            <div class="w-16 h-16 bg-linear-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
              <i data-lucide="brain" class="w-8 h-8 text-white"></i>
            </div>
            <span class="px-3 py-1 bg-orange-500/20 border border-orange-500/30 rounded-full text-orange-400 text-xs font-semibold uppercase">
              Novo
            </span>
          </div>

          <!-- Title -->
          <h3 class="text-2xl sm:text-3xl font-bold text-white mb-4">
            IA & Automação
          </h3>

          <!-- Description -->
          <p class="text-gray-300 text-base leading-relaxed mb-6 grow">
            Desenvolvemos soluções inteligentes com Inteligência Artificial: chatbots para WhatsApp, assistentes virtuais, análise preditiva, automação de processos e modelos de IA personalizados para otimizar seu negócio.
          </p>

          <!-- Features List -->
          <ul class="space-y-3">
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-orange-400 shrink-0 mt-0.5"></i>
              <span>Chatbots inteligentes para WhatsApp Business</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-orange-400 shrink-0 mt-0.5"></i>
              <span>Assistentes virtuais com processamento de linguagem</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-orange-400 shrink-0 mt-0.5"></i>
              <span>Análise preditiva e machine learning</span>
            </li>
            <li class="flex items-start gap-3 text-gray-400 text-sm">
              <i data-lucide="check-circle" class="w-5 h-5 text-orange-400 shrink-0 mt-0.5"></i>
              <span>Automação de processos repetitivos (RPA)</span>
            </li>
          </ul>
        </div>
      </div>

    </div>

    <!-- SEÇÃO DE DESTAQUE -->
    <div class="mt-20 lg:mt-32">
      <div class="relative">
        <div class="absolute inset-0 bg-linear-to-r from-cyan-500/10 via-purple-500/10 to-blue-500/10 rounded-3xl blur-3xl"></div>
        
        <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/10 rounded-3xl p-8 lg:p-12">
          <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            
            <!-- Left Content -->
            <div>
              <div class="inline-block px-4 py-2 bg-cyan-500/10 rounded-full border border-cyan-500/20 mb-6">
                <span class="text-cyan-400 text-sm font-semibold uppercase tracking-wider">Processo Transparente</span>
              </div>
              
              <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                Como trabalhamos com você
              </h2>
              
              <p class="text-gray-300 text-lg leading-relaxed mb-8">
                Nosso processo é colaborativo e transparente. Trabalhamos lado a lado com você em cada etapa do projeto, garantindo que sua visão se torne realidade.
              </p>

              <a href="feedback.php" 
                 class="inline-flex items-center gap-3 bg-linear-to-r from-cyan-500 to-blue-600 text-white font-semibold text-lg px-8 py-4 rounded-full shadow-lg hover:shadow-cyan-500/50 hover:scale-105 transition-all duration-300 group">
                Começar Agora
                <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
              </a>
            </div>

            <!-- Right Content - Steps -->
            <div class="space-y-6">
              <!-- Step 1 -->
              <div class="flex gap-4">
                <div class="shrink-0 w-12 h-12 bg-cyan-500/10 rounded-xl flex items-center justify-center border border-cyan-500/20">
                  <span class="text-cyan-400 font-bold text-lg">1</span>
                </div>
                <div>
                  <h4 class="text-white font-semibold text-lg mb-2">Consulta Inicial</h4>
                  <p class="text-gray-400 text-sm leading-relaxed">Entendemos seu negócio, objetivos e desafios para criar a melhor solução.</p>
                </div>
              </div>

              <!-- Step 2 -->
              <div class="flex gap-4">
                <div class="shrink-0 w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center border border-blue-500/20">
                  <span class="text-blue-400 font-bold text-lg">2</span>
                </div>
                <div>
                  <h4 class="text-white font-semibold text-lg mb-2">Planejamento</h4>
                  <p class="text-gray-400 text-sm leading-relaxed">Criamos um roadmap detalhado com prazos, custos e entregas definidas.</p>
                </div>
              </div>

              <!-- Step 3 -->
              <div class="flex gap-4">
                <div class="shrink-0 w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center border border-purple-500/20">
                  <span class="text-purple-400 font-bold text-lg">3</span>
                </div>
                <div>
                  <h4 class="text-white font-semibold text-lg mb-2">Desenvolvimento</h4>
                  <p class="text-gray-400 text-sm leading-relaxed">Construímos sua solução com código limpo, testes e validações constantes.</p>
                </div>
              </div>

              <!-- Step 4 -->
              <div class="flex gap-4">
                <div class="shrink-0 w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center border border-green-500/20">
                  <span class="text-green-400 font-bold text-lg">4</span>
                </div>
                <div>
                  <h4 class="text-white font-semibold text-lg mb-2">Entrega & Suporte</h4>
                  <p class="text-gray-400 text-sm leading-relaxed">Lançamos seu projeto e fornecemos suporte contínuo para garantir o sucesso.</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- CTA FINAL -->
    <div class="text-center mt-20 lg:mt-32">
      <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
        Pronto para transformar
        <span class="block text-slate-300">
          seu negócio?
        </span>
      </h2>
      
      <p class="text-lg sm:text-xl text-gray-300 max-w-2xl mx-auto mb-10">
        Entre em contato hoje mesmo e descubra como podemos ajudar você a alcançar seus objetivos.
      </p>
      
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        <a href="feedback.php"
           class="inline-flex items-center justify-center gap-3 w-full sm:w-auto bg-slate-700 hover:bg-slate-600 border border-slate-600 text-slate-200 font-medium text-lg px-10 py-4 rounded-lg transition-all duration-300">
          Iniciar Projeto
          <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </a>

        <a href="projetos.php"
           class="inline-flex items-center justify-center gap-3 w-full sm:w-auto bg-slate-800/50 hover:bg-slate-700/50 border border-slate-600 text-slate-300 font-medium text-lg px-10 py-4 rounded-lg transition-all duration-300">
          Ver Portfolio
          <i data-lucide="folder-open" class="w-5 h-5"></i>
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

    // Observe all service cards and sections
    document.querySelectorAll('.group, section').forEach((el, index) => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
      observer.observe(el);
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

  /* Smooth hover transitions */
  .group {
    will-change: transform;
  }
</style>
