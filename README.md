# 🚀 SHRTN - URL Shortening Service

SHRTN is a fast and minimal URL shortening service built with **PHP and MySQL**. Convert long, messy links into clean and shareable short URLs with ease! 🔗✨

---

## 🎯 Features

- 🔗 **Instant Short URLs** - Convert any long URL into a short and readable format.
- 🔄 **Avoid Duplicates** - If a URL is already shortened, the same short code is reused.
- 📋 **One-Click Copy** - Copy the shortened URL directly to your clipboard.
- 🎨 **Sleek & Responsive Design** - Custom fonts, icons, and a simple UI for a smooth experience.

---

## 🛠️ Requirements

- **PHP 7.x or later**
- **MySQL Database**
- **Web Server** (Apache, Nginx, or built-in PHP server)

---

## ⚡ Installation

### 1️⃣ Clone the repository
```bash
git clone https://github.com/your-username/shrtn.git
cd shrtn
```

### 2️⃣ Set up the database
- Import `short_url_db.sql` into your MySQL server.
- Update `index.php` with your **database connection details**:
  ```php
  $host = 'your_host';
  $dbname = 'your_database';
  $user = 'your_username';
  $pass = 'your_password';
  ```

### 3️⃣ Start the server
Run the built-in PHP server:
```bash
php -S localhost:8000
```
Then, visit **[http://localhost:8000](http://localhost:8000)** to start using SHRTN! 🚀

---

## 🎮 How to Use

1️⃣ **Enter a long URL** in the input field.  
2️⃣ **Click "SHRTN!"** to generate a short URL.  
3️⃣ **Copy** the short URL using the clipboard icon and share it! 📢

---

## 🏗️ Technologies Used

- **PHP** 🐘
- **MySQL** 🛢️
- **Font Awesome** 🎨 (for the clipboard icon)
- **Google Fonts** ✍️ (for custom styling)

---

## 📜 License

This project is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Credits

Created by **Gabriele Meucci**. 🎩✨

---

🔥 *Shorten your URLs in style!*
