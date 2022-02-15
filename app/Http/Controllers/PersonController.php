<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Teacher;
use App\Models\Day;
use App\Models\Clase;
use App\Models\Day_clase;
use App\Models\Days_teachers;
use App\Models\Pay;
use App\Models\Class_pend;
use App\Models\History;
use Illuminate\Support\Facades\DB;
use App\Models\Log;
use App\Models\Sesion;


class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Persons = Person::all();
       
        return response()->json($Persons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::all();
        return response()->json([
            'teachers'=> $teachers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        DB::beginTransaction();
try {
    DB::commit();
    $numero_clases=$request['clases_semanales'];
        $teacher_id=$request['teacher_id'];


        $pers = Person::orderBy('id', 'desc')->first();
        if($pers){
            $last_person = $pers->id + 1;

        }else{
            $last_person = 1;
        }
        $request['matricula'] = 'AGDV00' . $last_person;
        $Person= Person::create([
            'nombre' =>$request['nombre'],
            'fecha_nacimiento' =>$request['fecha_nacimiento'],
            'nombre_papa' =>$request['nombre_papa'],
            'edad' =>$request['edad'],
            'telefono_papa' =>$request['telefono_papa'],
            'nombre_mama' =>$request['nombre_mama'],
            'telefono_mama' =>$request['telefono_mama'],
            'correo_electronico' =>$request['correo_electronico'],
            'nombre_emergencia' =>$request['nombre_emergencia'],
            'telefono_emergencia' =>$request['telefono_emergencia'],
            'fecha_inicio' =>$request['fecha_inicio'],
            'enfermedad' =>$request['enfermedad'],
            'nivel' =>$request['nivel'],
            'clases_semanales' =>$request['clases_semanales'],
            'matricula' =>$request['matricula'],
        ]);

        for($x=1; $x<=$numero_clases; $x++){

            $clase_id=$request['clase_id_'.$x];
            $day_id=$request['day_id_'.$x];
            $nivel = $request['nivel'];

         
         for ($i=1; $i <11 ; $i++) { 
      
            if($nivel == 'Grupales'){
         

                Day_clase::create([
                    'day_teacher_id' => $day_id,
                    'class_id' =>  $clase_id,
                    'person_id' => $Person->id,
                    'status' => 8,
                    'week_id' => $i,
                    'grupal' => 1,
                    'asistencia' => 0,
    
                ]);

                Day_clase::create([
                    'day_teacher_id' => $day_id,
                    'class_id' =>  $clase_id +1,
                    'person_id' => $Person->id,
                    'status' => 8,
                    'week_id' => $i,
                    'grupal' => 1,
                    'asistencia' => 0,
                ]);
            } else {
                Day_clase::create([
                    'day_teacher_id' => $day_id,
                    'class_id' =>  $clase_id,
                    'person_id' => $Person->id,
                    'status' => 1,
                    'week_id' => $i,
                    'grupal' => 0,
                    'asistencia' => 0,

    
                ]);# code...
            }
         } 
          
           
           
        }
      

        $meses  = (int) $request['mesesPagados'];


        $fecha_inicio = $request['fecha_inicio'];

        $fechaComoEntero = strtotime($fecha_inicio);

        $anio = date("Y", $fechaComoEntero);
        $mes = date("m", $fechaComoEntero);
        $dia = date("d", $fechaComoEntero);
        $mes = $mes + $meses; 
        if($mes < 10){
            $mes = '0'.$mes;
        }else if($mes > 12){
            $mes -= 12;
            $anio +=1; 
        }
        $fecha_vencimiento = $anio.'-'.$mes.'-'.$dia;
        
      
        Pay::create([
            'cantidad' => $request['clases_precio'],
            'fecha_pago' =>  $request['fecha_inicio'],
            'fecha_vencimiento' =>  $fecha_vencimiento,
            'person_id' => $Person->id,
            'status' => 1,
           

        ]);

        $sesion = Sesion::find(1);

        Log::create([
            'Log' => 'Incripcion de estudiante:  ' . $Person->nombre,
            'usuario' => $sesion->usuario,
        ]);
        

                return response()->json([
                    'Person' => $Person,
                ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return abort(500, $th);
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Person $Person)
    {
        $clases_person = Day_clase::select('class_id','day_teacher_id')->where('person_id', $Person->id)->distinct()->get();
            for($x=0; $x<sizeof($clases_person); $x++){
                    $teacher_id = Days_teachers::select('teacher_id')->where('id', $clases_person[$x]->day_teacher_id)->first();
                    $y = $x+1;
                    $clase = "clase_id_".$y;
                    $dia = "day_id_".$y;
                    $teacher = "teacher_id_".$y;
                    $Person[$clase]=$clases_person[$x]->class_id;
                    $Person[$dia]=$clases_person[$x]->day_teacher_id;
                    $Person[$teacher]=$teacher_id->teacher_id;
                }

        // $teacher=  Teacher::where();
        $pago = Pay::where('person_id', $Person->id)->first();
        $Person['clases_precio'] = $pago->cantidad;
        return response()->json($Person);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarPersona(Request $request)
    {
        DB::beginTransaction();
        try {
         

            $Persona= Person::where('id', $request['id'])->update([
                'nombre' =>$request['nombre'],
                'fecha_nacimiento' =>$request['fecha_nacimiento'],
                'nombre_papa' =>$request['nombre_papa'],
                'edad' =>$request['edad'],
                'telefono_papa' =>$request['telefono_papa'],
                'nombre_mama' =>$request['nombre_mama'],
                'telefono_mama' =>$request['telefono_mama'],
                'correo_electronico' =>$request['correo_electronico'],
                'nombre_emergencia' =>$request['nombre_emergencia'],
                'telefono_emergencia' =>$request['telefono_emergencia'],
                'fecha_inicio' =>$request['fecha_inicio'],
                'enfermedad' =>$request['enfermedad'],
                'nivel' =>$request['nivel'],
                'clases_semanales' =>$request['clases_semanales'],
                'matricula' =>$request['matricula'],
                'categoria'=>$request['categoria']
            ]);

            $classes = Day_clase::where('person_id', $request['id'])->get();
    
            foreach ($classes as $clase ) {
                Day_clase::destroy($clase->id);
    
                Class_pend::where('id', $clase->id)->delete();
            }
    
            $numero_clases =$request['clases_semanales'];
            
        for($x=1; $x<=$numero_clases; $x++){

            $clase_id=$request['clase_id_'.$x];
            $day_id=$request['day_id_'.$x];
            $nivel = $request['nivel'];

         for ($i=1; $i <11 ; $i++) { 
      
            if($nivel == 'Grupales'){
         

                Day_clase::create([
                    'day_teacher_id' => $day_id,
                    'class_id' =>  $clase_id,
                    'person_id' => $request['id'],
                    'status' => 8,
                    'week_id' => $i,
                    'grupal' => 1,
                    'asistencia' => 0,
    
                ]);

                Day_clase::create([
                    'day_teacher_id' => $day_id,
                    'class_id' =>  $clase_id +1,
                    'person_id' => $request['id'],
                    'status' => 8,
                    'week_id' => $i,
                    'grupal' => 1,
                    'asistencia' => 0,
                ]);
            } else {
                Day_clase::create([
                    'day_teacher_id' => $day_id,
                    'class_id' =>  $clase_id,
                    'person_id' => $request['id'],
                    'status' => 1,
                    'week_id' => $i,
                    'grupal' => 0,
                    'asistencia' => 0,
                ]);
            }
         } 
        }

            $sesion = Sesion::find(1);
    
            Log::create([
                'Log' => 'Actualizacion de estudiante:  ' . $request->nombre,
                'usuario' => $sesion->usuario,
            ]);
            DB::commit();
    
            return response()->json($Persona);

        } catch (\Throwable $th) {
            DB::rollback();
            return abort(500, $th);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $Person)
    {
        $id= $Person->id;

        $classes = Day_clase::where('person_id', $id)->get();

        $sesion = Sesion::find(1);

        Log::create([
            'Log' => 'Baja  de estudiante:  ' . $Person->nombre,
            'usuario' => $sesion->usuario,
        ]);



        foreach ($classes as $clase ) {
            Day_clase::destroy($clase->id);

            Class_pend::where('id', $clase->id)->delete();
        }


        $Person->delete();

   

        return response()->json([

            'mensaje' =>'Eliminado'
        ]);

    }

    public function ShowDays($id){
        // $days =Days_teachers::where('teacher_id', $id)->get();
        $days = DB::select('select days_teachers.id as id, days.dia as Dia from days inner join days_teachers on days.id = days_teachers.day_id WHERE days_teachers.teacher_id=?', [$id]);
        return response()->json(['days' => $days]);

    }

    public function ShowClasses($id_day,$id_teacher){
        $Horarios = DB::select('select schedules_teachers.Hora_inicio, schedules_teachers.Hora_final FROM teachers inner join schedules_teachers on schedules_teachers.id = teachers.schedule_id  WHERE teachers.id = ?', [$id_teacher]);
        $hora_inicio = $Horarios[0]->Hora_inicio-1;
        $hora_final = $Horarios[0]->Hora_final+2;

      
        $clases = DB::select('select id, Clase, valor from  classes where id not in(SELECT classes.id FROM classes inner JOIN
        days_classes  on classes.id = days_classes.class_id INNER JOIN days_teachers on days_classes.day_teacher_id= ? where days_teachers.teacher_id =? and days_classes.status != 8 ) having valor > ? and valor < ?', [$id_day, $id_teacher, $hora_inicio, $hora_final]);

        return response()->json(['clases' => $clases]);

    }

    public function consult_pay($id){
        // $pay = Pay::all();
         
        $pay = Pay::where('person_id', $id)->first();
    
        return response()->json(['pay' => $pay]);
    }


    public function save_pay($id,$forma,$tarjeta, $cantidad){
        DB::beginTransaction(); 
        try {
            
            $date_now = date('Y/m/d'); 
            $pay = Pay::where('person_id', $id)->update([
                'fecha_pago' => $date_now,
                'status' => 1
            ]);
    
            History::create([
                'person_id' => $id,
                'forma_pago' => $forma,
                'cantidad' => $cantidad,
                'fecha_pago' => $date_now,
                'tipo_tarjeta' => $tarjeta,
            ]);

            $sesion = Sesion::find(1);

            Log::create([
                'Log' => 'Registro de pago   ' . $date_now,
                'usuario' => $sesion->usuario,
            ]);
            DB::commit();

        return response()->json('Guardado');

        }catch (\Throwable $th) {
            DB::rollback();
            return abort(500, $th);
        }
       

    }
}