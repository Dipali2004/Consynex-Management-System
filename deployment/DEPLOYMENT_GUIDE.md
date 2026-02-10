# 🚀 Deployment Guide: Staging on InfinityFree

This guide provides step-by-step instructions to deploy your **Consynex Technologies** website to a free staging environment on InfinityFree.

## ✅ Prerequisites (Included in `deployment/` folder)
1.  **Clean Website Files**: Located in `deployment/htdocs/`
    *   `Software-Services/` (Main website)
    *   `training/` (Backend framework)
2.  **Database Dump**: `deployment/database.sql`
3.  **Production Config**: `deployment/htdocs/training/app/Config_Production.php`

---

## 🔹 STEP 1: Create Free Hosting Account
1.  Go to 👉 [https://infinityfree.net](https://infinityfree.net)
2.  Sign up (free) and verify your email.
3.  Login to the dashboard.

## 🔹 STEP 2: Create Free Website
1.  Click **Create Account**.
2.  Choose **Free Subdomain** (e.g., `consynex-test`).
3.  Select a domain extension (e.g., `.infinityfreeapp.com`).
4.  Finish creation.
5.  **Note down your FTP details and Database details** from the account page.

## 🔹 STEP 3: Create MySQL Database
1.  In the InfinityFree Control Panel, click on **MySQL Databases**.
2.  Create a new database (e.g., `training_app`).
3.  **IMPORTANT**: Note the **Hostname** (usually `sqlXXX.infinityfree.com`), **Database Name** (e.g., `epiz_XXX_training_app`), **Username**, and **Password**.
4.  Click **Admin** (phpMyAdmin) next to your new database.
5.  Click the **Import** tab.
6.  Choose the file `deployment/database.sql` from your local computer.
7.  Click **Go** to import the tables.

## 🔹 STEP 4: Configure Database Connection
1.  Open the file `deployment/htdocs/training/app/Config_Production.php` on your computer.
2.  Edit the file with your InfinityFree database details:
    ```php
    'dsn' => 'mysql:host=sqlXXX.infinityfree.com;port=3306;dbname=epiz_XXXXXX_training_app;charset=utf8mb4',
    'user' => 'epiz_XXXXXX',
    'pass' => 'YOUR_PANEL_PASSWORD',
    ```
3.  **Rename** this file to `Config.php` (delete the old `Config.php` if it exists in the target, or just rename this one before uploading).

## 🔹 STEP 5: Upload Website Files (FTP)
1.  Download and install [FileZilla Client](https://filezilla-project.org/).
2.  Connect using your InfinityFree FTP credentials (Host, Username, Password, Port 21).
3.  Navigate to the remote `htdocs/` folder. **DELETE** the default `index2.html` or `default.php` if present.
4.  Upload the **contents** of your local `deployment/htdocs/` folder into the remote `htdocs/` folder.
    *   Remote structure should look like:
        *   `/htdocs/Software-Services/`
        *   `/htdocs/training/`
5.  **Important**: Ensure the `.htaccess` files are uploaded.

## 🔹 STEP 6: Verify Deployment
1.  Open your website URL (e.g., `http://consynex-test.infinityfreeapp.com/Software-Services/`).
2.  Check:
    *   Home page loads correctly.
    *   Testimonials show the correct image.
    *   Services and Courses pages load data from the database.
    *   **Admin Panel**: Go to `/Software-Services/admin/`. It should redirect to login.
    *   **Login**: Use your admin credentials.

## 🔹 STEP 7: Troubleshooting
*   **"Database Connection Error"**: Check `training/app/Config.php` credentials again. Ensure Hostname is correct (not localhost).
*   **"404 Not Found"**: Ensure `Software-Services` folder is inside `htdocs`.
*   **"403 Forbidden"**: Ensure `.htaccess` is not blocking legitimate files.

---
**Security Note**: Your staging environment is protected. `.env`, `.sql`, and `config` files are blocked from public access via `.htaccess`.
