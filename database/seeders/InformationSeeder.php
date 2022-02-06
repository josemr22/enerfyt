<?php

namespace Database\Seeders;

use App\Models\Information;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Information::create([
            'about'=>'<p>Realizamos evaluaciones fisioterapéuticas para poder brindarle a nuestros pacientes tratamiento específico según sus necesidades.</p>
            <p>Nuestro servicio es personalizado, conocemos a cada uno de nuestros usuarios y nos encargamos de mejorar su salud física y emocional; queremos que puedan rendir de manera óptima en todas sus actividades.</p>
            <p>Contamos con el mejor equipo profesional de fisioterapeutas y médicos especialistas quienes usan tecnología de vanguardia y programas especializados para garantizar excelentes resultados.</p>',
            'mision'=>'Ofrecer un servicio eficiente, profesional y especializado que permita la mejora continua de nuestros pacientes.',
            'vision'=>'Ser una empresa líder en fisioterapia a nivel nacional, reconocidos por nuestros tratamientos de calidad.',
            'about_image'=>'about-01.jpg',
        ]);
    }
}
