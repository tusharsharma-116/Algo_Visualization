# 💊 Medicine Suggestor

**Medicine Suggestor** is a web-based application that helps users receive medical suggestions based on their symptoms. Built using **HTML, CSS, JavaScript, PHP, SQL**, and **XMPP server**, the system not only recommends medicines but also provides detailed information about medications, general health tips, and doctors near the user, along with an interactive map. Users can also contact doctors directly and leave feedback through a form connected to the database.

---

## 🧠 Features

- ✅ Symptom-based medicine suggestions
- 💊 Detailed information about suggested medicines
- 🧘 Health tips for better well-being
- 🗺️ Map view of nearby doctors
- 📞 Contact information for registered doctors
- 📝 Feedback form integrated with the database
- 🔄 Real-time communication with doctors using XMPP server

---

## 🛠️ Tech Stack

| Technology | Description |
|------------|-------------|
| **HTML/CSS/JavaScript** | Front-end structure, styling, and interactivity |
| **PHP** | Backend scripting and server-side logic |
| **SQL** | Database for storing user feedback and doctor info |
| **XMPP** | Real-time messaging and doctor-patient communication |
| **Google Maps API (optional)** | For displaying doctors near the user on a map |

---

## 📌 How It Works

1. **User Input**: User enters symptoms into a form.
2. **Medicine Suggestion**: Backend processes input and suggests medicine.
3. **Info Display**: Details about medicine, health tips, and doctors are displayed.
4. **Map Integration**: Nearby doctors are shown on a map using coordinates.
5. **Contact & Feedback**: Users can contact doctors and submit feedback, which is saved to the database.
6. **Live Messaging**: XMPP server enables real-time chat with available doctors.

---

## 🧑‍⚕️ Doctor Contacts (Sample)

- **Dr. John Smith** - General Physician - `johnsmith@example.com`
- **Dr. Aisha Khan** - Dermatologist - `aishakhan@example.com`
- **Dr. Ravi Patel** - Cardiologist - `ravipatel@example.com`

---

## 📬 Feedback Form

Users can fill out a feedback form with their experience and suggestions. This is securely stored in a SQL database for review and analysis.

---

## 🚀 Getting Started

### Prerequisites

- PHP-enabled server (e.g., XAMPP, LAMP, WAMP)
- MySQL database
- XMPP server (e.g., Openfire, ejabberd)
- Optional: Google Maps API key

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/medicine-suggestor.git
Set up your XAMPP or other local server.

Import the SQL file into your database (e.g., medicine_db.sql).

Configure database and XMPP server settings in config.php.

Open index.html in your browser or host it on your local server.

📁 Folder Structure
pgsql
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
📣 Contributing
Contributions are welcome! Feel free to fork the repository and submit a pull request.

📧 Contact
For questions or support, contact: tashikmiddha@gmail.com

📝 License
This project is licensed under the MIT License.
