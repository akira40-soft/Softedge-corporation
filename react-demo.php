<?php
require_once __DIR__ . '/src/Bootstrap.php';
\SoftEdge\Env::load(__DIR__);
\SoftEdge\Bootstrap::init();
include 'components/header.php';
?>

<!-- REACT DEMO PAGE -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
  <!-- Background -->
  <div class="absolute inset-0 -z-10">
    <div class="absolute inset-0 bg-linear-to-br from-slate-950 via-slate-900 to-slate-950"></div>
    <div class="absolute inset-0 opacity-30">
      <div class="absolute top-20 left-20 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 right-20 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>
    </div>
  </div>

  <!-- Content -->
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center space-y-12">

      <!-- Badge -->
      <div class="inline-block px-4 py-2 bg-cyan-500/10 rounded-full border border-cyan-500/20 backdrop-blur-sm">
        <span class="text-cyan-400 text-sm font-semibold uppercase tracking-wider">
          ⚛️ React Integration Demo
        </span>
      </div>

      <!-- Title -->
      <div class="space-y-6">
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight">
          <span class="block text-white mb-2">React + PHP</span>
          <span class="block bg-linear-to-r from-cyan-400 via-blue-500 to-purple-500 bg-clip-text text-transparent">
            Integração Completa
          </span>
        </h1>

        <p class="text-base sm:text-lg md:text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed">
          Demonstração da integração perfeita entre React e PHP no SoftEdge Corporation website.
          <br class="hidden sm:block">
          Componentes modulares, estado compartilhado e performance otimizada.
        </p>
      </div>

      <!-- React App Container -->
      <div class="max-w-4xl mx-auto">
        <div class="relative">
          <div class="absolute inset-0 bg-linear-to-r from-cyan-500/10 via-blue-500/10 to-purple-500/10 rounded-3xl blur-3xl"></div>

          <div class="relative bg-slate-900/60 backdrop-blur-xl border border-white/10 rounded-3xl p-8">
            <!-- React App will be mounted here -->
            <div id="root" class="min-h-[400px] flex items-center justify-center">
              <div class="text-center space-y-4">
                <div class="w-16 h-16 bg-cyan-500/20 rounded-full flex items-center justify-center mx-auto animate-pulse">
                  <i data-lucide="loader-2" class="w-8 h-8 text-cyan-400 animate-spin"></i>
                </div>
                <p class="text-gray-400">Carregando aplicação React...</p>
              </div>
            </div>

            <!-- Fallback for when React is not loaded -->
            <noscript>
              <div class="text-center py-8">
                <i data-lucide="alert-triangle" class="w-16 h-16 text-yellow-400 mx-auto mb-4"></i>
                <h3 class="text-xl font-bold text-white mb-2">JavaScript Necessário</h3>
                <p class="text-gray-400">Esta página requer JavaScript para funcionar corretamente.</p>
              </div>
            </noscript>
          </div>
        </div>
      </div>

      <!-- Info Cards -->
      <div class="grid sm:grid-cols-3 gap-6 lg:gap-8 mt-16 max-w-4xl mx-auto">
        <!-- Info 1 -->
        <div class="text-center">
          <div class="w-12 h-12 bg-cyan-500/10 rounded-xl flex items-center justify-center mx-auto mb-4">
            <i data-lucide="zap" class="w-6 h-6 text-cyan-400"></i>
          </div>
          <h3 class="text-white font-semibold mb-2">Performance</h3>
          <p class="text-gray-400 text-sm">Componentes otimizados com lazy loading</p>
        </div>

        <!-- Info 2 -->
        <div class="text-center">
          <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center mx-auto mb-4">
            <i data-lucide="code-2" class="w-6 h-6 text-blue-400"></i>
          </div>
          <h3 class="text-white font-semibold mb-2">Modular</h3>
          <p class="text-gray-400 text-sm">Componentes reutilizáveis e manuteníveis</p>
        </div>

        <!-- Info 3 -->
        <div class="text-center">
          <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center mx-auto mb-4">
            <i data-lucide="refresh-cw" class="w-6 h-6 text-purple-400"></i>
          </div>
          <h3 class="text-white font-semibold mb-2">Dinâmico</h3>
          <p class="text-gray-400 text-sm">Estado reativo e interações fluidas</p>
        </div>
      </div>

      <!-- Back to Home -->
      <div class="pt-12">
        <a href="index.php" class="inline-flex items-center gap-2 text-cyan-400 hover:text-cyan-300 transition-colors group">
          <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
          <span>Voltar ao início</span>
        </a>
      </div>

    </div>
  </div>
</section>

<!-- Load React App -->
<script>
  // Load React app when DOM is ready
  document.addEventListener('DOMContentLoaded', function() {
    // Check if React bundle exists
    fetch('/dist/main.js')
      .then(response => {
        if (response.ok) {
          // Load React bundle
          const script = document.createElement('script');
          script.src = '/dist/main.js';
          script.onload = function() {
            console.log('React app loaded successfully');
          };
          script.onerror = function() {
            console.error('Failed to load React app');
            showFallback();
          };
          document.head.appendChild(script);
        } else {
          console.warn('React bundle not found, showing fallback');
          showFallback();
        }
      })
      .catch(error => {
        console.error('Error checking React bundle:', error);
        showFallback();
      });
  });

  function showFallback() {
    const root = document.getElementById('root');
    if (root) {
      root.innerHTML = `
        <div class="text-center space-y-4">
          <div class="w-16 h-16 bg-yellow-500/20 rounded-full flex items-center justify-center mx-auto">
            <i data-lucide="alert-triangle" class="w-8 h-8 text-yellow-400"></i>
          </div>
          <h3 class="text-xl font-bold text-white">React App Indisponível</h3>
          <p class="text-gray-400 text-sm">O aplicativo React não foi carregado. Execute <code class="bg-slate-800 px-2 py-1 rounded text-xs">npm run build</code> para gerar os arquivos.</p>
        </div>
      `;
    }
  }
</script>

<?php include 'components/footer.php'; ?>

<!-- SCRIPTS -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons
    lucide.createIcons();
  });
</script>

<style>
  /* Custom styles for React integration */
  #root {
    transition: opacity 0.3s ease;
  }

  #root.fade-in {
    opacity: 1;
  }

  /* Loading animation */
  @keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }

  .animate-spin {
    animation: spin 1s linear infinite;
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
</style>
