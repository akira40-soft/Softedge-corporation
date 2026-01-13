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
      <div class="inline-block px-4 py-2 bg-purple-500/10 rounded-full border border-purple-500/20 mb-4">
        <span class="text-purple-400 text-sm font-semibold uppercase tracking-wider">Portfolio</span>
      </div>
      
      <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight">
        Projetos que
        <span class="block bg-linear-to-r from-cyan-400 via-blue-500 to-purple-500 bg-clip-text text-transparent">
          transformam negócios
        </span>
      </h1>
      
      <p class="text-base sm:text-lg md:text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
        Conheça algumas das soluções que desenvolvemos e que já estão transformando negócios reais.
      </p>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<main class="relative py-20 lg:py-32">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- PROJETO DESTAQUE: AKIRA IA -->
    <div class="mb-20 lg:mb-32">
      <div class="relative">
        <div class="absolute inset-0 bg-linear-to-r from-purple-500/20 via-pink-500/20 to-cyan-500/20 rounded-3xl blur-3xl"></div>
        
        <div class="relative bg-slate-900/80 backdrop-blur-xl border border-purple-500/30 rounded-3xl overflow-hidden">
          <!-- Badge Destaque -->
          <div class="absolute top-6 right-6 z-10 px-4 py-2 bg-purple-500 rounded-full border border-purple-400 shadow-lg">
            <span class="text-white text-sm font-bold uppercase tracking-wider flex items-center gap-2">
              <i data-lucide="star" class="w-4 h-4"></i>
              Projeto Destaque
            </span>
          </div>

          <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 p-8 lg:p-12">
            
            <!-- Left: Info -->
            <div class="flex flex-col justify-center space-y-6">
              <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-purple-500/20 border border-purple-500/30 rounded-full mb-4">
                  <i data-lucide="brain" class="w-4 h-4 text-purple-400"></i>
                  <span class="text-purple-400 text-xs font-semibold uppercase">Inteligência Artificial</span>
                </div>
                
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4">
                  AKIRA IA
                  <span class="block text-2xl sm:text-3xl text-gray-400 mt-2">🇦🇴 100% Angolana</span>
                </h2>
              </div>

              <p class="text-gray-300 text-lg leading-relaxed">
                Uma inteligência artificial autônoma desenvolvida inteiramente pela SoftEdge, projetada para conversar naturalmente com usuários, entender contexto e fornecer respostas precisas e humanizadas.
              </p>

              <!-- Features -->
              <div class="space-y-3">
                <div class="flex items-start gap-3">
                  <i data-lucide="check-circle" class="w-5 h-5 text-purple-400 shrink-0 mt-1"></i>
                  <span class="text-gray-300">Processamento de linguagem natural (NLP)</span>
                </div>
                <div class="flex items-start gap-3">
                  <i data-lucide="check-circle" class="w-5 h-5 text-purple-400 shrink-0 mt-1"></i>
                  <span class="text-gray-300">Aprendizado contínuo com conversas</span>
                </div>
                <div class="flex items-start gap-3">
                  <i data-lucide="check-circle" class="w-5 h-5 text-purple-400 shrink-0 mt-1"></i>
                  <span class="text-gray-300">Integração com WhatsApp e plataformas web</span>
                </div>
                <div class="flex items-start gap-3">
                  <i data-lucide="check-circle" class="w-5 h-5 text-purple-400 shrink-0 mt-1"></i>
                  <span class="text-gray-300">Personalidade única e respostas contextualizadas</span>
                </div>
              </div>

              <!-- Tech Stack -->
              <div>
                <p class="text-sm text-gray-400 mb-3 font-medium">Tecnologias:</p>
                <div class="flex flex-wrap gap-2">
                  <span class="px-4 py-2 bg-purple-500/20 border border-purple-500/30 rounded-lg text-purple-400 text-sm font-medium">Python</span>
                  <span class="px-4 py-2 bg-pink-500/20 border border-pink-500/30 rounded-lg text-pink-400 text-sm font-medium">TensorFlow</span>
                  <span class="px-4 py-2 bg-cyan-500/20 border border-cyan-500/30 rounded-lg text-cyan-400 text-sm font-medium">OpenAI API</span>
                  <span class="px-4 py-2 bg-blue-500/20 border border-blue-500/30 rounded-lg text-blue-400 text-sm font-medium">FastAPI</span>
                </div>
              </div>
            </div>

            <!-- Right: Main Image -->
            <div class="relative group">
              <div class="absolute inset-0 bg-linear-to-br from-purple-500/30 to-pink-500/30 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
              <div class="relative overflow-hidden rounded-2xl border border-white/10 shadow-2xl">
                <img src="/assets/akira.jpg" 
                     alt="AKIRA IA - Interface Principal" 
                     class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4">
                  <p class="text-white font-semibold text-lg">Interface Principal da AKIRA</p>
                  <p class="text-gray-300 text-sm">Conversando com usuários em tempo real</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Gallery Section -->
          <div class="border-t border-white/10 p-8 lg:p-12 bg-black/20">
            <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
              <i data-lucide="image" class="w-6 h-6 text-purple-400"></i>
              Galeria de Conversas
            </h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <!-- Gallery Image 1 -->
              <div class="group relative overflow-hidden rounded-xl border border-white/10 hover:border-purple-500/50 transition-all cursor-pointer">
                <img src="/assets/akira1.jpg" 
                     alt="AKIRA IA - Conversa 1" 
                     class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                  <i data-lucide="maximize-2" class="w-8 h-8 text-white"></i>
                </div>
              </div>

              <!-- Gallery Image 2 -->
              <div class="group relative overflow-hidden rounded-xl border border-white/10 hover:border-purple-500/50 transition-all cursor-pointer">
                <img src="/assets/akira2.jpg" 
                     alt="AKIRA IA - Conversa 2" 
                     class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                  <i data-lucide="maximize-2" class="w-8 h-8 text-white"></i>
                </div>
              </div>

              <!-- Gallery Image 3 -->
              <div class="group relative overflow-hidden rounded-xl border border-white/10 hover:border-purple-500/50 transition-all cursor-pointer">
                <img src="/assets/akira3.jpg" 
                     alt="AKIRA IA - Conversa 3" 
                     class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                  <i data-lucide="maximize-2" class="w-8 h-8 text-white"></i>
                </div>
              </div>

              <!-- Gallery Image 4 -->
              <div class="group relative overflow-hidden rounded-xl border border-white/10 hover:border-purple-500/50 transition-all cursor-pointer">
                <img src="/assets/akira4.jpg" 
                     alt="AKIRA IA - Conversa 4" 
                     class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                  <i data-lucide="maximize-2" class="w-8 h-8 text-white"></i>
                </div>
              </div>
            </div>

            <p class="text-gray-400 text-sm mt-4 text-center italic">
              Clique nas imagens para ampliar e ver detalhes das conversas
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- OUTROS PROJETOS -->
    <div>
      <div class="text-center mb-12 lg:mb-16">
        <div class="inline-block px-4 py-2 bg-cyan-500/10 rounded-full border border-cyan-500/20 mb-4">
          <span class="text-cyan-400 text-sm font-semibold uppercase tracking-wider">Mais Projetos</span>
        </div>
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white">
          Outros projetos desenvolvidos
        </h2>
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

        <!-- PROJETO 1: ERP -->
        <div class="group relative">
          <div class="absolute inset-0 bg-linear-to-br from-cyan-500/20 to-blue-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
          <div class="relative bg-linear-to-br from-cyan-600/20 to-blue-600/20 rounded-2xl overflow-hidden border border-white/10 hover:border-cyan-500/30 transition-all h-full">
            <div class="p-8 h-80 flex flex-col justify-between">
              <div>
                <div class="w-14 h-14 bg-cyan-500/20 rounded-xl flex items-center justify-center mb-4">
                  <i data-lucide="layout-dashboard" class="w-7 h-7 text-cyan-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Gestão Total ERP</h3>
                <p class="text-gray-300 leading-relaxed mb-4">
                  Sistema completo de gestão empresarial com controle financeiro, estoque e CRM integrado.
                </p>
              </div>
              
              <div class="space-y-3">
                <div class="flex flex-wrap gap-2">
                  <span class="px-3 py-1 bg-cyan-500/20 rounded-full text-cyan-400 text-xs font-medium">Laravel</span>
                  <span class="px-3 py-1 bg-blue-500/20 rounded-full text-blue-400 text-xs font-medium">Vue.js</span>
                  <span class="px-3 py-1 bg-purple-500/20 rounded-full text-purple-400 text-xs font-medium">MySQL</span>
                </div>
                <div class="flex items-center gap-2 text-gray-400 text-sm">
                  <i data-lucide="calendar" class="w-4 h-4"></i>
                  <span>Concluído em 2024</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- PROJETO 2: E-commerce -->
        <div class="group relative">
          <div class="absolute inset-0 bg-linear-to-br from-purple-500/20 to-pink-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
          <div class="relative bg-linear-to-br from-purple-600/20 to-pink-600/20 rounded-2xl overflow-hidden border border-white/10 hover:border-purple-500/30 transition-all h-full">
            <div class="p-8 h-80 flex flex-col justify-between">
              <div>
                <div class="w-14 h-14 bg-purple-500/20 rounded-xl flex items-center justify-center mb-4">
                  <i data-lucide="shopping-cart" class="w-7 h-7 text-purple-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">ShopFast E-commerce</h3>
                <p class="text-gray-300 leading-relaxed mb-4">
                  Plataforma de vendas online com checkout rápido, pagamentos integrados e painel administrativo completo.
                </p>
              </div>
              
              <div class="space-y-3">
                <div class="flex flex-wrap gap-2">
                  <span class="px-3 py-1 bg-purple-500/20 rounded-full text-purple-400 text-xs font-medium">Next.js</span>
                  <span class="px-3 py-1 bg-pink-500/20 rounded-full text-pink-400 text-xs font-medium">Stripe</span>
                  <span class="px-3 py-1 bg-green-500/20 rounded-full text-green-400 text-xs font-medium">Prisma</span>
                </div>
                <div class="flex items-center gap-2 text-gray-400 text-sm">
                  <i data-lucide="calendar" class="w-4 h-4"></i>
                  <span>Concluído em 2024</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- PROJETO 3: Dashboard Analytics -->
        <div class="group relative">
          <div class="absolute inset-0 bg-linear-to-br from-green-500/20 to-emerald-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
          <div class="relative bg-linear-to-br from-green-600/20 to-emerald-600/20 rounded-2xl overflow-hidden border border-white/10 hover:border-green-500/30 transition-all h-full">
            <div class="p-8 h-80 flex flex-col justify-between">
              <div>
                <div class="w-14 h-14 bg-green-500/20 rounded-xl flex items-center justify-center mb-4">
                  <i data-lucide="bar-chart-3" class="w-7 h-7 text-green-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">DataMind Analytics</h3>
                <p class="text-gray-300 leading-relaxed mb-4">
                  Dashboard inteligente com análise em tempo real, previsões e insights automatizados para decisões estratégicas.
                </p>
              </div>
              
              <div class="space-y-3">
                <div class="flex flex-wrap gap-2">
                  <span class="px-3 py-1 bg-green-500/20 rounded-full text-green-400 text-xs font-medium">React</span>
                  <span class="px-3 py-1 bg-yellow-500/20 rounded-full text-yellow-400 text-xs font-medium">Python</span>
                  <span class="px-3 py-1 bg-red-500/20 rounded-full text-red-400 text-xs font-medium">Redis</span>
                </div>
                <div class="flex items-center gap-2 text-gray-400 text-sm">
                  <i data-lucide="calendar" class="w-4 h-4"></i>
                  <span>Concluído em 2024</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- PROJETO 4: App Mobile -->
        <div class="group relative">
          <div class="absolute inset-0 bg-linear-to-br from-orange-500/20 to-red-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
          <div class="relative bg-linear-to-br from-orange-600/20 to-red-600/20 rounded-2xl overflow-hidden border border-white/10 hover:border-orange-500/30 transition-all h-full">
            <div class="p-8 h-80 flex flex-col justify-between">
              <div>
                <div class="w-14 h-14 bg-orange-500/20 rounded-xl flex items-center justify-center mb-4">
                  <i data-lucide="smartphone" class="w-7 h-7 text-orange-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">ConnectPro Mobile</h3>
                <p class="text-gray-300 leading-relaxed mb-4">
                  Aplicativo multiplataforma para iOS e Android com sincronização em nuvem e notificações em tempo real.
                </p>
              </div>
              
              <div class="space-y-3">
                <div class="flex flex-wrap gap-2">
                  <span class="px-3 py-1 bg-orange-500/20 rounded-full text-orange-400 text-xs font-medium">Flutter</span>
                  <span class="px-3 py-1 bg-blue-500/20 rounded-full text-blue-400 text-xs font-medium">Firebase</span>
                </div>
                <div class="flex items-center gap-2 text-gray-400 text-sm">
                  <i data-lucide="calendar" class="w-4 h-4"></i>
                  <span>Concluído em 2024</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- PROJETO EM ANDAMENTO -->
        <div class="sm:col-span-2 lg:col-span-2 group relative">
          <div class="absolute inset-0 bg-linear-to-r from-blue-500/10 to-cyan-500/10 rounded-2xl blur-xl"></div>
          <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/10 rounded-2xl p-8 lg:p-12 text-center h-full flex flex-col justify-center">
            <div class="w-16 h-16 bg-blue-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
              <i data-lucide="code-2" class="w-8 h-8 text-blue-400 animate-pulse"></i>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-white mb-4">
              Mais projetos em desenvolvimento...
            </h3>
            <p class="text-gray-300 text-lg mb-6 max-w-xl mx-auto">
              Estamos trabalhando em novas soluções inovadoras. Em breve, mais projetos serão adicionados ao nosso portfolio.
            </p>
            <div class="flex items-center justify-center gap-2 text-gray-400">
              <i data-lucide="clock" class="w-5 h-5"></i>
              <span>2025 - Em andamento</span>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- CTA FINAL -->
    <div class="text-center mt-20 lg:mt-32">
      <div class="relative">
        <div class="absolute inset-0 bg-linear-to-r from-cyan-500/10 via-blue-500/10 to-purple-500/10 rounded-3xl blur-3xl"></div>
        
        <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/10 rounded-3xl p-8 lg:p-12">
          <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
            Quer ver seu projeto
            <span class="block bg-linear-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
              aqui no nosso portfolio?
            </span>
          </h2>
          
          <p class="text-base sm:text-lg text-gray-300 max-w-2xl mx-auto mb-8 lg:mb-10">
            Vamos criar algo incrível juntos. Entre em contato e transforme sua ideia em realidade.
          </p>
          
          <a href="feedback.php" 
             class="inline-flex items-center justify-center gap-3 bg-linear-to-r from-cyan-500 to-blue-600 text-white font-semibold text-lg px-10 py-4 rounded-full shadow-lg hover:shadow-cyan-500/50 hover:scale-105 transition-all duration-300 group">
            Iniciar Meu Projeto
            <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
          </a>
        </div>
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

    // Observe all project cards
    document.querySelectorAll('.group, section').forEach((el, index) => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
      observer.observe(el);
    });

    // Gallery lightbox effect (opcional)
    document.querySelectorAll('[src*="akira"]').forEach(img => {
      img.addEventListener('click', function() {
        // Aqui você pode adicionar um lightbox modal se quiser
        console.log('Imagem clicada:', this.src);
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

  /* Image hover effects */
  img {
    will-change: transform;
  }

  /* Pulse animation for "em desenvolvimento" */
  @keyframes pulse {
    0%, 100% {
      opacity: 1;
    }
    50% {
      opacity: 0.5;
    }
  }

  .animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  }
</style>
