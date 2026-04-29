<div align="center">
  <h1>🛠️ Infocell Helpdesk System</h1>
  <p>
    <b>🇺🇸 English</b> | <a href="README.pt-BR.md">🇧🇷 Português</a>
  </p>
  <p><i>A comprehensive, MVC-based technical support management system built with Laravel.</i></p>

  <p>
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
    <img src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
    <img src="https://img.shields.io/badge/Laravel_Dusk-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Dusk" />
  </p>
</div>

---

## 📖 About the Project

The **Infocell Helpdesk** is a robust web application designed to streamline IT support operations, hardware maintenance workflows, and client management. Developed as a capstone project (TCC), it focuses on translating complex business rules into an intuitive interface, ensuring that technicians and administrators can track service lifecycles from opening to billing.

Unlike basic CRUD applications, this system emphasizes **Data Analytics** (through an integrated management dashboard) and **Software Quality Assurance** (via End-to-End automated testing).

### ✨ Key Features

* **🎫 Ticket Lifecycle Management:** Create, track, and close service tickets with dynamic status updates and cost tracking.
* **📊 Analytical Dashboard:** Real-time metrics tracking weekly revenue, daily open tickets, and service category distributions using Chart.js.
* **👥 Role-Based Access Control (RBAC):** Secure routing and middleware distinguishing Administrators from Technicians.
* **📄 Automated PDF Generation:** Instantly generate printable Service Orders using `DomPDF`.
* **🤖 End-to-End Testing:** Critical user flows are automatically validated using **Laravel Dusk** browser tests.

---

## 🏗️ System Architecture

This project strictly adheres to the **MVC (Model-View-Controller)** design pattern.

* **Backend:** PHP 8.x, Laravel Framework
* **Database:** MySQL (Structured with Laravel Migrations & Seeders)
* **Frontend:** Laravel Blade, HTML5, CSS3, JavaScript
* **Testing:** Laravel Dusk (E2E), PHPUnit
* **Deployment:** Designed for cloud deployment via Render (Backend) and Aiven (Managed Database)

---

## 🚀 Getting Started (Local Development)

Follow these instructions to set up the project on your local machine for development and testing.

### Prerequisites

* PHP >= 8.1
* Composer
* Node.js & NPM
* MySQL / MariaDB (e.g., via Laragon or XAMPP)

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/lukastorresu/infocell-helpdesk.git
cd infocell-helpdesk
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install frontend dependencies and compile assets**
```bash
npm install
npm run build
```

4. **Environment setup**
```bash
cp .env.example .env
```

5. **Generate the application key**
```bash
php artisan key:generate
```

6. **Configure database credentials** in `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projetophp
DB_USERNAME=root
DB_PASSWORD=
```

7. **Run migrations and seeders**
```bash
php artisan migrate --seed
```

8. **Start the local server**
```bash
php artisan serve
```

9. Visit `http://localhost:8000` in your browser.

---

## 🧪 Testing

This application uses Laravel Dusk to ensure UI and business logic integrity.

```bash
php artisan dusk
```

> Make sure your local server is running and `.env.dusk.local` is properly configured.

---

## 👨‍💻 Author

**Lucas (Luke) Torres**

* Junior Data Analyst | Software Developer
* LinkedIn: linkedin.com/in/lucastorres28
