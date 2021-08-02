<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confronto extends Model
{
    use HasFactory;

    public function times()
    {
        return $this->belongsToMany(Time::class, 'confronto_time')
                    ->select(['id', 'nome', 'brasao']);
    }

    public function time_casa()
    {
        return $this->belongsToMany(Time::class, 'confronto_time')
                    ->wherePivot('casa', true)
                    ->select(['id', 'nome', 'brasao']);
    }

    public function time_visitante()
    {
        return $this->belongsToMany(Time::class, 'confronto_time')
                    ->wherePivot('casa', false)
                    ->select(['id', 'nome', 'brasao']);
    }
}
