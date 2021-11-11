<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Teacher;
use App\Models\Day;
use App\Models\Clase;
use App\Models\Day_clase;
use App\Models\Days_teachers;
use App\Models\Class_pend;
use Illuminate\Support\Facades\DB;



class FuncionalController extends Controller
{
    
    public function listado_clases(){
        $get_last_teacher = DB::select('select Min(id) as id from teachers');
        $last_teacher=  $get_last_teacher[0]->id;
        $Teachers =Teacher::all();
        $Horarios = DB::select('select schedules_teachers.Hora_inicio, schedules_teachers.Hora_final FROM teachers inner join schedules_teachers on schedules_teachers.id = teachers.schedule_id  WHERE teachers.id = ?', [$last_teacher]);
        $Days= DB::select('select days_teachers.id, days.Dia from days inner join days_teachers on days.id = days_teachers.day_id where days_teachers.teacher_id=?',[$last_teacher]);
        $number_of_days = count($Days);
        $hora_inicio = $Horarios[0]->Hora_inicio;
        $hora_final = $Horarios[0]->Hora_final;
        for($x=0; $x<$number_of_days; $x++){

            $id_day = $Days[$x]->id;
            $Classes = DB::select('select days_classes.id as clase_id, classes.id, persons.id as id_person ,persons.nombre ,classes.Clase, days_classes.status from classes  inner join days_classes on classes.id = days_classes.class_id INNER JOIN persons ON days_classes.person_id =persons.id WHERE days_classes.day_teacher_id = ?', [$id_day]);
           
            $Classes_general = DB::select('select Clase, valor from classes having valor > ? and valor < ?',[$hora_inicio, $hora_final]);


            for($y=0; $y<count($Classes_general); $y++){
                for($w=0; $w<count($Classes); $w++){

                    if($Classes_general[$y]->Clase == $Classes[$w]->Clase){
                        $Classes_general[$y] = $Classes[$w];
                    }
                    
                    } 
            }
            
            $Days[$x]->Clases = $Classes_general;
        }

        
        return response()->json([
            'Teachers' => $Teachers ,
            'Days' => $Days ,
        
          
        ]) ;
    }
    public function listado_teacher($id){

      
        $last_teacher=  $id;
        $Days= DB::select('select days_teachers.id, days.Dia from days inner join days_teachers on days.id = days_teachers.day_id where days_teachers.teacher_id=?',[$last_teacher]);
        $number_of_days = count($Days);
        for($x=0; $x<$number_of_days; $x++){
            $id_day = $Days[$x]->id;
            $Classes = DB::select('select days_classes.id as clase_id, persons.id as id_person ,classes.id, persons.nombre ,classes.Clase, days_classes.status from classes  inner join days_classes on classes.id = days_classes.class_id INNER JOIN persons ON days_classes.person_id =persons.id WHERE days_classes.day_teacher_id = ?', [$id_day]);
            $Classes_general = DB::select('SELECT Clase from classes');


            for($y=0; $y<count($Classes_general); $y++){
                for($w=0; $w<count($Classes); $w++){

                    if($Classes_general[$y]->Clase == $Classes[$w]->Clase){
                        $Classes_general[$y] = $Classes[$w];
                    }
                    
                    } 
            }
           
            $Days[$x]->Clases = $Classes_general;
            
        }

        return response()->json([
          
            'Days' => $Days ,
        
          
        ]) ;
    }

    public function cambioClase(Request $request){
        $first_id= $request['first_id'];
        $teacher_id= $request['teacher_id'];
        $day_id= $request['day_id'];
        $clase_id= $request['clase_id'];
        $person_id= $request['person_id'];

        Day_clase::where('id', $first_id)->update([
            'status' => 3,
        ]);
       

        $clase = Day_clase::create([
                'day_teacher_id' => $day_id,
                'class_id' =>  $clase_id,
                'person_id' => $person_id,
                'status' => 4
            ]);
        

     return response()->json([
          
            'clase' => $clase ,
        
          
        ]) ;
        

    }


    public function faltaClase(Request $request){
       
        $clase_id= $request['first_id'];
        $desc= $request['desc_falta'];

        $classe= Day_clase::where('id', $clase_id)->first();

        $Class_pend = Class_pend::create([
            'class_id' => $clase_id,
            'motivo_falta' => $desc,
            'fecha_clase'=> $classe->updated_at

        ]);


        Day_clase::where('id', $clase_id)->update([
            'status' => 5,
        ]);
     return response()->json([
          
            'respuesta' => 'respuesta',
        
          
        ]) ;
        

    }

    public function clasesPendientes(){
        $pendientes = Class_pend::all();
       
        return response()->json($pendientes);
    }
}