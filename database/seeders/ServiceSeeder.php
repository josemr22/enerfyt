<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Service::create([
            'title'  =>'Rehabilitación Deportiva',
            'content'=>'<p>Lesiones musculares.</p>
            <p>Esguince de grado I,II,III.</p>
            <p>Lesiones Meniscales.</p>
            <p>Tendinopatias.</p>
            <p>Bursitis.</p>',
            'image'  =>'serv-1.jpg',
        ]);
        Service::create([
            'title'  =>'Afecciones de  la columna vertebral',
            'content'=>'<p>Hernia discal.</p>
            <p>Escoliosis.</p>
            <p>Cifosis.</p>',
            'image'  =>'serv-3.jpg',
        ]);
        Service::create([
            'title'  =>'Lesiones traumatológicas',
            'content'=>'<p>Luxaciones.</p>
            <p>Post fractura.</p>
            <p>Fractura.</p>
            <p>Fisuras.</p>
            <p>Tratamientos post – quirúrgicos.</p>',
            'image'  =>'serv-2.jpg',
        ]);
        Service::create([
            'title'  =>'Rehabilitación en reumatología',
            'content'=>'<p>Artrosis.</p><p>Artritis.</p><p>Osteoporosis.</p><p>Fibromialgia.</p>',
            'image'  =>'serv-4.jpg',
        ]);
        Service::create([
            'title'  =>'Agentes electrofísicos',
            'content'=>'<p>Microelectrolisis Percutánea.</p><p>Magnetoterapia.</p><p>Electroestimulación.</p><p>Ultrasonido terapéutico.</p><p>Termoterapia.</p>',
            'image'  =>'serv-7.jpg',
        ]);
        Service::create([
            'title'  =>'Rehabilitación neurológica',
            'content'=>'<p>Parálisis facial y branquial.</p>
            <p>Enfermedades cerebro vasculares.</p>
            <p>Cefaleas tensionales.</p>',
            'image'  =>'serv-5.jpg',
        ]);
        Service::create([
            'title'  =>'Técnicas y métodos de tratamiento',
            'content'=>'<p>Punción seca.</p>
            <p>Terapia manual.</p>
            <p>Ejercicios terapéuticos.</p>
            <p>Masoterapia.</p>
            <p>Entrenamiento funcional.</p>',
            'image'  =>'serv-6.jpg',
        ]);
    }
}
