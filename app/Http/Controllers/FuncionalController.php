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
use App\Models\Month;
use App\Models\Week;
use App\Models\Contador;
use App\Models\Teacher_pay;
use App\Models\AsistenciaT;
use Illuminate\Support\Facades\DB;
use \stdClass;



class FuncionalController extends Controller
{
    
    public function listado_month(){
        $months= Month::all();
        return response()->json([
            'Months' => $months
        ]);

    }
    public function listado_week($month_id){
        $weeks = Week::where('month_id', $month_id)->get();
        $first_day=1;
        $last_day_month= 0;

        if ($month_id == 1) {
            $total_days= date('t');

        } else{                        
            $fecha_actual = strtotime(date("d-m-Y"));
            //sumo 1 mes
            $siguiente_mes = date("d-m-Y", strtotime("+1 month", $fecha_actual));
            $total_days = date('t', strtotime($siguiente_mes));
            $last_day_month= date('t');
      
            $ultimo_dia = Contador::where('id', 1)->first();
            $first_day = $ultimo_dia->last_day + 1; 

        }

        foreach ($weeks as $wek => $value) {
            $last_day = $first_day +6;
            if ($last_day > $total_days) {
                $residuo = $last_day - $total_days;
                $last_day = $residuo ; 
            }
            $value['description'] = $first_day . '-'. $last_day ;
            $value['first_day'] = $first_day  ;
            $value['last_day'] = $last_day ;
            $first_day = $last_day + 1;
            $last_day_month = $last_day;
        }
        if ($month_id == 1) {
            Contador::where('id', 1)->update([
                'last_day' => $last_day_month,
            ]);
        }elseif($month_id == 2){
            Contador::where('id', 1)->update([
                'first_day' => $last_day_month,
            ]);
        }


        return response()->json([
            'Weeks' => $weeks
        ]);

    }

    public function listado_clases($teacher, $week){
        $get_last_teacher = DB::select('select Min(id) as id from teachers');
        $last_teacher=  $get_last_teacher[0]->id;
        $Teachers =Teacher::all();
        $Horarios = DB::select('select schedules_teachers.Hora_inicio, schedules_teachers.Hora_final FROM teachers inner join schedules_teachers on schedules_teachers.id = teachers.schedule_id  WHERE teachers.id = ?', [$last_teacher]);
        $Days= DB::select('select days_teachers.id, days.Dia from days inner join days_teachers on days.id = days_teachers.day_id where days_teachers.teacher_id=?',[$last_teacher]);
        $number_of_days = count($Days);
        $hora_inicio = $Horarios[0]->Hora_inicio -0.5;
        $hora_final = $Horarios[0]->Hora_final +1;
        for($x=0; $x<$number_of_days; $x++){

            $id_day = $Days[$x]->id;
            $Classes = DB::select('select days_classes.id as clase_id, classes.id, persons.id as id_person ,persons.nombre ,classes.Clase, days_classes.status from classes  inner join days_classes on classes.id = days_classes.class_id INNER JOIN persons ON days_classes.person_id =persons.id WHERE days_classes.day_teacher_id = ? and days_classes.week_id = ?', [$id_day, $week]);
           
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
    public function listado_teacher($id, $week, $month_id, $first, $last){

      
        $last_teacher=  $id;
        $Days= DB::select('select days_teachers.id, days.Dia from days inner join days_teachers on days.id = days_teachers.day_id where days_teachers.teacher_id=?',[$last_teacher]);
        // $total_days= date('t');
        // $residuo = 0;
        // $new_days = [];
        // $day_prov = [];
        // $i = 0;
  

        // if ($month_id == 1) {
        //     $total_days= date('t');

        // } else{
                        
        //     $fecha_actual = strtotime(date("d-m-Y"));
        //     //sumo 1 mes
        //     $siguiente_mes = date("d-m-Y", strtotime("+1 month", $fecha_actual));
        //     $total_days = date('t', strtotime($siguiente_mes));
        // }
        // $first += 6;
        // if($first >$total_days){
        //     $residuo = $first - $total_days;
        // }
        // $number_of_days -= $residuo; 
 
      
        //     foreach ($Days as $day) {
        //         if ($i < $number_of_days) {
        //             $new_days[$i] = $day;
        //             $i++;
        //         }
               
            
        //     }
        //     $Days = $new_days;


            $number_of_days = count($Days);
   
        for($x=0; $x<$number_of_days; $x++){
            $id_day = $Days[$x]->id;
            $Classes = DB::select('	select days_classes.id as clase_id, persons.id as id_person ,classes.id, persons.nombre ,classes.Clase, days_classes.status from classes  inner join days_classes on classes.id = days_classes.class_id INNER JOIN persons ON days_classes.person_id =persons.id inner join week on week.id = days_classes.week_id  inner join month on month.id= week.month_id WHERE days_classes.day_teacher_id = ? and days_classes.week_id = ? and week.month_id = ?', [$id_day, $week, $month_id]);
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
        $week_id= $request['semana_id'];
        $motivo= $request['motivo'];

        Day_clase::where('id', $first_id)->update([
            'motivo' => $motivo,
            'status' => 3,
        ]);
       
 
        
        $clase = Day_clase::create([
                'day_teacher_id' => $day_id,
                'class_id' =>  $clase_id,
                'person_id' => $person_id,
                'week_id' => $week_id,
                'motivo' => $motivo,
                'status' => 4
            ]);
        

     return response()->json([
          
            'clase' => $clase ,
        
          
        ]) ;
        

    }

    public function cambioClasePend(Request $request){
        $pend_id= $request['pend_id'];
        $first_id= $request['first_id'];
        $teacher_id= $request['teacher_id'];
        $day_id= $request['day_id'];
        $clase_id= $request['clase_id'];
        $person_id= $request['person_id'];
        $week_id= $request['semana_id'];
        $motivo= $request['motivo'];


        $pendiente = Class_pend::find($pend_id);
        $pendiente->delete();

        $classe_original=  Day_clase::find($first_id);
        
       

        $clase = Day_clase::create([
                'day_teacher_id' => $day_id,
                'class_id' =>  $clase_id,
                'person_id' => $classe_original->person_id,
                'status' => 7,
                'week_id' => $week_id,
                'motivo' => $motivo,
                

        
            ]);
        

     return response()->json([
          
            'clase' => $pendiente ,
        
          
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
        $pendientes = DB::select('SELECT cp.id, cp.class_id, cp.fecha_clase, cp.motivo_falta , p.nombre from classes_pend as cp inner join days_classes as dc on cp.class_id = dc.id INNER JOIN persons as p on p.id = dc.person_id');
       
        return response()->json($pendientes);
    }

    public function paseLista($matricula){
     
       $persona= Person::where('matricula', $matricula)->first();
       $dia_actual = date("d");
       $day = date("N");
        $actual_week = intdiv($dia_actual, 7);
        $actual_week += 1;

       $week = Week::where('description', $actual_week)->where('month_id', 1)->first();
       $day = Days_teachers::where('day_id', $day-1)->first();
       $teacher = $day->teacher_id;
       $validador =  $day_clase = Day_clase::where('day_teacher_id', $day->id)->where('person_id', $persona->id)->where('week_id', $actual_week)->first();
       $day_clase = Day_clase::where('day_teacher_id', $day->id)->where('person_id', $persona->id)->where('week_id', $actual_week)->update([
           'asistencia' => 1,
       ]);

       if ( $validador->asistencia == 0) {
        $asistencia = AsistenciaT::where('teacher_id', $teacher)->first();
        if ($asistencia->asistencia == 1) {
            
            $pay_teacher = Teacher_pay::where('teacher_id', $teacher)->first();
            $number = $pay_teacher->total_classes  + 1;
            Teacher_pay::where('teacher_id', $teacher)->update([
                    'total_classes' => $number,
            ]);
          
        }

       }

    }


    public function paseListaTeacher($teacher_mat){
       $teacher = Teacher::where('matricula', $teacher_mat)->first();
       $asistencia = AsistenciaT::where('teacher_id', $teacher->id)->update([
           'asistencia' => 1
       ]);

       return $asistencia;

    }

    public function getFirstHour(){
        try {
            $class = Clase::where('id', 1)->first();
            $hour = $class->Clase;

            return response()->json([
                'firstHour' => $hour,
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
      
    }


    public function ListaClases($hora){
        $hora = $hora;
        if($hora == '9:00'){
            $hora = '9:30';
        }

        try {
        $class = Clase::where('Clase', $hora)->first();
        $id_class = $class->id - 1;
        $asistencia = 0;

        $dia_actual = date("d");
        $day = date("N");
        $actual_week = intdiv($dia_actual, 7);
        $actual_week += 1;
        $teachers = DB::select('select * from teachers ');
        $week = Week::where('description', $actual_week)->where('month_id', 1)->first();



            for ($p=0; $p < sizeof($teachers); $p++) { 
                $t_id = $teachers[$p]->id;


                $consult_at = AsistenciaT::where('teacher_id', $t_id)->first();
                $asistencia = $consult_at->asistencia;
                $day_consult = Days_teachers::where('day_id', $day-1)->where('teacher_id', $t_id)->first();
          
                $pendientes = Day_clase::where('class_id', $id_class)->where('asistencia' , 0)->where('day_teacher_id', $day_consult->id)->where('week_id', $actual_week)->get();
                    $dia_asistido = Day_clase::where('class_id', $id_class)->where('day_teacher_id', $day_consult->id)->where('week_id', $actual_week)->first();

                    if($dia_asistido){
                        $valorAsistencia = $dia_asistido->asistencia; 
            

    
                        if($asistencia == 1 && $valorAsistencia == 1){ 
        
                            $pay_teacher = Teacher_pay::where('teacher_id', $t_id)->first();
                            $number = $pay_teacher->total_classes  + 1;
                            Teacher_pay::where('teacher_id', $t_id
                            )->update([
                                    'total_classes' => $number,
                            ]);
                            
                        }elseif ($asistencia == 1 && $valorAsistencia == 0) {
                            $pay_teacher = Teacher_pay::where('teacher_id', $t_id)->first();
                            $number = $pay_teacher->porcentuales  + 1;
                            Teacher_pay::where('teacher_id', $t_id
                            )->update([
                                    'porcentuales' => $number,
                            ]);

                            $faltas = Day_clase::where('class_id', $id_class)->where('asistencia' , 0)->where('day_teacher_id', $day_consult->id)->where('week_id', $actual_week)->update([
                                'status' => 5
                            ]);

                            for ($i=0; $i < sizeof($pendientes) ; $i++) { 
                                Class_pend::create([
                                    'class_id' => $pendientes[$i]->id,
                                    'motivo_falta' => 'Inasistencia',
                                    'fecha_clase'=> $pendientes[$i]->updated_at
                                ]);
                            }
                        }

                    }
                    
                 
                

                
         
        
            
            
                        
                   
            }
            return 'entrando';


        
                
            
        } catch (\Throwable $th) {
         return $th;
        }
     


    }
}