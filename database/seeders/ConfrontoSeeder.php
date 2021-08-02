<?php

namespace Database\Seeders;

use App\Models\Confronto;
use Illuminate\Database\Seeder;

class ConfrontoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Confronto::factory()->count(40)->create();
    }
}
