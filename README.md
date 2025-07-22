# Churchtool Connect

**Churchtool Connect** ist ein WordPress-Plugin zur Integration von ChurchTools mit dem Modern Events Calendar. Es ermöglicht die Authentifizierung über die ChurchTools API und synchronisiert Benutzerdaten mit der WordPress-Installation.

---

## ✨ Features

- Verbindung zur ChurchTools API (Login, Benutzerabfrage)
- Speicherung von Benutzerdaten in WordPress
- Admin-Oberfläche zur Konfiguration von API-Zugangsdaten
- Anzeige gespeicherter Daten im Backend
- Bootstrap-basiertes UI für Admin-Bereich
- Unterstützung für Aktivierungs- und Deaktivierungsroutinen

---

## 🛠️ Installation

1. Plugin-Verzeichnis in `wp-content/plugins/churchtool-connect` kopieren
2. Sicherstellen, dass `vendor/autoload.php` vorhanden ist (Composer-Abhängigkeiten)
3. Plugin im WordPress-Backend aktivieren

---

## ⚙️ Konfiguration

1. Navigiere zu **Churchtool Connect** im WordPress-Admin-Menü
2. Trage die API-URL, Benutzername und Passwort deiner ChurchTools-Instanz ein
3. Speichere die Einstellungen
4. Nach erfolgreichem Login werden Benutzerdaten automatisch geladen

---

## 📁 Verzeichnisstruktur

churchtool-connect/
├── churchtool-connect.php
├── README.md
├── includes/
│   ├── Churchtool_Connect_Activate.php
│   ├── Churchtool_Connect_API.php
│   ├── Churchtool_Connect_Assets.php
│   ├── Churchtool_Connect_Calendar.php
│   ├── Churchtool_Connect_Config.php
│   ├── Churchtool_Connect_Constants.php
│   ├── Churchtool_Connect_Cron.php
│   ├── Churchtool_Connect_Deactivate.php
│   ├── Churchtool_Connect_Debug.php
│   └── Churchtool_Connect_Initializer.php
├── templates/
│   ├── calendar-overview.php
│   ├── config-page.php
│   └── debug-page.php
├── assets/
│   ├── css/
│   │   └── churchtool-connect.css
│   └── js/
│       └── churchtool-connect.js

## 📜 Lizenz

GPL-2.0-or-later  
https://www.gnu.org/licenses/gpl-2.0.html

---

## 👤 Autor

**Kai Naumann**  
plugin@feg-aschaffenburg.de  
https://plugin.feg-aschaffenburg.de
