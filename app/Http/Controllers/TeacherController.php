<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Schedule;
use App\Models\Days_teachers;
use App\Models\Teacher_pay;
use App\Models\AsistenciaT;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Teachers = Teacher::all();
       
        return response()->json($Teachers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedules = Schedule::all();
        
        return response()->json([
            
            'schedules' => $schedules,]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teach = Teacher::orderBy('id', 'desc')->first();
        if($teach){
            $last_teacher = $teach->id + 1;
            $request['matricula'] = 'TGDV00' . $last_teacher;
        }else{
            $request['matricula'] = 'TGDV00' . 1;

        }
      
        $Teacher= Teacher::create($request->all());

        Teacher_pay::create([
            'teacher_id' => $Teacher->id,
            'total_classes' =>0,
            'porcentuales' =>0,
        ]);

        AsistenciaT::create([
            'teacher_id' => $Teacher->id,
            'asistencia' =>0

        ]);
        
        $last_day = Days_teachers::max('id');
        $teacher_id = $Teacher->id;

        for($x=1; $x<7; $x++){
            Days_teachers::create([
                'day_id'  =>  $x,
                'teacher_id' =>$teacher_id ,
                'status' =>1 ,
            ]);

        }
       
        $sesion = Sesion::find(1);

        Log::create([
            'Log' => 'Creación de profesor:  ' . $Teacher->nombre,
            'usuario' => $sesion->usuario,
        ]);



        return response()->json([
            'Teacher' => $Teacher,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $Teacher)
    {
        $schedules = Schedule::all();
        return response()->json([
           'Teacher'=> $Teacher,
           'schedules'=> $schedules,
           ]);  
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
    public function update(Request $request, Teacher $Teacher)
    {

        
        $Teacher->fill($request->post())->save();

        $sesion = Sesion::find(1);

        Log::create([
            'Log' => 'Actualización  de profesor:  ' . $Teacher->nombre,
            'usuario' => $sesion->usuario,
        ]);

        return response()->json($Teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $Teacher)
    {

        $sesion = Sesion::find(1);

        Log::create([
            'Log' => 'Baja  de profesor:  ' . $Teacher->nombre,
            'usuario' => $sesion->usuario,
        ]);

        $Teacher->delete();
        return response()->json([

            'mensaje' =>'Eliminado'
        ]);

    }
}