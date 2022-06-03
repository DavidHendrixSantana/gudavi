<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Day_clase;
use App\Models\Days_teachers;
use App\Models\History;
use App\Models\Pay;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
use \stdClass;


class PdfController extends Controller
{
    public function ReporterQuincenal(){

        try {
            $Classes_month=[];
            $Teachers=Teacher::all();

            foreach($Teachers as $teacher){
            $Consult = DB::select('select COUNT(days_classes.id) as number,teachers.nombre as name  from days_classes 
            INNER JOIN days_teachers ON days_classes.day_teacher_id = days_teachers.id 
            inner join teachers on teachers.id = days_teachers.teacher_id 
					WHERE days_classes.status !=2 and days_classes.status !=3   and days_teachers.teacher_id= ? GROUP BY teachers.nombre
            ', [$teacher->id]) ;

            if (isset($Consult[0]->name)){
       
                    $preconsult = DB::select('select teachers_pay.total_classes, teachers.pago_hora from teachers_pay
                    INNER JOIN teachers on teachers.id = teachers_pay.teacher_id
                WHERE teacher_id = ?', [$teacher->id]);
                    $preconsult = $preconsult[0];
                    array_push($Consult,$preconsult);

                    $clases_pendientes = DB::select('select COUNT(days_classes.id) as pendientes  from days_classes 
                    INNER  JOIN days_teachers ON days_classes.day_teacher_id = days_teachers.id 
                    INNER join teachers on teachers.id = days_teachers.teacher_id 
                            WHERE days_classes.status=5 and days_teachers.teacher_id=? GROUP BY teachers.nombre', [$teacher->id]);

                    if(isset($clases_pendientes[0])){
                        $pendientes = $clases_pendientes[0];
                        array_push($Consult,$pendientes);

                    }else{
                    
                        $sin_pendientes = new stdClass();
                        $sin_pendientes->pendientes = 0;
                        array_push($Consult,$sin_pendientes);

                    }
                        
            array_push($Classes_month,$Consult);
        }
    
            }

       
        $pdf = \PDF::loadView('pdf.QuincenalTeachers', compact('Classes_month'));
        
        return $pdf->download('ReporteQuincenal.pdf');

        } catch (Throwable $th) {
           return $th;
        }
    }



    public function ReporterQuincenalPersons(){

        try {
            
        $Consult = DB::select('select persons.nombre,forma_pago, cantidad, fecha_pago, tipo_tarjeta, folio from pays_history
        INNER JOIN persons on persons.id = pays_history.person_id ');
        
        // $Consult = History::select('cantidad', 'fecha_pago', 'tipo_tarjeta')->where->get();

    //   return $Consult;

        $pdf = \PDF::loadView('pdf.QuincelPagosPersons', compact('Consult'));
        
        return $pdf->download('QuincenalPagosPersons.pdf');

        } catch (Throwable $th) {
           return $th;
        }
    }


    public function ReporteFechas($formaPago, $fechaInicio, $fechaFinal){

        try {
            $pagos = History::select('forma_pago', 'cantidad', 'fecha_pago','tipo_tarjeta','folio','person_id')->whereDate('created_at', '>=', $fechaInicio)->whereDate('created_at', '<=', $fechaFinal)->get(); 
            foreach($pagos as $pago){
                $persona =Person::where('id', $pago->person_id)->first();
                $pago['nombre']=$persona->nombre;
            }
            $Consult = $pagos;
                $pdf = \PDF::loadView('pdf.QuincelPagosPersons', compact('Consult', 'fechaInicio', 'fechaFinal' ));
                return $pdf->download('QuincenalPagosPersons.pdf');
                
        } catch (Throwable $th) {
            return $th;
        }

       

      
    }

    public function AsistenciasT()
    {
        $Teachers =  Teacher::all();
        return view('pdf.AsistenciasProfesores', compact('Teachers'));
    }



  
}