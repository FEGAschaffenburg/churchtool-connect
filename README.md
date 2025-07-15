# 📦 ChurchTool Connect

Ein WordPress-Plugin zur Integration von ChurchTools-Daten in WordPress-Webseiten – ideal für Gemeinden, die ihre Veranstaltungen, Gruppen oder Benutzerinformationen direkt auf ihrer Website anzeigen möchten.

---

## 🔍 Projektübersicht

- **Name:** ChurchTool Connect  
- **Version:** 1.0.0  
- **Autor:** Kai Naumann  
- **Lizenz:** GPL-2.0-or-later  
- **Repository:** https://github.com/FEGAschaffenburg/churchtool-connect  
- **Plugin URI:** https://plugin.feg-aschaffenburg.de  
- **Autor URI:** mailto:plugin@feg-aschaffenburg.de  

---

## 🚀 Funktionen

- Anzeige von ChurchTools-Inhalten (Veranstaltungen, Gruppen, Benutzer) via Shortcodes  
- REST-API-Anbindung an ChurchTools  
- Synchronisation mit dem Plugin *Modern Events Calendar*  
- Einbindung von CSS/JS im WordPress-Adminbereich  
- Aktivierungs- und Deaktivierungsroutinen  

---

## 🛠️ Installation

1. Repository klonen oder ZIP-Datei herunterladen  
2. In das WordPress-Plugin-Verzeichnis hochladen  
3. Plugin im WordPress-Backend aktivieren  

---

## ⚙️ Technische Struktur

churchtool-connect/ 
├── assets/ 
│ ├── css/ 
│ │ └── churchtool-connect.css
│ ├── js/
│ │ └── churchtool-connect.js
├── includes/
│ ├── class-churchtool-connect.php
│ ├── class-churchtool-connect-activate.php 
│ ├── class-churchtool-connect-deactivate.php 
│ ├── class-churchtool-connect-assets.php 
│ ├── class-churchtool-connect-admin.php 
│ └── class-churchtool-connect-constants.php 
├── templates/ 
├── vendor/ 
├── churchtool-connect.php 
├── composer.json 
├── composer.lock 
├── README.md 
├── LICENSE 
└── .gitignore