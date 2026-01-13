import React, { useState, useEffect } from 'react';
import './App.css';

// Componente principal da aplicação React
function App() {
  const [currentSection, setCurrentSection] = useState('home');
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    // Animação de entrada
    setTimeout(() => setIsVisible(true), 100);

    // Detectar seção atual baseada na URL
    const path = window.location.pathname;
    if (path.includes('servicos')) setCurrentSection('services');
    else if (path.includes('projetos')) setCurrentSection('projects');
    else if (path.includes('sobre')) setCurrentSection('about');
    else if (path.includes('contato')) setCurrentSection('contact');
    else setCurrentSection('home');
  }, []);

  return (
    <div className={`react-app ${isVisible ? 'visible' : ''}`}>
      <div className="react-container">
        <div className="react-header">
          <h3>🚀 SoftEdge Corporation - React Integration</h3>
          <p>Componentes React integrados com PHP</p>
        </div>

        <div className="react-content">
          <Navigation currentSection={currentSection} onNavigate={setCurrentSection} />
          <ContentSection section={currentSection} />
        </div>

        <div className="react-footer">
          <p>React + PHP = 💪 Potência Total</p>
        </div>
      </div>
    </div>
  );
}

// Componente de navegação
function Navigation({ currentSection, onNavigate }) {
  const sections = [
    { id: 'home', label: 'Início', icon: '🏠' },
    { id: 'services', label: 'Serviços', icon: '⚙️' },
    { id: 'projects', label: 'Projetos', icon: '📁' },
    { id: 'about', label: 'Sobre', icon: '👥' },
    { id: 'contact', label: 'Contato', icon: '📧' }
  ];

  return (
    <nav className="react-nav">
      {sections.map(section => (
        <button
          key={section.id}
          className={`nav-item ${currentSection === section.id ? 'active' : ''}`}
          onClick={() => onNavigate(section.id)}
        >
          <span className="nav-icon">{section.icon}</span>
          <span className="nav-label">{section.label}</span>
        </button>
      ))}
    </nav>
  );
}

// Componente de conteúdo dinâmico
function ContentSection({ section }) {
  const [stats, setStats] = useState(null);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    if (section === 'stats') {
      fetchStats();
    }
  }, [section]);

  const fetchStats = async () => {
    setLoading(true);
    try {
      // Simular chamada para API PHP
      const response = await fetch('/api.php?r=stats');
      const data = await response.json();
      setStats(data);
    } catch (error) {
      console.error('Erro ao buscar estatísticas:', error);
      // Dados mock para demonstração
      setStats({
        projects: 70,
        satisfaction: 4.9,
        support: '24/7',
        codeQuality: '100%'
      });
    }
    setLoading(false);
  };

  const renderContent = () => {
    switch (section) {
      case 'home':
        return (
          <div className="content-section">
            <h2>Bem-vindo à SoftEdge Corporation</h2>
            <p>Transformamos ideias em soluções digitais de excelência.</p>
            <div className="feature-grid">
              <div className="feature-card">
                <div className="feature-icon">🚀</div>
                <h3>Desenvolvimento Full Stack</h3>
                <p>Tecnologias modernas para aplicações completas</p>
              </div>
              <div className="feature-card">
                <div className="feature-icon">🤖</div>
                <h3>IA & Automação</h3>
                <p>Inteligência artificial para otimizar processos</p>
              </div>
              <div className="feature-card">
                <div className="feature-icon">⚡</div>
                <h3>Performance</h3>
                <p>Otimização e consultoria especializada</p>
              </div>
            </div>
          </div>
        );

      case 'services':
        return (
          <div className="content-section">
            <h2>Nossos Serviços</h2>
            <div className="services-grid">
              <ServiceCard
                icon="💻"
                title="Desenvolvimento Web"
                description="Aplicações web modernas com React, Next.js e PHP"
                technologies={['React', 'Next.js', 'PHP', 'MySQL']}
              />
              <ServiceCard
                icon="📱"
                title="Aplicativos Mobile"
                description="Apps nativos e multiplataforma"
                technologies={['Flutter', 'React Native', 'Firebase']}
              />
              <ServiceCard
                icon="🧠"
                title="Inteligência Artificial"
                description="Soluções de IA personalizadas"
                technologies={['Python', 'TensorFlow', 'OpenAI']}
              />
              <ServiceCard
                icon="☁️"
                title="Cloud & DevOps"
                description="Deploy e infraestrutura escalável"
                technologies={['Docker', 'AWS', 'Railway', 'Render']}
              />
            </div>
          </div>
        );

      case 'projects':
        return (
          <div className="content-section">
            <h2>Projetos em Destaque</h2>
            <div className="projects-grid">
              <ProjectCard
                title="AKIRA IA"
                description="Assistente virtual angolano com processamento de linguagem natural"
                status="Concluído"
                technologies={['Python', 'TensorFlow', 'FastAPI']}
              />
              <ProjectCard
                title="ERP Gestão Total"
                description="Sistema completo de gestão empresarial"
                status="Concluído"
                technologies={['Laravel', 'Vue.js', 'MySQL']}
              />
              <ProjectCard
                title="E-commerce ShopFast"
                description="Plataforma de vendas online de alta performance"
                status="Concluído"
                technologies={['Next.js', 'Stripe', 'Prisma']}
              />
            </div>
          </div>
        );

      case 'about':
        return (
          <div className="content-section">
            <h2>Sobre a SoftEdge</h2>
            <div className="about-content">
              <div className="team-section">
                <h3>Nossa Equipe</h3>
                <div className="team-members">
                  <TeamMember name="Isaac Quarenta" role="CEO & Fundador" />
                  <TeamMember name="José Lopes" role="CTO" />
                  <TeamMember name="Stefânio Costa" role="Desenvolvedor Senior" />
                  <TeamMember name="Tiago Rodrigues" role="Designer & UX" />
                </div>
              </div>
              <div className="mission-section">
                <h3>Nossa Missão</h3>
                <p>Transformar ideias em soluções tecnológicas que fazem a diferença no mundo digital.</p>
              </div>
            </div>
          </div>
        );

      case 'contact':
        return (
          <div className="content-section">
            <h2>Entre em Contato</h2>
            <ContactForm />
          </div>
        );

      default:
        return (
          <div className="content-section">
            <h2>Seção não encontrada</h2>
            <p>Selecione uma seção no menu de navegação.</p>
          </div>
        );
    }
  };

  return (
    <div className="content-container">
      {renderContent()}
    </div>
  );
}

// Componentes auxiliares
function ServiceCard({ icon, title, description, technologies }) {
  return (
    <div className="service-card">
      <div className="service-icon">{icon}</div>
      <h3>{title}</h3>
      <p>{description}</p>
      <div className="tech-stack">
        {technologies.map(tech => (
          <span key={tech} className="tech-tag">{tech}</span>
        ))}
      </div>
    </div>
  );
}

function ProjectCard({ title, description, status, technologies }) {
  return (
    <div className="project-card">
      <div className="project-header">
        <h3>{title}</h3>
        <span className={`status ${status.toLowerCase()}`}>{status}</span>
      </div>
      <p>{description}</p>
      <div className="tech-stack">
        {technologies.map(tech => (
          <span key={tech} className="tech-tag">{tech}</span>
        ))}
      </div>
    </div>
  );
}

function TeamMember({ name, role }) {
  return (
    <div className="team-member">
      <div className="member-avatar">
        <span>{name.charAt(0)}</span>
      </div>
      <div className="member-info">
        <h4>{name}</h4>
        <p>{role}</p>
      </div>
    </div>
  );
}

function ContactForm() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    message: ''
  });
  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch('/api.php?r=contact', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
      });

      if (response.ok) {
        setSubmitted(true);
        setFormData({ name: '', email: '', message: '' });
      }
    } catch (error) {
      console.error('Erro ao enviar formulário:', error);
    }
  };

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  if (submitted) {
    return (
      <div className="success-message">
        <h3>✅ Mensagem enviada com sucesso!</h3>
        <p>Entraremos em contato em breve.</p>
        <button onClick={() => setSubmitted(false)}>Enviar outra mensagem</button>
      </div>
    );
  }

  return (
    <form className="contact-form" onSubmit={handleSubmit}>
      <div className="form-group">
        <label htmlFor="name">Nome</label>
        <input
          type="text"
          id="name"
          name="name"
          value={formData.name}
          onChange={handleChange}
          required
        />
      </div>

      <div className="form-group">
        <label htmlFor="email">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          value={formData.email}
          onChange={handleChange}
          required
        />
      </div>

      <div className="form-group">
        <label htmlFor="message">Mensagem</label>
        <textarea
          id="message"
          name="message"
          value={formData.message}
          onChange={handleChange}
          rows="5"
          required
        />
      </div>

      <button type="submit" className="submit-btn">Enviar Mensagem</button>
    </form>
  );
}

export default App;
