<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Partit;
use App\Mail\JornadaMail;

class EnviarJornadaManagers extends Command
{
    // Faltaba el $ aquí
    protected $signature = 'jornada:enviar';

    // Faltaba el $ aquí
    protected $description = 'Envia la jornada actual als managers';

    public function handle()
    {
        // Asegúrate de que todas estas variables también tengan el $
        $partit = Partit::whereDate('data', '>', Carbon::now())
            ->orderBy('data', 'asc')
            ->first();

        if (!$partit) {
            $this->info('No hi ha partits programats en el futur.');
            return;
        }

        $partits = Partit::with(['equipLocal', 'equipVisitant'])
            ->where('jornada', $partit->jornada)
            ->get();

        $managers = User::where('role', 'manager')->get();

        if ($managers->isEmpty()) {
            $this->info('No s\'han trobat managers.');
            return;
        }

        foreach ($managers as $manager) {
            Mail::to($manager->email)->send(new JornadaMail($partits));
            $this->info('Correu enviat a: ' . $manager->name);
        }

        $this->info('Procés finalitzat.');
    }
}