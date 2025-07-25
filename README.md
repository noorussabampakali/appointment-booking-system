Appointment Booking System

A web-based appointment booking system built using **PHP**, **MySQL**, **HTML/CSS**, and **JavaScript**, created during Hackathon 2K25. The system supports **Admin**, **Doctor**, and **Patient** roles with authentication, emergency support, partial translation, and location-based features.

---

## 💡 Overview

This platform allows users to book medical appointments, manage sessions, and securely log in as doctors or patients. It also integrates real-world functionality such as emergency call support and finding nearby hospitals.

---

## 👥 User Roles & Features

### 🛠️ Admin
- Add, edit, and delete doctor profiles
- Schedule and manage doctor sessions
- View patient details and appointment history

### 👨‍⚕️ Doctor
- View their appointment sessions
- Manage account settings and availability

### 👤 Patient
- Sign up, log in, and book appointments
- View and manage past bookings
- Submit feedback or queries
- Access emergency and location features

---

## 🚨 Special Features

- 📍 **Nearby Hospital Finder**  
  Uses browser geolocation to help patients locate nearby hospitals from the homepage.

- ☎️ **Emergency Calling**  
  One-tap emergency call button on the homepage for urgent help (especially useful on mobile).

- 🌐 **Multi-Language Support (Partial Translation)**  
  Includes a basic translation toggle using JSON and JavaScript to display UI content in multiple languages.

- 🔐 **Secure Login/Logout**  
  Session-based login for patients, doctors, and admins with authentication logic.

---

## 🧩 Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Server:** Apache (via XAMPP)
- **Extras:** SMS OTP (simulated), geolocation, JSON-based translation, emergency call buttons

---

## ⚙️ How to Run This Locally

1. Install **XAMPP** or any local server stack
2. Start Apache and MySQL using the XAMPP Control Panel
3. Move the project folder `HACKATHON 2k25` into your `htdocs` directory
4. Open `phpMyAdmin` in your browser and:
   - Create a new database named `appointment_db`
   - Import the SQL structure from the file `Database.txt` (rename to `.sql` if needed)
5. Run the project by visiting:
   http://localhost/HACKATHON%202k25/

---

## 🧪 Demo Credentials

You can use these built-in accounts for testing:

- **Admin:** `admin@site.com` / `123`
- **Doctor:** `doctor@site.com` / `123`
- **Patient:** `patient@site.com` / `123`

---

## 📁 Project Structure (Highlights)

| Folder/File                  | Description                          |
|------------------------------|--------------------------------------|
| `/admin/`                    | Admin dashboard & session control    |
| `/doctor/`                   | Doctor-specific functionality        |
| `/patient/`                  | Patient pages and booking logic      |
| `index.html`                 | Homepage (includes emergency call & hospital finder) |
| `translate.js` / `.json`     | Translation logic and strings        |
| `login.php`, `logout.php`    | Login/logout logic                   |
| `faq.html`, `feedback.php`   | Support and help sections            |
| `Database.txt`               | SQL dump file for DB setup           |

---

## ⚠️ Disclaimer

This is a student-level hackathon project built for learning purposes. Some modules like OTP, hospital API, and i18n may use basic or simulated functionality.
