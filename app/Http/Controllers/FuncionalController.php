<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Teacher;
use App\Models\Day;
use App\Models\Pay;
use App\Models\Clase;
use App\Models\Day_clase;
use App\Models\Days_teachers;
use App\Models\Class_pend;
use App\Models\Month;
use App\Models\Week;
use App\Models\Contador;
use App\Models\Teacher_pay;
use App\Models\AsistenciaT;
use App\Models\AsisEst;
use App\Models\Log;
use App\Models\MonthAsi;
use App\Models\ClasseMuestra;
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

        public function lastTeachere(){
        $teacher = DB::select('select Min(id) as id from teachers');
            return response()->json([
                'teacher' => $teacher[0]->id
            ]);
        }

    public function listado_week($month_id){
        $weeks = Week::where('month_id', $month_id)->get();
        $contador = Contador::where('id', 1)->first();
     
        $first_day= $contador->last_month_day + 1;
        $last_day_month= 0;
        $last_month=true;

        if ($month_id == 1) {
            $total_days= date('t');
            $fecha_actual_formato = strtotime(date("d-m-Y"));
            $mesAnterior = date("d-m-Y", strtotime("-1 month", $fecha_actual_formato));
            $total_days_before = date('t', strtotime($mesAnterior));
        } else{                        
            $fecha_actual = strtotime(date("d-m-Y"));
            //sumo 1 mes
            $siguiente_mes = date("d-m-Y", strtotime("+1 month", $fecha_actual));
            $total_days = date('t', strtotime($siguiente_mes));
            $total_days_before = date('t');
            $last_day_month= date('t');
            $ultimo_dia = Contador::where('id', 1)->first();
           
            $first_day = $ultimo_dia->last_day + 1; 
        }

        foreach ($weeks as $wek => $value) {
            $last_day = $first_day +6;
            if ( $last_day > $total_days_before && $last_month) {
                $residuo = $last_day - $total_days_before;
                $last_day = $residuo ;
                $last_month=false; 
            }elseif($last_day > $total_days){
                $residuo = $last_day - $total_days;
                $last_day = $residuo ;
            }

            if($first_day > 31){
                $first_day =1;
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

    public function listado_clases($teacher, $week, $turno ){
        $get_last_teacher = DB::select('select Min(id) as id from teachers ');
        $last_teacher=  $get_last_teacher[0]->id;
        $Teachers =Teacher::all();
        $Horarios = DB::select('select schedules_teachers.Hora_inicio, schedules_teachers.Hora_final FROM teachers inner join schedules_teachers on schedules_teachers.id = teachers.schedule_id  WHERE teachers.id = ?', [$last_teacher]);
        $Days= DB::select('select days_teachers.id, days.Dia from days inner join days_teachers on days.id = days_teachers.day_id where days_teachers.teacher_id=?',[$last_teacher]);
        $number_of_days = count($Days);
        $hora_inicio = $Horarios[0]->Hora_inicio -0.5;
        $hora_final = $Horarios[0]->Hora_final +1;
        for($x=0; $x<$number_of_days; $x++){

            $id_day = $Days[$x]->id;
           $classValue = 0;
           $classValueLast = 0;
                $firstClass = Day_clase::where('day_teacher_id', $id_day)->first();

                $lastClass = Day_clase::orderBy('class_id', 'desc')->where('day_teacher_id', $id_day)->first();
                


                
            if($firstClass){
                $valueLast= $lastClass['class_id'];

                $firstClass = $firstClass['class_id'];
                $classValue = Clase::find($firstClass);
                $classValue = $classValue['valor'];

                $classValueLast = Clase::find($valueLast);
                $classValueLast = $classValueLast['valor'];
            }
        

            $Classes = DB::select('select days_classes.id as clase_id, classes.id, persons.id as id_person ,persons.nombre ,classes.Clase, days_classes.status from classes  inner join days_classes on classes.id = days_classes.class_id INNER JOIN persons ON days_classes.person_id =persons.id WHERE days_classes.day_teacher_id = ? and days_classes.week_id = ?', [$id_day, $week]);
           if($turno == "M"){
            $Classes_general = DB::select('select Clase, valor from classes  where valor > 8.0 and  valor <13');
           }else if($turno  == "V"){
             $Classes_general = DB::select('select Clase, valor from classes  where valor > 12.5');
           }
            $Classes_grupales = DB::select('select days_classes.id as clase_id, classes.id, persons.id as id_person ,persons.nombre ,classes.Clase, days_classes.status from classes  inner join days_classes on classes.id = days_classes.class_id INNER JOIN persons ON days_classes.person_id =persons.id WHERE days_classes.day_teacher_id =?  and days_classes.week_id =? and days_classes.grupal = 1', [$id_day, $week]);
            $nombres = [];
            $names = '';
            if($Classes_grupales){
                for ($z=0; $z < count($Classes_grupales); $z++) {
                   
                    $secon_name = $Classes_grupales[$z]->nombre;
                    if(in_array($secon_name, $nombres)){
                    }else{
                      array_push($nombres, $secon_name);
                      $names = $names . "\n" .$secon_name . ',';

                    }

                

                $Classes_grupales[$z]->nombre =  $names;
                }


            }
     


            for($y=0; $y<count($Classes_general); $y++){
                for($w=0; $w<count($Classes); $w++){
                    if($Classes_general[$y]->Clase == $Classes[$w]->Clase){             
                        $Classes_general[$y] = $Classes[$w];
                        if($Classes_grupales){
                            if($Classes_general[$y]->Clase == $Classes_grupales[$w]->Clase){
                                   $Classes_general[$y] = $Classes_grupales[$w];   
                            }
                        }
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


    public function listado_teacher($id, $week, $month_id, $first, $last, $turno){

      
        $last_teacher=  $id;
        $Days= DB::select('select days_teachers.id, days.Dia from days inner join days_teachers on days.id = days_teachers.day_id where days_teachers.teacher_id=?',[$last_teacher]);
        $number_of_days = count($Days);
        $Horarios = DB::select('select schedules_teachers.Hora_inicio, schedules_teachers.Hora_final FROM teachers inner join schedules_teachers on schedules_teachers.id = teachers.schedule_id
          WHERE teachers.id = ?', [$last_teacher]);
        $hora_inicio = $Horarios[0]->Hora_inicio -0.5;
        $hora_final = $Horarios[0]->Hora_final +1;
   
        for($x=0; $x<$number_of_days; $x++){
            $id_day = $Days[$x]->id;


            $classValue = 0;
            $classValueLast =0;
            $firstClass = Day_clase::where('day_teacher_id', $id_day)->first();

            $lastClass = Day_clase::orderBy('class_id', 'desc')->where('day_teacher_id', $id_day)->first();
            if($lastClass){
                $valueLast= $lastClass['class_id'];

            }


            
        if($firstClass){
            $firstClass = $firstClass['class_id'];
            $classValue = Clase::find($firstClass);
            $classValue = $classValue['valor'];

            $classValueLast = Clase::find($valueLast);
            $classValueLast = $classValueLast['valor'];
        }

            $Classes = DB::select('	select days_classes.id as clase_id, persons.id as id_person ,classes.id, persons.nombre ,classes.Clase, days_classes.status from classes  inner join days_classes on classes.id = days_classes.class_id INNER JOIN persons ON days_classes.person_id =persons.id inner join week on week.id = days_classes.week_id  inner join month on month.id= week.month_id WHERE days_classes.day_teacher_id = ? and days_classes.week_id = ? and week.month_id = ?', [$id_day, $week, $month_id]);
            if($turno == "M"){
                $Classes_general = DB::select('select Clase, valor from classes  where valor >= 9.0 and  valor <13');
               }else if($turno  == "V"){
                 $Classes_general = DB::select('select Clase, valor from classes  where valor > 12.5');
               }

            $Classes_grupales = DB::select('select days_classes.id as clase_id, classes.id, persons.id as id_person ,persons.nombre ,classes.Clase, days_classes.status from classes  inner join days_classes on classes.id = days_classes.class_id INNER JOIN persons ON days_classes.person_id =persons.id inner join week on week.id = days_classes.week_id   WHERE days_classes.day_teacher_id =?  and days_classes.week_id =? and  week.month_id =? and days_classes.grupal = 1', [$id_day, $week, $month_id]);

            $nombres = [];
            $names = '';

            if($Classes_grupales){
                for ($z=0; $z < count($Classes_grupales); $z++) {
                   
                    $secon_name = $Classes_grupales[$z]->nombre;
                    if(in_array($secon_name, $nombres)){
                    }else{
                      array_push($nombres, $secon_name);
                      $names = $names . "\n" . $secon_name . ',';

                    }

                

                $Classes_grupales[$z]->nombre =  $names;
                }


            }
     


            for($y=0; $y<count($Classes_general); $y++){
                for($w=0; $w<count($Classes); $w++){
                    if($Classes_general[$y]->Clase == $Classes[$w]->Clase){             
                        $Classes_general[$y] = $Classes[$w];
                        if($Classes_grupales){
                            if($Classes_general[$y]->Clase == $Classes_grupales[$w]->Clase){
                                   $Classes_general[$y] = $Classes_grupales[$w];   
                            }
                        }
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

        try {
        DB::beginTransaction();

            
        date_default_timezone_set('America/Mexico_City');
        $dia_actual = date("j");
        $day = date("N");


        //Calcular los días pasados del ultimo mes con el actual
        $dia = Contador::find(1);
        $last_month_day= $dia->last_month_day;
        $fecha_actual = strtotime(date("d-m-Y"));
        $siguiente_mes = date("d-m-Y", strtotime("-1 month", $fecha_actual));
        $total_days = date('t', strtotime($siguiente_mes));
        $dias_pasados = $total_days-($last_month_day-1);
        $dia_actual += $dias_pasados;
     
       $persona= Person::where('matricula', $matricula)->first();
   
        $actual_week = intdiv($dia_actual, 7);
        $actual_week += 1;

       $week = Week::where('description', $actual_week)->where('month_id', 1)->first();

       $day_teacher = DB::select('select dt.teacher_id from days_classes as dc
       inner JOIN days_teachers as dt on dc.day_teacher_id = dt.id  
       inner JOIN days as d on dt.day_id = d.id 
       WHERE dc.week_id=? 
       and dc.person_id =?
       and d.id= ?
       GROUP BY dt.teacher_id ' , [$actual_week, $persona->id, $day]);
       $day_teacher = $day_teacher[0]->teacher_id;
       $day = Days_teachers::where('teacher_id',$day_teacher)->where('day_id',$day)->first();

       $validador =  $day_clase = Day_clase::where('day_teacher_id', $day->id)->where('person_id', $persona->id)->where('week_id', $actual_week)->first();
       
       $day_clase = Day_clase::where('day_teacher_id', $day->id)->where('person_id', $persona->id)->where('week_id', $actual_week)->update([
           'asistencia' => 1,
       ]);
       $asistencia = AsistenciaT::where('teacher_id', $day_teacher)->first();


        if ($asistencia->asistencia == 1) {
            $pay_teacher = Teacher_pay::where('teacher_id', $day_teacher)->first();

            $number = $pay_teacher->total_classes  + 1;

             $update_pay=  Teacher_pay::where('teacher_id', $day_teacher)->update([
                    'total_classes' => $number,
            ]);
            

        }
            DB::commit();
    
            return response()->json();
    
           } catch (\Throwable $th) {
                DB::rollback();
                return abort(500, $th);
          }



    }
    


    public function paseListaTeacher($teacher_mat){
 
        
        $teacher = Teacher::where('matricula', $teacher_mat)->first();
        $person = Person::where('matricula', $teacher_mat)->first();


        try {
        DB::beginTransaction();
        $actualizacion= '';    
        date_default_timezone_set('America/Mexico_City');

            #ASISTENCIA DE Profesor
            if($teacher){
                $asistencia = AsistenciaT::where('teacher_id', $teacher->id)->update([
                    'asistencia' => 1
                ]);
                $verify =  MonthAsi::all();
                $arrayMonth = [];
                $day = [];
                if(count($verify) == 0){
                    $hoy = date("d"); 
                    $hora = date("H:i:s"); 
                    $day['dia'] = $hoy;
                    $day['hora'] = $hora;
                    MonthAsi::create([
                        'day' => $hoy ,
                        'hour' => $hora,
                        'teacher_id' => $teacher->id,
                    ]);
                }else{
                    $hoy = date("d"); 
                    $hora = date("H:i:s"); 
                    $day['dia'] = $hoy;
                    $day['hora'] = $hora;
                    MonthAsi::create([
                        'day' => $hoy ,
                        'hour' => $hora,
                        'teacher_id' => $teacher->id,
                    ]);
                }
                DB::commit();   
                return response()->json([
                    'Asistencia' => 'Teacher'
                ]); 

                #ASISTENCIA DE PERSONA
            }else if($person){

                date_default_timezone_set('America/Mexico_City');
                $dia_actual = date("j");
                $day = date("N");
        
        
                //Calcular los días pasados del ultimo mes con el actual
                $dia = Contador::find(1);
                $last_month_day= $dia->last_month_day;
                $fecha_actual = strtotime(date("d-m-Y"));
                $siguiente_mes = date("d-m-Y", strtotime("-1 month", $fecha_actual));
                $total_days = date('t', strtotime($siguiente_mes));
                $dias_pasados = $total_days-($last_month_day-1);
                $dia_actual += $dias_pasados;
             
               $persona= Person::where('matricula', $teacher_mat)->first();
           
                $actual_week = intdiv($dia_actual, 7);
                $actual_week += 1;
        
               $week = Week::where('description', $actual_week)->where('month_id', 1)->first();
        
               $day_teacher = DB::select('select dt.teacher_id from days_classes as dc
               inner JOIN days_teachers as dt on dc.day_teacher_id = dt.id  
               inner JOIN days as d on dt.day_id = d.id 
               WHERE dc.week_id=? 
               and dc.person_id =?
               and d.id= ?
               GROUP BY dt.teacher_id ' , [$actual_week, $persona->id, $day]);
              

               $day_teacher = $day_teacher[0]->teacher_id;
               
               $day = Days_teachers::where('teacher_id',$day_teacher)->where('day_id',$day)->first();
        
                $day_clase = Day_clase::where('day_teacher_id', $day->id)->where('person_id', $persona->id)->where('week_id', $actual_week)->first();
               $validador= $day_clase->asistencia;
               $day_claseUpdate = Day_clase::where('day_teacher_id', $day->id)->where('person_id', $persona->id)->where('week_id', $actual_week)->update([
                   'asistencia' => 1,
               ]);

               $asistencia = AsistenciaT::where('teacher_id', $day_teacher)->first();
                if ($asistencia->asistencia == 1) {

                    if($validador == 0){
                        $pay_teacher = Teacher_pay::where('teacher_id', $day_teacher)->first();
                        $number = $pay_teacher->total_classes  + 1;
                         $update_pay=  Teacher_pay::where('teacher_id', $day_teacher)->update([
                                'total_classes' => $number,
                        ]);
                     DB::commit();
                     return response()->json([
                        'Asistencia' =>"Alumno"
                    ]);   
          
                    }else{
                        return  response()->json([
                            'Asistencia' => 'Ya registrada'

                        ]  );
                    }
                }                      

            }
           
            return response()->json([
                'Asistencia'=>'Sin coindicencias'
            ]);
    
           } catch (\Throwable $th) {
                DB::rollback();
                return response()->json([
                    'Asistencia'=>'Sin coindicencias',
                    'error' => $th
                ]);
          }


       return $asistencia;

    }

    // public function paseListaTeacher(Request $request){
    //     return response()->json([

    //         'Respuesta' => 'Example'
    //     ]
    //     );
        
    //     $teacher = Teacher::where('matricula', $teacher_mat)->first();
    //     $person = Person::where('matricula', $teacher_mat)->first();


    //     try {
    //     DB::beginTransaction();
    //     $actualizacion= '';    
    //     date_default_timezone_set('America/Mexico_City');

    //         #ASISTENCIA DE Profesor
    //         if($teacher){
    //             $asistencia = AsistenciaT::where('teacher_id', $teacher->id)->update([
    //                 'asistencia' => 1
    //             ]);
    //             $verify =  MonthAsi::all();
    //             $arrayMonth = [];
    //             $day = [];
    //             if(count($verify) == 0){
    //                 $hoy = date("d"); 
    //                 $hora = date("H:i:s"); 
    //                 $day['dia'] = $hoy;
    //                 $day['hora'] = $hora;
    //                 MonthAsi::create([
    //                     'day' => $hoy ,
    //                     'hour' => $hora,
    //                     'teacher_id' => $teacher->id,
    //                 ]);
    //             }else{
    //                 $hoy = date("d"); 
    //                 $hora = date("H:i:s"); 
    //                 $day['dia'] = $hoy;
    //                 $day['hora'] = $hora;
    //                 MonthAsi::create([
    //                     'day' => $hoy ,
    //                     'hour' => $hora,
    //                     'teacher_id' => $teacher->id,
    //                 ]);
    //             }
    //             DB::commit();   
    //             return response()->json([
    //                 'Asistencia' => 'Teacher'
    //             ]); 

    //             #ASISTENCIA DE PERSONA
    //         }else if($person){

    //             date_default_timezone_set('America/Mexico_City');
    //             $dia_actual = date("j");
    //             $day = date("N");
        
        
    //             //Calcular los días pasados del ultimo mes con el actual
    //             $dia = Contador::find(1);
    //             $last_month_day= $dia->last_month_day;
    //             $fecha_actual = strtotime(date("d-m-Y"));
    //             $siguiente_mes = date("d-m-Y", strtotime("-1 month", $fecha_actual));
    //             $total_days = date('t', strtotime($siguiente_mes));
    //             $dias_pasados = $total_days-($last_month_day-1);
    //             $dia_actual += $dias_pasados;
             
    //            $persona= Person::where('matricula', $teacher_mat)->first();
           
    //             $actual_week = intdiv($dia_actual, 7);
    //             $actual_week += 1;
        
    //            $week = Week::where('description', $actual_week)->where('month_id', 1)->first();
        
    //            $day_teacher = DB::select('select dt.teacher_id from days_classes as dc
    //            inner JOIN days_teachers as dt on dc.day_teacher_id = dt.id  
    //            inner JOIN days as d on dt.day_id = d.id 
    //            WHERE dc.week_id=? 
    //            and dc.person_id =?
    //            and d.id= ?
    //            GROUP BY dt.teacher_id ' , [$actual_week, $persona->id, $day]);
              

    //            $day_teacher = $day_teacher[0]->teacher_id;
               
    //            $day = Days_teachers::where('teacher_id',$day_teacher)->where('day_id',$day)->first();
        
    //             $day_clase = Day_clase::where('day_teacher_id', $day->id)->where('person_id', $persona->id)->where('week_id', $actual_week)->first();
    //            $validador= $day_clase->asistencia;
    //            $day_claseUpdate = Day_clase::where('day_teacher_id', $day->id)->where('person_id', $persona->id)->where('week_id', $actual_week)->update([
    //                'asistencia' => 1,
    //            ]);

    //            $asistencia = AsistenciaT::where('teacher_id', $day_teacher)->first();
    //             if ($asistencia->asistencia == 1) {

    //                 if($validador == 0){
    //                     $pay_teacher = Teacher_pay::where('teacher_id', $day_teacher)->first();
    //                     $number = $pay_teacher->total_classes  + 1;
    //                      $update_pay=  Teacher_pay::where('teacher_id', $day_teacher)->update([
    //                             'total_classes' => $number,
    //                     ]);
    //                  DB::commit();
    //                  return response()->json([
    //                     'Asistencia' =>"Alumno"
    //                 ]);   
          
    //                 }else{
    //                     return  response()->json([
    //                         'Asistencia' => 'Ya registrada'

    //                     ]  );
    //                 }
    //             }                      

    //         }
           
    //         return response()->json([
    //             'Asistencia'=>'Sin coindicencias'
    //         ]);
    
    //        } catch (\Throwable $th) {
    //             DB::rollback();
    //             return abort(500, $th);
    //       }


    //    return $asistencia;

    // }

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
        // if($hora == '9:00'){
        //     $hora = '9:30';
        // }
        try {
        date_default_timezone_set('America/Mexico_City');
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
                $day_consult = Days_teachers::where('day_id', $day)->where('teacher_id', $t_id)->first();
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
            return 'Pase exitoso';
        } catch (\Throwable $th) {
         return $th;
        }
     


    }

    public function logs(){

        $logs = Log::orderBy('created_at', 'desc')->get();
        return response()->json($logs);

    }
    public function bajas(){

        $bajas = Person::onlyTrashed()->get();

        return response()->json($bajas);

    }

    public function verifyDay($day){
        
        
        date_default_timezone_set('America/Mexico_City');
        $dias = date('t');
        $fechaActual = date('Y-m-d');
        $mesActual = date('m');
        $dia = Contador::find(1);
        $valor = $dia->actual_day;
        if ( $day != $valor) {
            Contador::where('id', 1)->update([
                'actual_day' => $day
        ]);
            AsistenciaT::where('asistencia', 1)->update([
                'asistencia' => 0,
            ]);
        }
        $contador = Contador::first();
        $mes =$contador->mes;
     

        if( $day >= 15 || $day >= 1 && $mes != $mesActual){
            Teacher_pay::where('id', '!=', 0)->update([
                'total_classes' => 0,
                'porcentuales' => 0
            ]);
            // $mes = pay::first();
            // $mes = substr($mes, 5,2);
            // $actual_mes = date('m');

            if($day >= 1 ){
                Pay::where('fecha_vencimiento', '>='  ,$fechaActual)->update([
                    'status'=>0
                ]);
            }


        }elseif($day >= 1){

            //Cambio del primer mes para respaldar
            $segundoMes = Day_clase::where('week_id', 1)
            ->where('status', 1)
            ->update([
                'week_id' => 11
            ]);
            $segundoMes = Day_clase::where('week_id', 2)
            ->where('status', 1)
            ->update([
                'week_id' => 12
            ]);
            $segundoMes = Day_clase::where('week_id', 3)
            ->where('status', 1)
            ->update([
                'week_id' => 13
            ]);
            $segundoMes = Day_clase::where('week_id', 4)
            ->where('status', 1)
            ->update([
                'week_id' => 14
            ]);
            $segundoMes = Day_clase::where('week_id', 5)
            ->where('status', 1)
            ->update([
                'week_id' => 15
            ]);

            //Cambio del segundo mes al primer mes
            $segundoMes = Day_clase::where('week_id', 6)
            ->update([
                'week_id' => 1
            ]);
            $segundoMes = Day_clase::where('week_id', 7)
            ->update([
                'week_id' => 2
            ]);
            $segundoMes = Day_clase::where('week_id', 8)
            ->update([
                'week_id' => 3
            ]);
            $segundoMes = Day_clase::where('week_id', 9)
            ->update([
                'week_id' => 4
            ]);
            $segundoMes = Day_clase::where('week_id', 10)
            ->update([
                'week_id' => 5
            ]);


            //Acomodo del segundo mes

            $segundoMes = Day_clase::where('week_id', 11)
            ->update([
                'week_id' => 6
            ]);
            $segundoMes = Day_clase::where('week_id', 12)
            ->update([
                'week_id' => 7
            ]);
            $segundoMes = Day_clase::where('week_id', 13)
            ->update([
                'week_id' => 8
            ]);
            $segundoMes = Day_clase::where('week_id', 14)
            ->update([
                'week_id' => 9
            ]);
            $segundoMes = Day_clase::where('week_id', 15)
            ->update([
                'week_id' => 10
            ]);
            Contador::where('id',1)->update([
                'mes' => $mesActual
            ]);

        }
    }

        public function CambioMes(){
            $firstMonth = Day_clase::where('week_id',1)->orwhere('week_id',2)
            ->orWhere('week_id',3)
            ->orWhere('week_id',4)
            ->orWhere('week_id',5)
            ->get();

            $secondMonth = Day_clase::where('week_id',6)->orwhere('week_id',7)
            ->orWhere('week_id',8)
            ->orWhere('week_id',9)
            ->orWhere('week_id',10)
            ->get();

        return $secondMonth;

        }


        public function guardarClaseMuestra(Request $request){
            try {
                DB::beginTransaction();
                $teacher_id= $request['teacher_id'];
                $day_id= $request['day_id'];
                $clase_id= $request['clase_id'];
                $week_id= $request['semana_id'];
                $nombrePrueba= $request['nombrePrueba'];

                $person= Person::create([
                    'nombre' => $nombrePrueba,
                    'fecha_inicio' => '2022-02-14',
                    'nivel' => 'Ninguno',
                    'clases_semanales' => 1,
                    'estatus' => 0,
                ]);

                $clase = Day_clase::create([
                        'day_teacher_id' => $day_id,
                        'class_id' =>  $clase_id,
                        'person_id' => $person->id,
                        'week_id' => $week_id,
                        'status' => 7
                    ]);
                
                    DB::commit();   
        
             return response()->json([
                    'clase' => $clase ,
                ]) ;
                //code...
            } catch (\Throwable $th) {
                DB::rollback();
                return abort(500, $th);
            }
        }

        public function verificarListas(){
            // $AsistenciaT =AsistenciaT::all();

            $AsistenciaT = DB::select('select at.teacher_id,t.nombre ,at.created_at from asistencia_teacher as at
            inner JOIN teachers as t on at.teacher_id = t.id where at.asistencia = 1' );

            
            $AsistenciaA = DB::select('select st.alumno_id,p.nombre, st.created_at from studentasis as st
            inner join persons as p on p.id = st.alumno_id');

            return response()->json([
                'teacher' => $AsistenciaT,
                'alumno' => $AsistenciaA,
            ]);

        }

        
    
}