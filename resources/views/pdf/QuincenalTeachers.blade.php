<?php
use Codedge\Fpdf\Fpdf\Fpdf;



$fpdf = new Fpdf('L');
$fpdf->AddPage();
$fpdf->setFillColor(222, 222, 222);

$number_of_teachers = count($Classes_month);
$fpdf->Rect(10,5, 282, 195);
$fpdf->Rect(18,32, 270, 100);

    $fpdf->Image('images/logo.jpg',20,10,40,20);

    $fpdf->AddFont('Times');
    $fpdf->SetFont('Times', 'B', 18);
    $fpdf->SetY(18);
	$fpdf->SetX(120);
    $fpdf->Cell(0,5,'-Reporte Quincenal-',0,1,'L');

    $fpdf->SetFont('Times', 'B', 14);
    $fpdf->SetY(35);
	$fpdf->SetX(20);
    $fpdf->Cell(0,5,'Nombre del Profesor:',0,1,'L');

    $fpdf->SetFont('Times', 'B', 12);
    $fpdf->SetY(35);
	$fpdf->SetX(120);
    $fpdf->Cell(0,5,'Clases asignadas:',0,1,'L');

    $fpdf->SetFont('Times', 'B', 12);
    $fpdf->SetY(35);
	$fpdf->SetX(160);
    $fpdf->Cell(0,5,'Clases impartidas:',0,1,'L');

    $fpdf->SetFont('Times', 'B', 12);
    $fpdf->SetY(35);
	$fpdf->SetX(200);
    $fpdf->Cell(0,5,'Clases Porcentuales:',0,1,'L');


    $fpdf->SetFont('Times', 'B', 11);
    $fpdf->SetY(35);
	$fpdf->SetX(245);
    $fpdf->Cell(0,5,'Pago:',0,1,'L');

   
        $i=45;
        foreach ($Classes_month as $teacher ) {
            # code...
        $fpdf->SetFont('Arial', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(25);
        $fpdf->Cell(0,7, $teacher[0]->name,0,1,'L',1);

        $fpdf->SetFont('Arial', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(125);
        $fpdf->Cell(0,5, $teacher[0]->number,0,1,'L',1);
        


        $fpdf->SetFont('Arial', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(165);
        $fpdf->Cell(0,5, $teacher[1]->total_classes,0,1,'L');
        

        $fpdf->SetFont('Arial', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(205);
        $fpdf->Cell(0,5, $teacher[2]->pendientes,0,1,'L');


        $fpdf->SetFont('Arial', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(245);
        $pago_porcentual=($teacher[1]->pago_hora*0.8)*$teacher[2]->pendientes;
        $pago_total=$teacher[1]->pago_hora *$teacher[1]->total_classes;
        $pago_total+=$pago_porcentual;
        $fpdf->Cell(0,5, '$'.$pago_total,0,1,'L');

        $i+=10;
        }

     



    
   
    

    $fpdf->Output('D','ReporteQuincenal.pdf');
    // $fpdf->Output();
    exit;
?>