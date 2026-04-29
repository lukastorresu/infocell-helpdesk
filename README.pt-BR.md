<div align="center">
  <p>
    <a href="README.md">🇺🇸 English</a> | <b>🇧🇷 Português</b>
  </p>

  <h1>🛠️ Sistema Infocell Helpdesk</h1>
  <p><i>Um sistema robusto de gestão de suporte técnico, baseado no padrão MVC e construído com Laravel.</i></p>

  <p>
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
    <img src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
    <img src="https://img.shields.io/badge/Laravel_Dusk-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Dusk" />
  </p>
</div>

---

## 📖 Sobre o Projeto

O **Infocell Helpdesk** é uma aplicação web robusta projetada para otimizar operações de suporte de TI, fluxos de manutenção de hardware e gestão de clientes.

### ✨ Principais Funcionalidades

* **🎫 Gestão do Ciclo de Vida de Chamados**
* **📊 Dashboard Analítico**
* **👥 Controle de Acesso (RBAC)**
* **📄 Geração Automatizada de PDF**
* **🤖 Testes End-to-End (E2E)**

---

## 🏗️ Arquitetura do Sistema

* **Backend:** PHP 8.x, Laravel
* **Banco de Dados:** MySQL
* **Frontend:** Blade, HTML5, CSS3, JavaScript
* **Testes:** Laravel Dusk, PHPUnit

---

## 🚀 Primeiros Passos (Desenvolvimento Local)

### Pré-requisitos

* PHP >= 8.1
* Composer
* Node.js & NPM
* MySQL / MariaDB

### Instalação

1. **Clone o repositório**
```bash
git clone https://github.com/lukastorresu/infocell-helpdesk.git
cd infocell-helpdesk
```

2. **Instale as dependências do PHP**
```bash
composer install
```

3. **Instale as dependências do Frontend e compile os assets**
```bash
npm install
npm run build
```

4. **Configure o ambiente**
```bash
cp .env.example .env
```

5. **Gere a chave da aplicação**
```bash
php artisan key:generate
```

6. **Configure o banco de dados** no `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projetophp
DB_USERNAME=root
DB_PASSWORD=
```

7. **Execute migrations e seeders**
```bash
php artisan migrate --seed
```

8. **Inicie o servidor local**
```bash
php artisan serve
```

9. Acesse `http://localhost:8000`.

---

## 🧪 Testes Automatizados

```bash
php artisan dusk
```

> Certifique-se de que o servidor local está rodando e `.env.dusk.local` configurado corretamente.

---

## 👨‍💻 Autor

**Lucas (Luke) Torres**

* Analista de Dados Júnior | Desenvolvedor de Software
* LinkedIn: linkedin.com/in/lucastorres28
