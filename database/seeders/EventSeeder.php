<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;


class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'name' => 'Conferencia Laravel',
            'description' => 'Evento sobre desarrollo web con Laravel',
            'date' => '2025-06-15 10:00:00',
            'location' => 'Ciudad de México',
            'capacity' => 100
        ]);

        Event::create([
            'name' => 'Meetup de PHP',
            'description' => 'Encuentro de desarrolladores PHP',
            'date' => '2025-07-10 18:00:00',
            'location' => 'Bogotá',
            'capacity' => 50
        ]);
    }
}
