<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Partit;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArbitreAssignacions;
use Carbon\Carbon;

class EnviarAssignacionsArbitres extends Command
{
    /**
     * El nom i la firma de la comanda.
     * Això és el que escriuràs a la terminal: php artisan arbitres:notificar
     */
    protected $signature = 'arbitres:notificar';

    /**
     * Descripció de la comanda.
     */
    protected $description = 'Envia un correu als àrbitres amb els seus pròxims partits assignats';

    /**
     * Execució de la comanda.
     */
    public function handle()
    {
        // 1. Busquem tots els usuaris que són àrbitres
        $arbitres = User::where('role', 'arbitre')->get();

        if ($arbitres->isEmpty()) {
            $this->info('No s\'han trobat àrbitres a la base de dades.');
            return;
        }

        $this->info("Iniciant l'enviament a " . $arbitres->count() . " àrbitres...");

        foreach ($arbitres as $arbitre) {
            // 2. Busquem els partits FUTUROS assignats a aquest àrbitre
            // Utilitzem la relació 'arbitre_id' que vam crear a la migració
            $partits = Partit::where('arbitre_id', $arbitre->id)
                ->where('data', '>=', Carbon::now()) // Només partits que encara no s'han jugat
                ->orderBy('data', 'asc')
                ->with(['equipLocal', 'equipVisitant', 'estadi']) // Optimització (Eager Loading)
                ->get();

            // 3. Si té partits assignats, enviem el correu
            if ($partits->count() > 0) {
                try {
                    Mail::to($arbitre->email)->send(new ArbitreAssignacions($arbitre, $partits));
                    $this->info("✅ Correu enviat a: {$arbitre->name} ({$partits->count()} partits)");
                } catch (\Exception $e) {
                    $this->error("❌ Error enviant a {$arbitre->name}: " . $e->getMessage());
                }
            } else {
                $this->comment("ℹ️ L'àrbitre {$arbitre->name} no té partits futurs assignats.");
            }
        }

        $this->newLine();
        $this->info('🚀 Procés finalitzat.');
    }
}