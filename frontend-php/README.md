# QuietScan – PHP Full-Stack Frontend

This directory (`/frontend-php`) provides a complete duplicate frontend written in **PHP, HTML5, CSS3, and JavaScript**.

It matches the exact behavior, authentication, and routing of the original Python-Flask QuietScan application, using native PHP sessions and CSV authentication (`users.csv`).

---

## 💻 How to Run Locally

You can test this PHP application with any local PHP server or Apache/XAMPP/WAMP environment.

### Option 1: PHP Built-in Server (Fastest)
In your terminal, run:
```bash
cd "frontend-php"
php -S localhost:8000
```
Then open: **`http://localhost:8000`** in your web browser.

### Option 2: XAMPP / WAMP / LAMP
1. Copy the `frontend-php` folder into your web root (e.g. `htdocs/quietscan` in XAMPP).
2. Start the Apache service.
3. Open `http://localhost/quietscan/` in your browser.

---

## 🔑 Default Accounts (from users.csv)

| Username | Password | Role |
| :--- | :--- | :--- |
| `Sanjai` | `06122006` | Admin / Backend Lead |
| `Pon` | `19102006` | Project Lead |
| `Rishapthi` | `19052007` | Authorized Operator |
| `Reshekumar` | `17112006` | Authorized Operator |

You can also register new accounts directly through `register.php`, which will append records to `users.csv`.

---

## 📂 Structure

- `config.php`: Session handling, CSV read/write functions.
- `includes/`: Modular `header.php`, `navbar.php`, `footer.php`.
- `index.php`: Auto-redirects to `sound.php` or `home.php`.
- `home.php`, `about.php`, `team.php`, `contact.php`: Public content pages.
- `login.php` & `register.php`: CSV-backed authentication pages.
- `sound.php`: Sound Detection Dashboard with live controls, acoustic trigger testing, and snapshot image viewing.
- `stop.php` & `start.php`: Session-based monitoring state switches.
- `api/detection.php`: JSON REST endpoint returning simulated detection objects.
- `css/style.css`: Clean, responsive stylesheet with relative background image.
