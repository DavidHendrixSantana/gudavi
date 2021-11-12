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
            ['Dia' => 'Domingo'],
        ];

    $clases  = [

        [  'Clase' => '09:00', 'valor' => '9.0'],
        [  'Clase' => '09:30','valor' => '9.5'],
        [  'Clase' => '10:00','valor' => '10.0'],
        [  'Clase' => '10:30','valor' => '10.5'],
        [  'Clase' => '11:00','valor' => '11.0'],
        [  'Clase' => '11:30','valor' => '11.5'],
        [  'Clase' => '12:00','valor' => '12.0'],
        [  'Clase' => '12:30','valor' => '12.5'],
        [  'Clase' => '13:00','valor' => '13.0'],
        [  'Clase' => '13:30','valor' => '13.5'],
        [  'Clase' => '14:00','valor' => '14.0'],
        [  'Clase' => '14:30','valor' => '14.5'],
        [  'Clase' => '15:00','valor' => '15.0'],
        [  'Clase' => '15:30','valor' => '15.5'],
        [  'Clase' => '16:00','valor' => '16.0'],
        [  'Clase' => '16:30','valor' => '16.5'],
        [  'Clase' => '17:00','valor' => '17.0'],
        [  'Clase' => '17:30','valor' => '17.5'],
        [  'Clase' => '18:00','valor' => '18.0'],
        [  'Clase' => '18:30','valor' => '18.5'],
        [  'Clase' => '19:00','valor' => '19.0'],
        [  'Clase' => '19:30','valor' => '19.5'],
        [  'Clase' => '20:00','valor' => '20.0'],
      
    ];

        Clase::insert($clases);
        Day::insert($dias);

    }
}