<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;


class BarCodeController extends Controller
{
    public function index($id)
    {
        $person =  Person::find($id);
        return view('pdf.credencial', compact('person'));
    }

    public function printAll(){
        $persons = Person::where('estatus', null)->get();
       
            return view('pdf.credenciales', compact('persons'));
    
    }


    public function credencialT($id)
    {
        $person =  Teacher::find($id);
        return view('pdf.credencial', compact('person'));
    }
    public function credencialTeachersAlumnos($id)
    {
        $persons =   DB::select("SELECT DISTINCT persons.matricula, persons.nombre FROM persons
        INNER JOIN days_classes on days_classes.person_id = persons.id
        INNER JOIN days_teachers on days_classes.day_teacher_id = days_teachers.id 
        INNER join teachers on days_teachers.teacher_id = ?
        where persons.matricula != ''", [$id]);
        $persons = $persons;
        // return var_dump($persons[0]->matricula);
        return view('pdf.credencialesTeachers', compact('persons'));
        
    }



}
