# 💊 Medicine Suggestor

**Medicine Suggestor** is a web-based healthcare assistance system that provides **medicine recommendations based on user symptoms**. Built using **HTML, CSS, JavaScript, PHP, SQL, and an XMPP server**, the platform also offers **medicine details, health tips, nearby doctor discovery with maps, and real-time doctor–patient communication**.

---

## ✨ Key Highlights

* 🧠 Smart symptom-based medicine suggestions
* 💊 Detailed medicine descriptions & usage info
* 🧘 Daily health & wellness tips
* 🗺️ Interactive map to locate nearby doctors
* 📞 Direct contact details of registered doctors
* 📝 Feedback system integrated with database
* 🔄 Real-time chat with doctors via **XMPP server**

---

## 🛠️ Technology Stack

| Technology                     | Purpose                                     |
| ------------------------------ | ------------------------------------------- |
| **HTML, CSS, JavaScript**      | Front-end structure, design & interactivity |
| **PHP**                        | Server-side logic & request handling        |
| **MySQL / SQL**                | Database for medicines, doctors & feedback  |
| **XMPP Server**                | Real-time doctor–patient communication      |
| **Google Maps API (Optional)** | Display nearby doctors on map               |

---

## 🔄 System Workflow

1. **Symptom Input**
   User enters symptoms through a web form.

2. **Medicine Recommendation**
   Backend processes symptoms and fetches relevant medicines from the database.

3. **Information Display**
   Medicine details, health tips, and doctor suggestions are shown.

4. **Doctor Locator**
   Nearby doctors are displayed using map integration.

5. **Communication & Feedback**
   Users can contact doctors in real time and submit feedback stored in the database.

---

## 🧑‍⚕️ Sample Doctor Directory

* **Dr. John Smith** — General Physician
  📧 [johnsmith@example.com](mailto:johnsmith@example.com)

* **Dr. Aisha Khan** — Dermatologist
  📧 [aishakhan@example.com](mailto:aishakhan@example.com)

* **Dr. Ravi Patel** — Cardiologist
  📧 [ravipatel@example.com](mailto:ravipatel@example.com)

---

## 📝 Feedback Module

Users can submit feedback regarding their experience.
All feedback is **securely stored in the SQL database** for analysis and system improvement.

---

## 🚀 Getting Started

### 🔧 Prerequisites

* PHP-enabled server (**XAMPP / LAMP / WAMP**)
* MySQL Database
* XMPP Server (**Openfire / ejabberd**)
* (Optional) Google Maps API Key

---

### 📥 Installation Steps

1. **Clone the repository**

   ```bash
   git clone https://github.com/yourusername/medicine-suggestor.git
   ```

2. **Set up local server**
   Start Apache & MySQL using XAMPP or similar.

3. **Import Database**
   Import `medicine_db.sql` into MySQL.

4. **Configure Backend**

   * Update database credentials in `config.php`
   * Configure XMPP server details

5. **Run the Application**

   * Open `index.html` via local server
   * OR deploy on hosting platform

---

## 📁 Project Structure

```
medicine-suggestor/
│
├── css/
│   └── styles.css
├── js/
│   └── main.js
├── php/
│   ├── suggest.php
│   ├── feedback.php
│   └── config.php
├── index.html
├── doctor-contacts.html
├── map.html
├── README.md
└── sql/
    └── medicine_db.sql
```

---

## 🤝 Contributing

Contributions are welcome!
Feel free to **fork the repository** and submit a pull request to improve features, UI, or performance.

---

## 📧 Contact

For queries or support, reach out to:
**Tushar Kumar Sharma**
📩 **[tasharkumarsharma@gmail.com](mailto:tasharkumarsharma@gmail.com)** *(update if needed)*

---

## 📜 License

This project is licensed under the **MIT License**.
