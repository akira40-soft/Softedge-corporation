# SoftEdge Corporation - Website Oficial

[![PHP Version](https://img.shields.io/badge/PHP-8.3-blue.svg)](https://php.net)
[![Docker](https://img.shields.io/badge/Docker-Ready-blue.svg)](https://docker.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC.svg)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Website institucional da SoftEdge Corporation - Especialistas em desenvolvimento de software, soluções tecnológicas e consultoria digital.

## 🚀 Demonstração

🌐 **Site ao Vivo:** [softedge-corporation.up.railway.app](https://softedge-corporation.up.railway.app)

## 📋 Características

### 🎨 Design & UX
- **Design Moderno**: Interface dark com gradientes animados
- **Responsivo**: Otimizado para desktop, tablet e mobile
- **Acessível**: Suporte completo a navegação por teclado
- **Performance**: Carregamento otimizado e lazy loading

### 🔧 Tecnologias
- **Backend**: PHP 8.3 com Composer e arquitetura MVC
- **Frontend**: React 18.2.0 + Webpack 5 + Babel 7
- **Styling**: Tailwind CSS v4+ com componentes customizados
- **Icons**: Lucide Icons (biblioteca moderna e leve)
- **Email**: PHPMailer com templates profissionais
- **Database**: MySQL com otimização de queries

### 🛡️ Segurança
- **Headers de Segurança**: XSS, CSRF, Clickjacking protection
- **Rate Limiting**: Anti-spam nos formulários
- **Input Sanitization**: Validação e limpeza de dados
- **HTTPS Ready**: Configurado para SSL

### 📱 Funcionalidades
- **6 Páginas Completas**: Home, Serviços, Projetos, Sobre, Contato, Feedback
- **Formulário de Contato**: Com validação e envio por email
- **Portfolio Interativo**: Showcase de projetos desenvolvidos
- **Health Check**: Monitoramento de uptime
- **Multi-plataforma**: Suporte a Railway, Render e Docker

## 🏗️ Arquitetura

```
Site-SoftEdge/
├── 📁 assets/           # Imagens, ícones e recursos estáticos
├── 📁 components/       # Header e Footer reutilizáveis (PHP)
├── 📁 css/             # Estilos personalizados e animações
├── 📁 js/              # Scripts JavaScript utilitários
├── 📁 src/
│   ├── 📁 react/       # 🚀 Aplicação React completa
│   │   ├── App.js     # Componente principal
│   │   ├── App.css    # Estilos React
│   │   └── index.js   # Ponto de entrada
│   └── 📁 php/        # Classes PHP (MVC)
├── 🐳 Dockerfile       # Build automatizado multi-plataforma
├── 📄 *.php            # Páginas principais com integração React
├── ⚙️ composer.json    # Dependências PHP profissional
├── 📦 package.json     # 📦 Dependências Node.js + Webpack
├── 🔧 .htaccess        # Configurações Apache otimizadas
├── ⚙️ webpack.config.js # Build system React
└── 📊 health.php       # Monitoramento de saúde avançado
```

## 🚀 Deploy

### Opção 1: Railway (Recomendado)

1. **Fork/Clone o repositório:**
   ```bash
   git clone https://github.com/akira40-soft/Softedge.git
   cd Site-SoftEdge
   ```

2. **Deploy no Railway:**
   - Conecte seu repositório GitHub ao Railway
   - Railway detectará automaticamente o `Dockerfile` e `Railway.json`
   - Deploy automático será iniciado

3. **Configuração:**
   - **Build Command**: Automático via Dockerfile
   - **Start Command**: `apache2-foreground`
   - **Port**: 8080 (configurado automaticamente)

### Opção 2: Render

1. **Conecte ao Render:**
   - Importe o repositório no Render
   - Selecione "Docker" como runtime
   - Use o `render.yaml` incluído

2. **Configuração:**
   ```yaml
   type: web
   runtime: docker
   dockerfilePath: ./Dockerfile
   healthCheckPath: /health.php
   ```

### Opção 3: Docker Local

```bash
# Build da imagem
docker build -t softedge-site .

# Executar container
docker run -p 8080:8080 softedge-site

# Acessar: http://localhost:8000
```

## 🔧 Desenvolvimento Local

### Pré-requisitos
- **PHP 8.1+** com extensões necessárias
- **Composer** para dependências
- **Docker** (opcional, mas recomendado)

### Instalação

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/akira40-soft/Softedge.git
   cd Site-SoftEdge
   ```

2. **Instale dependências:**
   ```bash
   composer install
   ```

3. **Configure ambiente:**
   ```bash
   cp .env.example .env
   # Edite .env com suas configurações
   ```

4. **Execute localmente:**
   ```bash
   # Opção 1: PHP built-in server
   php -S localhost:8000

   # Opção 2: Docker
   docker build -t softedge-site .
   docker run -p 8080:8080 softedge-site
   ```

## 📧 Configuração de Email

Para o formulário de contato funcionar, configure as variáveis no `.env`:

```env
# Email Configuration
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USERNAME=your-email@gmail.com
SMTP_PASSWORD=your-app-password
SMTP_ENCRYPTION=tls
SMTP_FROM_EMAIL=softedgecorporation@gmail.com
SMTP_FROM_NAME=SoftEdge Corporation
```

## 📊 Monitoramento

### Health Check
- **Endpoint**: `/health.php`
- **Status**: Verifica arquivos críticos e conectividade
- **Uptime**: Monitora tempo de atividade

### Logs
- **PHP Errors**: `logs/php_errors.log`
- **Apache Logs**: Configurados automaticamente
- **Rate Limiting**: `logs/rate_limit_*.txt`

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 📞 Contato

**SoftEdge Corporation**
- **Email**: softedgecorporation@gmail.com
- **WhatsApp**: [Canal Oficial](https://whatsapp.com/channel/0029VawQLpGHltY2Y87fR83m)
- **Twitter/X**: [@softedge40](https://x.com/softedge40)
- **Localização**: Luanda, Angola 🇦🇴

---

**Desenvolvido com ❤️ pela equipe SoftEdge Corporation**

*Isaac Quarenta • José Lopes • Stefânio Costa • Tiago Rodrigues*
