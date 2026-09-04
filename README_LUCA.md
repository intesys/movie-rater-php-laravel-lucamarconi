# Movie-Rater

## Funzionalità
*   **CRUD:** Interfaccia completa per la creazione, visualizzazione, modifica ed eliminazione dei film.
*   **Ricerca:** Ricerca (backend) con filtri cumulativi. Permette di incrociare ricerche testuali (su titolo o regista) con filtri esatti (genere, anno).
*   **API Dati:** Esposizione della lista paginata dei film.
*   **Manutenzione Programmata:** Comando pulizia automatica per rimuovere i film obsoleti dal database.

## Architettura e Scelte Tecniche
*   **Design Pattern Service:** La business logic è stata estratta in una classe MovieService
*   **Query Scopes (Model):** L'astrazione delle interrogazioni al database è incapsulata nei Model tramite scope dedicati, rendendo le query riutilizzabili.
*   **API Resources:** Utilizzo di `MovieResource` per disaccoppiare la struttura dati del Model Eloquent dall'output JSON. Formatta nativamente attributi complessi (es. il `cast` convertito in array).
*   **Test:** Implementazione di alcuni Feature Test
*   **Task Scheduling:** Il comando di pulizia custom (`movies:delete`) è progettato per essere agganciato al Cron Job nativo di Laravel per l'esecuzione in background.

---

1. **Comando per eseguire migration e seeder**
   ```bash
    php artisan migrate --seed
    ```
2. **Comando per eseguire l'eliminazione dei film**
   ```bash
    # in DeleteOldMovies.php è documentato l'utilizzo del command via scheduler di Laravel
    
    # default 5 anni
    php artisan movies:delete
   
    # numero di anni parametrizzato
    php artisan movies:delete --years=10
   ```
   
## Versione Filament
* Url: http://localhost/admin 
* Email: admin@admin.it
* Password: admin