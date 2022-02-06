<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Destination::factory()->create([
        //     'name'=>'Amazonas',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Ancash',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Apurimac',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Arequipa',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Ayacucho',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Cajamarca',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Callao',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Cusco',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Huancavelica',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Huanuco',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Ica',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Junin',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'La Libertad',
        // ]);
        Destination::factory()->create([
            'name'=>'Chiclayo',
            'tariff' => 5.0,
        ]);
        // Destination::factory()->create([
        //     'name'=>'Lima',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Loreto',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Madre De Dios',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Moquegua',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Pasco',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Piura',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Puno',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'San Martin',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Tacna',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Tumbes',
        // ]);
        // Destination::factory()->create([
        //     'name'=>'Ucayali',
        // ]);
    }
}
