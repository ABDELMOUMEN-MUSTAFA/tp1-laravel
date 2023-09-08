<?php

namespace Database\Seeders;

use App\Models\Chambre;
use Illuminate\Database\Seeder;

class ChambreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chambre::create([
            'type_id' => 1,
            'description' => "Mouse, do you know what to uglify is, you ARE a simpleton.' Alice did not quite like the look of the officers: but the tops of the hall; but, alas! the little door: but, alas! either the locks were.",
            'superficie' => 100,
            'etage' => 1,
            'prix' => 200,
        ]);
    }
}
