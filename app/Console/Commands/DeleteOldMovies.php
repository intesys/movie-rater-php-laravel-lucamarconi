<?php

namespace App\Console\Commands;

use App\Models\Movie;
use Illuminate\Console\Command;

class DeleteOldMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Comando da eseguire da terminale: php artisan movies:delete --years=5
     * Il comando è stato registrato anche in routes/console.php con una schedulazione giornaliera.
     * Sarà necessario configurare il Cron Job di base di Laravel sul server Linux.
     * `crontab -e` da terminale, va aggiunta questa singola riga
     * per eseguire lo scheduler ogni minuto:  * * * * cd /percorso/del/progetto && php artisan schedule:run >> /dev/null 2>&1
     * *
     * @var string
     */
    protected $signature = 'movies:delete {--years=5 : Numero di anni di anzianità}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina i film con anno di uscita più vecchio rispetto alla soglia indicata';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $years = (int) $this->option('years');
        $deletedCount = Movie::olderThan($years)->delete();

        if ($deletedCount > 0) {
            $this->info("Sono stati eliminati {$deletedCount} film, perchè più vecchi di {$years} anni.");
        } else {
            $this->info("Nessun film trovato più vecchio di {$years} anni.");
        }
    }
}
