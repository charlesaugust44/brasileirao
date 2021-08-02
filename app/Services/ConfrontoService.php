<?php

namespace App\Services;

use App\Models\Time;

class ConfrontoService
{
    /**
     * @param Time $casa
     * @param Time $visitante
     * @param int $golsCasa
     * @param int $golsVisitante
     * @return object
     */
    public function calcularPontuacao(Time $casa, Time $visitante, int $golsCasa, int $golsVisitante)
    {
        if ($golsCasa === $golsVisitante) {
            $visitante->pontos += 1;
            $casa->pontos      += 1;
        } else if ($golsCasa > $golsVisitante) {
            $casa->pontos += 3;
        } else {
            $visitante->pontos += 3;
        }

        return (object)[
            "casa"      => $casa,
            "visitante" => $visitante
        ];
    }
}
