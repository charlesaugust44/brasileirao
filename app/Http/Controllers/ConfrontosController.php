<?php

namespace App\Http\Controllers;

use App\Models\Confronto;
use App\Models\Time;
use App\Services\ConfrontoService;
use Illuminate\Http\Request;

class ConfrontosController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'gols_casa'      => 'required|integer|min:0',
            'gols_visitante' => 'required|integer|min:0',
            'time_casa'      => 'required|different:time_visitante_id',
            'time_visitante' => 'required|different:time_casa_id',
        ]);

        $confronto        = new Confronto();
        $confrontoService = new ConfrontoService();

        $confronto->gols_casa      = $request->gols_casa;
        $confronto->gols_visitante = $request->gols_visitante;
        $confronto->save();

        $confronto->times()->attach($request->time_casa, ['casa' => true]);
        $confronto->times()->attach($request->time_visitante, ['casa' => false]);

        $casa      = Time::find($request->time_casa);
        $visitante = Time::find($request->time_visitante);

        $calculado = $confrontoService->calcularPontuacao($casa, $visitante, $confronto->gols_casa, $confronto->gols_visitante);

        $calculado->casa->save();
        $calculado->visitante->save();

        return response(null, 201);
    }
}
