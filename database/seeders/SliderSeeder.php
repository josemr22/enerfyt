<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Slider::create([
            'header'=> 'Colección 2021',
            'title'=> 'Nuevos Ingresos',
            'image'=>'slide-01.jpg',
            'button_title'=> 'Ver más',
            'button_url'=> 'http://tatojet.com/',
        ]);
        Slider::create([
            'header'=> 'Colección 2021',
            'title'=> 'Nuevos Ingresos',
            'image'=>'slide-02.jpg',
            'button_title'=> 'Ver más',
            'button_url'=> 'http://tatojet.com/',
        ]);
        Slider::create([
            'header'=> 'Colección 2021',
            'title'=> 'Nuevos Ingresos',
            'image'=>'slide-03.jpg',
            'button_title'=> 'Ver más',
            'button_url'=> 'http://tatojet.com/',
        ]);
    }
}
