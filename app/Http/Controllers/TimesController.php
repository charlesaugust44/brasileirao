<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Database\Eloquent\Collection;

class TimesController extends Controller
{
    public function classificados()
    {
        /** @var Collection $times */
        $times = Time::orderBy('pontos', 'desc')
                     ->with('confrontos.time_casa', 'confrontos.time_visitante')
                     ->get();

        $times->append([
            'vitorias',
            'empates',
            'derrotas',
            'gols_pro',
            'gols_contra',
            'saldo_gols',
        ]);

        $times->sortByDesc('pontos')
              ->sortByDesc('vitorias')
              ->sortByDesc('saldo_gols')
              ->sortByDesc('gols_pro');

        return response()->json($times);
    }
}
