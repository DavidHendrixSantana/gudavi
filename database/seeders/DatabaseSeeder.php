<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clase;
use App\Models\Day;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $dias = [
            ['Dia' => 'Lunes'],
            ['Dia' =>'Martes'],
            ['Dia' =>'Miercoles'],
            ['Dia' => 'Jueves'],
            ['Dia' => 'Viernes'],
            ['Dia' => 'Sabado'],
        ];

    $clases  = [

        [  'Clase' => '09:00',],
        [  'Clase' => '09:30',],
        [  'Clase' => '10:00',],
        [  'Clase' => '10:30',],
        [  'Clase' => '11:00',],
        [  'Clase' => '11:30',],
        [  'Clase' => '12:00',],
        [  'Clase' => '12:30',],
        [  'Clase' => '13:00',],
        [  'Clase' => '13:30',],
        [  'Clase' => '14:00',],
        [  'Clase' => '14:30',],
        [  'Clase' => '15:00',],
        [  'Clase' => '15:30',],
        [  'Clase' => '16:00',],
        [  'Clase' => '16:30',],
        [  'Clase' => '17:00',],
        [  'Clase' => '17:30',],
        [  'Clase' => '18:00',],
        [  'Clase' => '18:30',],
        [  'Clase' => '19:00',],
        [  'Clase' => '19:30',],
        [  'Clase' => '20:00',],
      
    ];

        Clase::insert($clases);
        Day::insert($dias);

    }
}