<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Day_clase;
use App\Models\Days_teachers;
use Illuminate\Support\Facades\DB;


class PdfController extends Controller
{
    public function ReporterQuincenal(){

        try {
            $Classes_month=[];
            $Teachers=Teacher::all();

            foreach($Teachers as $teacher){
            $Consult = DB::select('select COUNT(days_classes.id) as number, teachers.nombre as name  from days_classes 
            INNER JOIN days_teachers ON days_classes.day_teacher_id = days_teachers.id 
            inner join teachers on teachers.id = days_teachers.teacher_id  WHERE days_teachers.teacher_id= ? GROUP BY teachers.nombre
            ', [$teacher->id]);
            array_push($Classes_month,$Consult);
    
            }
      

       
        $pdf = \PDF::loadView('pdf.Quincenal', compact('Classes_month'));
        return $pdf->download('ReporteQuincenal.pdf');

        } catch (Throwable $th) {
           return $th;
        }

      


    }
}