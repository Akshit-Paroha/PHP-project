<div align="center">

# 📣 MarketingPro

**A PHP-based Digital Marketing Management System**

![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white)
![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)

</div>

---

## 📋 Features

| Feature | Description |
|---|---|
| 🔐 **User Auth** | Register, login, logout with hashed passwords |
| 📢 **Campaigns** | Admin can create and manage marketing campaigns |
| 👥 **Join Campaigns** | Users can join campaigns from their dashboard |
| 📬 **Lead Collection** | Contact form submissions stored as leads |
| 🛡️ **Admin Panel** | Separate admin login, dashboard, leads & campaign management |

---

## 🗂️ Project Structure

```
marketing_project/
├── index.php              # Landing page
├── register.php           # User registration
├── login.php              # User login
├── logout.php             # User logout
├── dashboard.php          # User dashboard — view & join campaigns
├── join.php               # Handle campaign join
├── contact_submit.php     # Handle contact form submission
│
├── db.php                 # DB connection (loads from config.php)
├── config.example.php     # ← Copy this to config.php and fill credentials
│
└── admin/
    ├── adminlogin.php     # Admin login
    ├── adminlogout.php    # Admin logout
    ├── admindashboard.php # Admin overview (users, campaigns, leads)
    ├── campaigns.php      # Admin — manage campaigns
    ├── leads.php          # Admin — view leads
    └── view_join.php      # Admin — view campaign joiners
```

---

## ⚙️ Setup Instructions

### 1. Clone the repository
```bash
git clone https://github.com/your-username/marketing_project.git
cd marketing_project
```

### 2. Configure the database
```bash
cp config.example.php config.php
```
Open `config.php` and fill in your database credentials:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_db_username');
define('DB_PASS', 'your_db_password');
define('DB_NAME', 'your_db_name');
```

### 3. Import the database schema
Run the following SQL in your MySQL client (phpMyAdmin or CLI):

```sql
CREATE TABLE subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE campaigns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    start_date DATE,
    end_date DATE,
    budget DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_campaigns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    campaign_id INT NOT NULL,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(150),
    message TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

### 4. Deploy
- Place the project folder inside your server's root (`htdocs/` for XAMPP, `www/` for WAMP).
- Visit `http://localhost/marketing_project/`

---

## 🔒 Security Note

`config.php` is listed in `.gitignore` and will **never** be committed.  
Always use `config.example.php` as a template when sharing or deploying.

---

## 👤 Author

**Akshit Paroha**  
[GitHub](https://github.com/Akshit-Paroha) · [Portfolio](https://Akshit-Paroha.github.io)
