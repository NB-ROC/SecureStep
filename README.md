# Secure Step

**The only step to walk home secure**

Secure Step is een veiligheidsapplicatie die gebruikers ondersteunt bij het veilig naar huis lopen of reizen. De applicatie biedt functionaliteiten zoals accountregistratie, vriendenbeheer en (conceptueel) live locatie delen, met als doel het veiligheidsgevoel van gebruikers te vergroten.

Dit project is ontwikkeld als schoolproject binnen **Project LJ3**.

---

## Doel van het project

Het doel van dit project is het ontwikkelen van een **Progressive Web App (PWA)** waarin moderne webtechnologieën worden toegepast.
De focus ligt op:

* een duidelijke scheiding tussen backend en frontend
* een overzichtelijke en overdraagbare projectstructuur
* het bouwen van een functionele MVP (Minimum Viable Product)

---

## Functionaliteiten

### Geïmplementeerd

* Registreren en inloggen van gebruikers
* Basis gebruikersbeheer
* Backendstructuur volgens MVC-architectuur
* Frontend setup met moderne styling
* Database migraties

### Gedeeltelijk / niet afgerond

* Realtime locatie delen
* Notificatiesysteem
* Paniekknop zonder externe koppelingen (zoals 112)
* Veilige routeplanning (conceptueel aanwezig)

---

## Tech Stack

### Backend

* PHP 8.x
* Laravel
* Laravel MVC-architectuur

### Frontend

* JavaScript
* Tailwind CSS
* Node.js & npm

### Database

* SQLite (alleen gebruikt voor lokale ontwikkeling)

### Testing

* PHPUnit (basisconfiguratie aanwezig)
* Handmatige tests tijdens development

---

## Projectstructuur

SecureStep/

├── app/                # Backend applicatielogica (controllers, models)
├── routes/             # Web- en API-routes
├── resources/          # Frontend assets (CSS, JS, views)
├── database/           # Migrations en SQLite database
├── public/             # Publieke bestanden
├── tests/              # PHPUnit tests
├── package.json        # Frontend dependencies
├── composer.json       # Backend dependencies
└── README.md           # Projectdocumentatie

---

## Installatie

### Vereisten

* PHP 8.x
* Composer
* Node.js & npm
* Laravel CLI

### Installatiestappen

1. Clone de repository

   ```bash
   git clone <repository-url>
   cd SecureStep
   ```

2. Installeer backend dependencies

   ```bash
   composer install
   ```

3. Installeer frontend dependencies

   ```bash
   npm install
   ```

4. Omgevingsvariabelen instellen

   ```bash
   cp .env.example .env
   ```

5. Applicatiesleutel genereren

   ```bash
   php artisan key:generate
   ```

6. Database migreren

   ```bash
   php artisan migrate
   ```

7. Applicatie starten

   ```bash
   php artisan serve
   ```

De applicatie draait standaard op:
`http://localhost:8000`

---

## Database

* Standaard wordt **SQLite** gebruikt
* Database is bedoeld voor **development en testdoeleinden**
* Niet geschikt voor productiegebruik

Voor productie wordt migratie naar **MySQL of PostgreSQL** aanbevolen.

---

## Projectstatus

✔ Basis backendstructuur
✔ Frontend build setup
✔ Authenticatie

❌ Realtime functionaliteit
❌ Productieomgeving
❌ Volledige testdekking

---

## Bekende beperkingen

* Geen realtime WebSocket-implementatie
* Geen externe notificatieservice
* Beveiliging en schaalbaarheid zijn niet getest
* Applicatie is niet productie-klaar

---

## Documentatie

* Overdrachtsdocument (aanwezig in repository)
* Projectplan
* Ontwerpen en wireframes (beschikbaar via Teams)
* Database migraties

---

## Projectinformatie

**Project:** Project LJ3
**Type:** Schoolproject / MVP
**Begeleider:** Docent Niek

---

## Disclaimer

Dit project is ontwikkeld voor educatieve doeleinden en is niet bedoeld voor direct gebruik in een productieomgeving.
