<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Time extends Model
{
    use HasFactory;

    public function confrontos()
    {
        return $this->belongsToMany(Confronto::class, 'confronto_time')
                    ->select(['id','gols_casa','gols_visitante','created_at']);
    }

    public function getVitoriasAttribute(): int
    {

        return DB::table('confrontos')
                 ->join('confronto_time', 'confrontos.id', '=', 'confronto_time.confronto_id')
                 ->where('confronto_time.time_id', '=', $this->id)
                 ->whereRaw('(
			                        (confronto_time.casa = 1 and gols_casa > gols_visitante)
		                         or (confronto_time.casa = 0 and gols_visitante > gols_casa))')
                 ->select('confrontos.id')
                 ->get()
                 ->count();

    }

    public function getEmpatesAttribute(): int
    {
        return DB::table('confrontos')
                 ->join('confronto_time', 'confrontos.id', '=', 'confronto_time.confronto_id')
                 ->where('confronto_time.time_id', '=', $this->id)
                 ->whereRaw('gols_casa = gols_visitante')
                 ->select('confrontos.id')
                 ->get()
                 ->count();
    }

    public function getDerrotasAttribute(): int
    {

        return DB::table('confrontos')
                 ->join('confronto_time', 'confrontos.id', '=', 'confronto_time.confronto_id')
                 ->where('confronto_time.time_id', '=', $this->id)
                 ->whereRaw('(
			                        (confronto_time.casa = 1 and gols_casa < gols_visitante)
		                         or (confronto_time.casa = 0 and gols_visitante < gols_casa))')
                 ->select('confrontos.id')
                 ->get()
                 ->count();

    }

    public function getGolsProAttribute(): int
    {
        $gols = DB::table('confrontos')
                 ->join('confronto_time', 'confrontos.id', '=', 'confronto_time.confronto_id')
                 ->where('confronto_time.time_id', '=', $this->id)
                 ->selectRaw('sum(case when confronto_time.casa = 1 then gols_casa else gols_visitante end) as gols_pro')
                 ->get()
                 ->first();

        if($gols->gols_pro)
            return $gols->gols_pro;

        return 0;
    }

    public function getGolsContraAttribute(): int
    {
        $gols = DB::table('confrontos')
                  ->join('confronto_time', 'confrontos.id', '=', 'confronto_time.confronto_id')
                  ->where('confronto_time.time_id', '=', $this->id)
                  ->selectRaw('sum(case when confronto_time.casa = 0 then gols_casa else gols_visitante end) as gols_contra')
                  ->get()
                  ->first();

        if($gols->gols_contra)
            return $gols->gols_contra;

        return 0;
    }

    public function getSaldoGolsAttribute(): int
    {
        $gols = DB::table('confrontos')
                  ->join('confronto_time', 'confrontos.id', '=', 'confronto_time.confronto_id')
                  ->where('confronto_time.time_id', '=', $this->id)
                  ->selectRaw('sum(case when confronto_time.casa = 1 then gols_casa - gols_visitante else gols_visitante - gols_casa end) as saldo')
                  ->get()
                  ->first();

        if($gols->saldo)
            return $gols->saldo;

        return 0;
    }
}
