/**
 * ═══════════════════════════════════════════════════════════
 * SOFTEDGE CORPORATION - APP.JS
 * Sistema completo de interações e animações
 * Versão: 2.0 - Ultra Moderno (2025)
 * ═══════════════════════════════════════════════════════════
 */

// ═══════════════════════════════════════════════════════════
// 🎯 INICIALIZAÇÃO PRINCIPAL
// ═══════════════════════════════════════════════════════════
class SoftEdgeApp {
  constructor() {
    this.init();
  }

  init() {
    // Esperar DOM estar pronto
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => this.start());
    } else {
      this.start();
    }
  }

  start() {
    console.log('%c🚀 SoftEdge Corporation', 'font-size: 20px; color: #06b6d4; font-weight: bold;');
    console.log('%cWebsite carregado com sucesso!', 'color: #10b981;');
    
    // Inicializar todos os módulos
    this.initLucideIcons();
    this.initSmoothScroll();
    this.initScrollAnimations();
    this.initParallaxEffects();
    this.initTypewriterEffect();
    this.initCursorEffect();
    this.initLazyLoading();
    this.initDarkMode();
    this.initPerformanceMonitor();
    this.initProgressBar();
    this.initBackToTop();
    this.initFormEnhancements();
    this.initNavigationEffects();
    this.initPreloader();
    this.initKeyboardShortcuts();
  }

  // ═══════════════════════════════════════════════════════════
  // 🎨 ÍCONES LUCIDE
  // ═══════════════════════════════════════════════════════════
  initLucideIcons() {
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  }

  // ═══════════════════════════════════════════════════════════
  // 🎢 SMOOTH SCROLL (Nativo, sem bibliotecas)
  // ═══════════════════════════════════════════════════════════
  initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', (e) => {
        const href = anchor.getAttribute('href');
        if (href === '#') return;
        
        e.preventDefault();
        const target = document.querySelector(href);
        
        if (target) {
          const headerHeight = document.querySelector('header')?.offsetHeight || 0;
          const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
          
          window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
          });
        }
      });
    });
  }

  // ═══════════════════════════════════════════════════════════
  // ✨ ANIMAÇÕES NO SCROLL (Intersection Observer)
  // ═══════════════════════════════════════════════════════════
  initScrollAnimations() {
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.classList.add('animate-in');
          }, index * 100); // Efeito cascata
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // Observar elementos com classes específicas
    const animateElements = document.querySelectorAll(`
      section, 
      .card, 
      .group, 
      .project-card, 
      .service-card,
      h1, h2, h3,
      p:not(footer p)
    `);

    animateElements.forEach((el) => {
      el.classList.add('will-animate');
      observer.observe(el);
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 🌊 EFEITO PARALLAX
  // ═══════════════════════════════════════════════════════════
  initParallaxEffects() {
    let ticking = false;

    const parallaxElements = document.querySelectorAll('[data-parallax]');
    
    if (parallaxElements.length === 0) return;

    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          const scrolled = window.pageYOffset;
          
          parallaxElements.forEach((el) => {
            const speed = parseFloat(el.dataset.parallax) || 0.5;
            const yPos = -(scrolled * speed);
            el.style.transform = `translate3d(0, ${yPos}px, 0)`;
          });
          
          ticking = false;
        });
        ticking = true;
      }
    });
  }

  // ═══════════════════════════════════════════════════════════
  // ⌨️ EFEITO TYPEWRITER (Máquina de escrever)
  // ═══════════════════════════════════════════════════════════
  initTypewriterEffect() {
    const typewriterElements = document.querySelectorAll('[data-typewriter]');
    
    typewriterElements.forEach((element) => {
      const text = element.textContent;
      const speed = parseInt(element.dataset.typewriterSpeed) || 50;
      element.textContent = '';
      element.style.opacity = '1';
      
      let index = 0;
      const type = () => {
        if (index < text.length) {
          element.textContent += text.charAt(index);
          index++;
          setTimeout(type, speed);
        }
      };
      
      // Iniciar quando o elemento estiver visível
      const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
          type();
          observer.disconnect();
        }
      });
      observer.observe(element);
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 🖱️ CURSOR CUSTOMIZADO
  // ═══════════════════════════════════════════════════════════
  initCursorEffect() {
    // Apenas em desktop
    if (window.matchMedia('(pointer: coarse)').matches) return;

    const cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    document.body.appendChild(cursor);

    const cursorFollower = document.createElement('div');
    cursorFollower.className = 'custom-cursor-follower';
    document.body.appendChild(cursorFollower);

    let mouseX = 0, mouseY = 0;
    let cursorX = 0, cursorY = 0;
    let followerX = 0, followerY = 0;

    document.addEventListener('mousemove', (e) => {
      mouseX = e.clientX;
      mouseY = e.clientY;
    });

    const animateCursor = () => {
      // Cursor principal (rápido)
      cursorX += (mouseX - cursorX) * 0.3;
      cursorY += (mouseY - cursorY) * 0.3;
      cursor.style.transform = `translate(${cursorX}px, ${cursorY}px)`;

      // Cursor follower (mais lento)
      followerX += (mouseX - followerX) * 0.1;
      followerY += (mouseY - followerY) * 0.1;
      cursorFollower.style.transform = `translate(${followerX}px, ${followerY}px)`;

      requestAnimationFrame(animateCursor);
    };
    animateCursor();

    // Efeitos em elementos clicáveis
    document.querySelectorAll('a, button, [role="button"]').forEach((el) => {
      el.addEventListener('mouseenter', () => {
        cursor.classList.add('cursor-hover');
        cursorFollower.classList.add('cursor-hover');
      });
      el.addEventListener('mouseleave', () => {
        cursor.classList.remove('cursor-hover');
        cursorFollower.classList.remove('cursor-hover');
      });
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 🖼️ LAZY LOADING DE IMAGENS
  // ═══════════════════════════════════════════════════════════
  initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.removeAttribute('data-src');
          img.classList.add('loaded');
          imageObserver.unobserve(img);
        }
      });
    });

    images.forEach((img) => imageObserver.observe(img));
  }

  // ═══════════════════════════════════════════════════════════
  // 🌙 DARK MODE AVANÇADO
  // ═══════════════════════════════════════════════════════════
  initDarkMode() {
    const darkModeToggle = document.createElement('button');
    darkModeToggle.innerHTML = '<i data-lucide="moon" class="w-5 h-5"></i>';
    darkModeToggle.className = 'fixed bottom-6 right-6 z-50 w-12 h-12 bg-slate-900/80 backdrop-blur-xl border border-white/10 text-white rounded-full shadow-lg hover:scale-110 transition-all duration-300 flex items-center justify-center';
    darkModeToggle.setAttribute('aria-label', 'Toggle Dark Mode');
    darkModeToggle.setAttribute('title', 'Alternar modo escuro');
    document.body.appendChild(darkModeToggle);

    // Verificar preferência salva
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme === 'light' || 
        (!currentTheme && window.matchMedia('(prefers-color-scheme: light)').matches)) {
      document.documentElement.classList.add('light-mode');
      darkModeToggle.innerHTML = '<i data-lucide="sun" class="w-5 h-5"></i>';
    }

    darkModeToggle.addEventListener('click', () => {
      document.documentElement.classList.toggle('light-mode');
      const isLight = document.documentElement.classList.contains('light-mode');
      
      localStorage.setItem('theme', isLight ? 'light' : 'dark');
      darkModeToggle.innerHTML = isLight 
        ? '<i data-lucide="sun" class="w-5 h-5"></i>'
        : '<i data-lucide="moon" class="w-5 h-5"></i>';
      
      lucide.createIcons();
      
      // Animação de transição
      document.body.style.transition = 'background-color 0.3s ease';
    });

    lucide.createIcons();
  }

  // ═══════════════════════════════════════════════════════════
  // 📊 MONITOR DE PERFORMANCE
  // ═══════════════════════════════════════════════════════════
  initPerformanceMonitor() {
    if ('performance' in window) {
      window.addEventListener('load', () => {
        setTimeout(() => {
          const perfData = performance.getEntriesByType('navigation')[0];
          const loadTime = perfData.loadEventEnd - perfData.fetchStart;
          
          console.log(`%c⚡ Performance`, 'color: #f59e0b; font-weight: bold;');
          console.log(`Tempo de carregamento: ${(loadTime / 1000).toFixed(2)}s`);
          
          // Mostrar notificação se o site carregar rápido
          if (loadTime < 1500) {
            this.showNotification('⚡ Site carregado em menos de 1.5s!', 'success');
          }
        }, 0);
      });
    }
  }

  // ═══════════════════════════════════════════════════════════
  // 📈 BARRA DE PROGRESSO DE LEITURA
  // ═══════════════════════════════════════════════════════════
  initProgressBar() {
    const progressBar = document.createElement('div');
    progressBar.className = 'reading-progress-bar';
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', () => {
      const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrolled = (window.scrollY / windowHeight) * 100;
      progressBar.style.width = `${scrolled}%`;
    });
  }

  // ═══════════════════════════════════════════════════════════
  // ⬆️ BOTÃO VOLTAR AO TOPO
  // ═══════════════════════════════════════════════════════════
  initBackToTop() {
    const backToTop = document.createElement('button');
    backToTop.innerHTML = '<i data-lucide="arrow-up" class="w-5 h-5"></i>';
    backToTop.className = 'back-to-top fixed bottom-6 left-6 z-50 w-12 h-12 bg-cyan-500 text-white rounded-full shadow-lg opacity-0 invisible transition-all duration-300 flex items-center justify-center hover:scale-110';
    backToTop.setAttribute('aria-label', 'Voltar ao topo');
    document.body.appendChild(backToTop);

    window.addEventListener('scroll', () => {
      if (window.scrollY > 500) {
        backToTop.classList.remove('opacity-0', 'invisible');
      } else {
        backToTop.classList.add('opacity-0', 'invisible');
      }
    });

    backToTop.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    lucide.createIcons();
  }

  // ═══════════════════════════════════════════════════════════
  // 📝 MELHORIAS EM FORMULÁRIOS
  // ═══════════════════════════════════════════════════════════
  initFormEnhancements() {
    // Auto-resize para textareas
    document.querySelectorAll('textarea').forEach((textarea) => {
      textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
      });
    });

    // Validação em tempo real
    document.querySelectorAll('input[type="email"]').forEach((input) => {
      input.addEventListener('blur', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value && !emailRegex.test(this.value)) {
          this.classList.add('border-red-500');
          this.classList.remove('border-cyan-500');
        } else if (this.value) {
          this.classList.add('border-cyan-500');
          this.classList.remove('border-red-500');
        }
      });
    });

    // Contador de caracteres para textareas
    document.querySelectorAll('textarea[maxlength]').forEach((textarea) => {
      const maxLength = textarea.getAttribute('maxlength');
      const counter = document.createElement('div');
      counter.className = 'text-sm text-gray-400 mt-2 text-right';
      textarea.parentNode.appendChild(counter);

      const updateCounter = () => {
        const remaining = maxLength - textarea.value.length;
        counter.textContent = `${remaining} caracteres restantes`;
        if (remaining < 50) {
          counter.classList.add('text-orange-400');
        } else {
          counter.classList.remove('text-orange-400');
        }
      };

      textarea.addEventListener('input', updateCounter);
      updateCounter();
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 🧭 EFEITOS DE NAVEGAÇÃO
  // ═══════════════════════════════════════════════════════════
  initNavigationEffects() {
    const header = document.querySelector('header');
    if (!header) return;

    let lastScroll = 0;

    window.addEventListener('scroll', () => {
      const currentScroll = window.pageYOffset;

      // Adicionar sombra ao rolar
      if (currentScroll > 50) {
        header.classList.add('shadow-lg');
      } else {
        header.classList.remove('shadow-lg');
      }

      // Esconder header ao rolar para baixo (opcional)
      // if (currentScroll > lastScroll && currentScroll > 500) {
      //   header.style.transform = 'translateY(-100%)';
      // } else {
      //   header.style.transform = 'translateY(0)';
      // }

      lastScroll = currentScroll;
    });
  }

  // ═══════════════════════════════════════════════════════════
  // ⏳ PRELOADER
  // ═══════════════════════════════════════════════════════════
  initPreloader() {
    const preloader = document.querySelector('.preloader');
    if (!preloader) return;

    window.addEventListener('load', () => {
      setTimeout(() => {
        preloader.classList.add('fade-out');
        setTimeout(() => {
          preloader.remove();
        }, 500);
      }, 300);
    });
  }

  // ═══════════════════════════════════════════════════════════
  // ⌨️ ATALHOS DE TECLADO
  // ═══════════════════════════════════════════════════════════
  initKeyboardShortcuts() {
    document.addEventListener('keydown', (e) => {
      // Ctrl/Cmd + K = Abrir menu de busca (se existir)
      if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        console.log('Busca ativada (Ctrl/Cmd + K)');
      }

      // Escape = Fechar modais
      if (e.key === 'Escape') {
        document.querySelectorAll('.modal.active, .dropdown.open').forEach((el) => {
          el.classList.remove('active', 'open');
        });
      }
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 🔔 SISTEMA DE NOTIFICAÇÕES
  // ═══════════════════════════════════════════════════════════
  showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => notification.classList.add('show'), 10);
    setTimeout(() => {
      notification.classList.remove('show');
      setTimeout(() => notification.remove(), 300);
    }, 3000);
  }
}

// ═══════════════════════════════════════════════════════════
// 🚀 INICIALIZAR APP
// ═══════════════════════════════════════════════════════════
const app = new SoftEdgeApp();

// ═══════════════════════════════════════════════════════════
// 🎨 EXPORTAR PARA USO GLOBAL (se necessário)
// ═══════════════════════════════════════════════════════════
window.SoftEdgeApp = app;
