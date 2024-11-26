<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Membre;
use Carbon\Carbon;

class UpdateMoisPayer extends Command
{
    protected $signature = 'membres:update-mois-payer';
    protected $description = 'Définir mois_payer à false si un mois s\'est écoulé depuis la dernière modification ou inscription';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $membres = Membre::where('mois_payer', true)->get();

        foreach ($membres as $membre) {
            $lastUpdate = Carbon::parse($membre->updated_at);
            $oneMonthAgo = Carbon::now()->subMonth();

            if ($lastUpdate->lessThanOrEqualTo($oneMonthAgo)) {
                $membre->mois_payer = false;
                $membre->save();
            }
        }

        $this->info('Statut mois_payer mis à jour avec succès.');
    }
}
