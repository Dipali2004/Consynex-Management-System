# Consynex Technologies - Training Institute Management System

A comprehensive web application for managing training institute courses, enquiries, and content, built with native PHP and modern frontend technologies.

## 🚀 Project Overview

This project serves as the official website and management system for Consynex Technologies. It features a public-facing website for students to explore courses and a secure admin dashboard for staff to manage content.

## 🛠️ Tech Stack

### Backend
*   **Server**: Apache (via XAMPP)
*   **Language**: PHP 8.2.12 (Native/Vanilla)
*   **Database**: MySQL / MariaDB
*   **Architecture**:
    *   PDO for secure database interactions.
    *   Custom MVC architecture for the `/training/` module.
    *   Custom regex-based router (`training/app/Router.php`).

### Frontend
*   **Framework**: Bootstrap 5.3.2
*   **Scripting**: Vanilla JavaScript + jQuery
*   **Styling**: CSS3, SASS/SCSS support
*   **Libraries**:
    *   Chart.js (Admin Analytics)
    *   Owl Carousel (Sliders)
    *   Magnific Popup (Lightboxes)
    *   Animate.css (Animations)
    *   FontAwesome 6.5.0 (Icons)

## 📂 Project Structure

```
/
├── Software-Services/       # Main User-Facing Website
│   ├── admin/               # Secure Admin Dashboard
│   ├── includes/            # Shared Header/Footer
│   └── ...                  # Public Pages (index.php, about-us.php, etc.)
├── training/                # MVC-based Training Module
│   ├── app/                 # Core Application Logic (Models, Router, Config)
│   ├── views/               # View Templates
│   └── index.php            # Front Controller
├── database.sql             # Database Schema Import File
└── README.md                # Project Documentation
```

## ⚙️ Setup Instructions (XAMPP)

1.  **Clone the Repository**
    *   Navigate to your XAMPP `htdocs` directory (e.g., `C:/xampp/htdocs/`).
    *   Clone the project folder. **Important:** The project is designed to run from a root folder (e.g., `Software-Services` or `Collage website`).
    *   *Recommended Path:* `C:/xampp/htdocs/Software-Services/`

2.  **Start Services**
    *   Open XAMPP Control Panel.
    *   Start **Apache** and **MySQL**.

3.  **Database Setup**
    *   Open PHPMyAdmin (`http://localhost/phpmyadmin`).
    *   Create a new database named `training_app`.
    *   Import the `database.sql` file provided in the project root.
    *   *Note:* The application is configured to connect to `training_app` with user `root` and empty password by default. Update `training/app/Config.php` if your credentials differ.

4.  **Run the Application**
    *   **Option A (XAMPP Root):** Access via `http://localhost/Software-Services/Software-Services/` (if folder structure is nested) or configure Virtual Host.
    *   **Option B (PHP Built-in Server - Recommended for Dev):**
        Open a terminal in the project root and run:
        ```bash
        php -S localhost:8000 -t .
        ```
        *   **User Site:** [http://localhost:8000/Software-Services/](http://localhost:8000/Software-Services/)
        *   **Admin Panel:** [http://localhost:8000/Software-Services/admin](http://localhost:8000/Software-Services/admin)

## 🔑 Admin Access

*   **URL:** `/Software-Services/admin`
*   **Default Credentials:**
    *   Username: `admin`
    *   Password: `admin123`

## 🤝 Collaboration & Git Workflow

*   **Main Branch (`main`)**: Stable, production-ready code.
*   **Development Branch (`dev`)**: Integration branch for ongoing work.
*   **Feature Branches**:
    *   `frontend` - For UI/UX updates.
    *   `backend` - For PHP/Database logic.

**Workflow:**
1.  Pull latest changes from `dev`.
2.  Create a feature branch.
3.  Commit changes.
4.  Push to `dev` for review.
