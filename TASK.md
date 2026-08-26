## Task

Si richiede quindi di implementare le seguenti funzionalità:

1. Implementare il modello di dati tramite Eloquent per la gestione di una lista di film che contenga<br>
   a. Titolo del film<br>
   b. Anno di uscita<br>
   c. Regista<br>
   d. Cast<br>
   e. Genere<br>
   e. Trama<br>
2. Implementare un seeder per popolare il database.
3. Implementare le operazioni CRUD (Creazione, Lettura, Update e Cancellazione) dell'entità movie per fare in modo che
   possano essere utilizzate all'interno dell'interfaccia di gestione.
4. Implementare le viste tramite template blade per<br>
   a. Mostrare la lista di tutti i film inseriti a database<br>
   b. Mostrare il dettaglio del film<br>
5. Creare un'API REST (`/api/movies`) che ritorni la lista di tutti i film in formato JSON. Per ogni film ritornare il
   titolo, i registi,il cast, l'anno di uscita, il genere e la trama. La lista deve essere ordinata mostrando i film in
   ordine alfabetico dalla A alla Z.
6. Implementare un comando che cancella i film più vecchi di 5 anni
7. Implementare dei TEST a tua scelta
8. Se desideri fare una seconda versione di questo progetto con FilamentPHP