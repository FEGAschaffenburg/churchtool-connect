## Beschreibung
Dieses Plugin importiert Events aus ChurchTools und integriert sie in den Modern Events Calendar (MEC).

## Features
- Synchronisation von Events aus ChurchTools mit MEC.
- Unterstützung für benutzerdefinierte Cron-Jobs.
- Einfache Konfiguration und Anpassung.

## Voraussetzungen
- **WordPress**: Version 5.8 oder höher.
- **PHP**: Version 8 oder höher.
- **Modern Events Calendar Lite**: Muss installiert und aktiviert sein.

## Installation
1. Lade das Plugin-Verzeichnis in den Ordner `/wp-content/plugins/`.
2. Aktiviere das Plugin im WordPress-Adminbereich unter `Plugins`.
3. Navigiere zu **ChurchTools Event Importer for MEC** im Admin-Menü, um Einstellungen vorzunehmen.

## Verzeichnisse
- **assets/**: Enthält statische Ressourcen wie CSS und JS.
- **includes/**: Hauptlogik des Plugins.
- **templates/**: HTML-Templates für Admin-Seiten.

## Konfiguration
- Gehe zu **Einstellungen** → **ChurchTools Event Importer** im WordPress-Dashboard.
- Gib die API-Zugangsdaten für ChurchTools ein.
- Wähle die Kalender aus, die synchronisiert werden sollen.

## Composer-Abhängigkeiten
- `5pm-hdh/churchtools-api`
- `yahnis-elsts/plugin-update-checker`


## Autor
**Kai Naumann**

## Lizenz
Dieses Plugin steht unter der GPL-2.0-Lizenz. Weitere Informationen findest du in der Datei `LICENSE`.
