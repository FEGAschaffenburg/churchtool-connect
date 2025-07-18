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

- `churchtool-connect.php` – Hauptladepunkt des Plugins
- `Churchtool_Connect_Initializer.php` – Initialisierung und Hook-Registrierung
- `Churchtool_Connect_Activate.php` / `Deactivate.php` – Aktivierungs-/Deaktivierungslogik
- `Churchtool_Connect_Admin.php` – Admin-Menü und Einstellungen
- `Churchtool_Connect_API.php` – API-Kommunikation (Login, Benutzerdaten)
- `Churchtool_Connect_Assets.php` – CSS/JS-Integration (Bootstrap, Custom)
- `admin-page.php` / `database-page.php` – HTML-Templates für Admin-UI

---

## 📜 Lizenz

GPL-2.0-or-later  
https://www.gnu.org/licenses/gpl-2.0.html

---

## 👤 Autor

**Kai Naumann**  
plugin@feg-aschaffenburg.de  
https://plugin.feg-aschaffenburg.de
