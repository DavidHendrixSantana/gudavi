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
use App\Models\History;
use Illuminate\Support\Facades\DB;

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

     


        $numero_clases=$request['clases_semanales'];
        $teacher_id=$request['teacher_id'];
        
      
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
        ]);

        for($x=1; $x<=$numero_clases; $x++){

            $clase_id=$request['clase_id_'.$x];
            $day_id=$request['day_id_'.$x];

         
          
            Day_clase::create([
                'day_teacher_id' => $day_id,
                'class_id' =>  $clase_id,
                'person_id' => $Person->id,
                'status' => 1
            ]);
           
           
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
        }
        $fecha_vencimiento = $anio.'-'.$mes.'-'.$dia;
        
      
        Pay::create([
            'cantidad' => $request['clases_precio'],
            'fecha_pago' =>  $request['fecha_inicio'],
            'fecha_vencimiento' =>  $fecha_vencimiento,
            'person_id' => $Person->id,
            'status' => 1,
           

        ]);
        


        //Creamos la persona
        //Creamos la asignación de clases

        return response()->json([
            'Person' => $Person,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Person $Person)
    {
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
    public function update(Request $request, Person $Person)
    {
        $Person->fill($request->post())->save();

        return response()->json($Person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $Person)
    {
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
      
        $clases = DB::select('select id, Clase from  classes where id not in(SELECT classes.id FROM classes inner JOIN
        days_classes  on classes.id = days_classes.class_id INNER JOIN days_teachers on days_classes.day_teacher_id= ? where days_teachers.teacher_id =?)', [$id_day, $id_teacher]);

        return response()->json(['clases' => $clases]);

    }

    public function consult_pay($id){
        // $pay = Pay::all();
         
        $pay = Pay::where('person_id', $id)->first();
    
        return response()->json(['pay' => $pay]);
    }


    public function save_pay($id,$forma,$tarjeta, $cantidad){
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
                'tarjeta' => $tarjeta,
            ]);

        return response()->json('Guardado');

          
        } catch (Throwable $th) {

        return response()->json($th);

           
        }
       

    }
}