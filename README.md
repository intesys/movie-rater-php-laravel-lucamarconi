# Movie Rater

Scheletro di applicazione Laravel usato come traccia per una prova di selezione.

## Stack

- Laravel 12 (PHP 8.3)
- PostgreSQL 16
- Apache 2.4 come reverse proxy verso PHP-FPM
- Vite 5 + Node 22 per il front-end
- Pest 3 per i test
- Adminer + Mailpit come tooling di sviluppo

## Requisiti

- Docker + Docker Compose v2
- Su Windows: WSL 2 + una distribuzione Linux (es. Ubuntu 22.04 dal Microsoft Store)

## Setup iniziale

```bash
cp .env.example .env
echo "ENV=dev" > bin/.env

bin/start --build           # costruisce e avvia i container
bin/cli composer install
bin/cli php artisan key:generate
bin/cli php artisan migrate
bin/npm install
bin/npm run dev             # oppure `bin/npm run build` per la build di produzione
```

L'applicazione risponde su `http://localhost`.

## Servizi di sviluppo

| Servizio | URL / porta            |
|----------|------------------------|
| App      | http://localhost       |
| Adminer  | http://localhost:8081  |
| Mailpit  | http://localhost:8025  |
| Vite     | http://localhost:5173  |

Le credenziali del database sono in `.env`.

## Comandi utili (`bin/`)

- `bin/start` — avvia i container in background
- `bin/stop` — ferma i container
- `bin/down` — rimuove i container (aggiungi `-v` per rimuovere anche i volumi)
- `bin/status` — stato dei container
- `bin/bash` — entra nella shell del container `app` come utente `web`
- `bin/cli <cmd>` — esegue un comando nel container `app` (composer, artisan, phpunit, ...)
- `bin/root <cmd>` — esegue un comando come `root` nel container `app`
- `bin/npm <cmd>` — esegue npm nel container Node

## Test

```bash
bin/cli composer test        # esegue Pest via artisan test
```

## Consegna del codice

Committare e fare push direttamente su questo repository. Inserire nel commit message il numero del task che risolve.
Al termine del lavoro, informare via email la persona di riferimento di Intesys.

## Elementi considerati per la valutazione

- numero di task completati
- pulizia del codice
- performance
- ordine e gestione dei sorgenti
- tempo di svolgimento

## Note

Per rendere il processo di selezione equo per tutti, si prega di non condividere questo assignment o la soluzione proposta.
