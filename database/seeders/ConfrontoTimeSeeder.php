<?php

namespace Database\Seeders;

use App\Models\Confronto;
use App\Models\Time;
use App\Services\ConfrontoService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfrontoTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $confrontos = Confronto::all();
        $times      = Time::all();

        foreach ($confrontos as $confronto) {
            $casa      = $times->random();
            $visitante = Time::where('id', '<>', $casa->id)->get()->random();

            DB::table('confronto_time')->insert([
                'confronto_id' => $confronto->id,
                'time_id'      => $visitante->id,
                'casa'         => false,
            ]);

            DB::table('confronto_time')->insert([
                'confronto_id' => $confronto->id,
                'time_id'      => $casa->id,
                'casa'         => true,
            ]);

            $confrontoService = new ConfrontoService();

            $golsCasa      = $confronto->gols_casa;
            $golsVisitante = $confronto->gols_visitante;

            $calculado = $confrontoService->calcularPontuacao($casa, $visitante, $golsCasa, $golsVisitante);

            $calculado->casa->save();
            $calculado->visitante->save();
        }


    }
}
