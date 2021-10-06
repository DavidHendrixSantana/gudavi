<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Teacher;
use App\Models\Day;
use App\Models\Clase;
use App\Models\Day_clase;
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
        $Person= Person::create($request->all());

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

    public function ShowDays(Request $request, $id){
        $days =Day::where('teacher_id', $id)->get();

        return response()->json(['days' => $days]);

    }

    public function ShowClasses(Request $request, $id){
        $clases = DB::select('select * from classes where id not in (select id from days_classes)');

        return response()->json(['clases' => $clases]);

    }
}