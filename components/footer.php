<!-- components/footer.php -->
<footer class="relative bg-slate-950/95 backdrop-blur-xl border-t border-white/5 mt-20 overflow-hidden">
  <!-- Gradient Background -->
  <div class="absolute inset-0 bg-linear-to-b from-transparent via-cyan-950/5 to-blue-950/10 pointer-events-none"></div>
  
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Main Content -->
    <div class="py-16 lg:py-20">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">
        
        <!-- Column 1: Logo & Description -->
        <div class="text-center lg:text-left">
          <div class="flex items-center justify-center lg:justify-start space-x-3 mb-6">
            <div class="w-12 h-12 rounded-xl overflow-hidden bg-linear-to-br from-cyan-500 to-blue-600 p-0.5 shadow-lg">
              <img src="/assets/logo.jpeg" alt="SoftEdge Logo" class="w-full h-full object-cover rounded-xl">
            </div>
            <span class="text-2xl font-bold bg-linear-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
              SoftEdge
            </span>
          </div>
          
          <p class="text-gray-400 text-sm leading-relaxed max-w-xs mx-auto lg:mx-0">
            Começamos com um sonho. Hoje desenvolvemos realidades lógicas e softwares mais amáveis.
          </p>
          
          <p class="text-gray-500 text-xs mt-4">
            Fundada em 2023 por Isaac Quarenta
          </p>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="text-center lg:text-left">
          <h3 class="text-slate-200 font-medium text-sm mb-4 uppercase tracking-wide">
            Navegação
          </h3>
          <nav class="space-y-2">
            <a href="index.php" class="block text-slate-400 hover:text-slate-200 transition-colors text-sm">
              Início
            </a>
            <a href="sobre.php" class="block text-slate-400 hover:text-slate-200 transition-colors text-sm">
              Empresa
            </a>
            <a href="servicos.php" class="block text-slate-400 hover:text-slate-200 transition-colors text-sm">
              Serviços
            </a>
            <a href="projetos.php" class="block text-slate-400 hover:text-slate-200 transition-colors text-sm">
              Projetos
            </a>
            <a href="contato.php" class="block text-slate-400 hover:text-slate-200 transition-colors text-sm">
              Contato
            </a>
          </nav>
        </div>

        <!-- Column 3: Contact & Social -->
        <div class="text-center lg:text-left">
          <h3 class="text-slate-200 font-medium text-sm mb-4 uppercase tracking-wide">
            Contato
          </h3>

          <!-- Contact Info -->
          <div class="space-y-3 mb-6">
            <a href="mailto:softedgecorporation@gmail.com"
               class="flex items-center justify-center lg:justify-start gap-3 text-slate-400 hover:text-slate-200 transition-colors">
              <i data-lucide="mail" class="w-4 h-4"></i>
              <span class="text-sm">Email</span>
            </a>

            <a href="https://whatsapp.com/channel/0029VawQLpGHltY2Y87fR83m"
               target="_blank"
               rel="noopener noreferrer"
               class="flex items-center justify-center lg:justify-start gap-3 text-slate-400 hover:text-slate-200 transition-colors">
              <i data-lucide="message-circle" class="w-4 h-4"></i>
              <span class="text-sm">WhatsApp</span>
            </a>
          </div>

          <!-- Social Links -->
          <div class="flex items-center justify-center lg:justify-start gap-2">
            <a href="https://x.com/softedge40"
               target="_blank"
               rel="noopener noreferrer"
               class="w-8 h-8 rounded border border-slate-600 hover:border-slate-500 flex items-center justify-center transition-colors"
               aria-label="Twitter / X">
              <i data-lucide="twitter" class="w-4 h-4 text-slate-400"></i>
            </a>

            <a href="mailto:softedgecorporation@gmail.com"
               class="w-8 h-8 rounded border border-slate-600 hover:border-slate-500 flex items-center justify-center transition-colors"
               aria-label="Email">
              <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
            </a>

            <a href="https://whatsapp.com/channel/0029VawQLpGHltY2Y87fR83m"
               target="_blank"
               rel="noopener noreferrer"
               class="w-8 h-8 rounded border border-slate-600 hover:border-slate-500 flex items-center justify-center transition-colors"
               aria-label="WhatsApp">
              <i data-lucide="message-circle" class="w-4 h-4 text-slate-400"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-white/5 py-8">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-500">
        <div class="text-center md:text-left">
          <p>© 2025 <span class="text-white font-medium">SoftEdge Corporation</span>. Todos os direitos reservados.</p>
        </div>
        
        <div class="flex items-center gap-6">
          <a href="#" class="hover:text-cyan-400 transition-colors">Privacidade</a>
          <a href="#" class="hover:text-cyan-400 transition-colors">Termos</a>
          <div class="flex items-center gap-2">
            <i data-lucide="map-pin" class="w-4 h-4"></i>
            <span>Luanda, Angola</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Decorative Elements -->
  <div class="absolute bottom-0 left-0 right-0 h-px bg-linear-to-r from-transparent via-cyan-500/50 to-transparent"></div>
</footer>

<!-- Initialize Icons -->
<script>
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
</script>

</body>
</html>
