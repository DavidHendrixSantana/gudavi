<?php
use Codedge\Fpdf\Fpdf\Fpdf;

$fpdf = new Fpdf('L');
$fpdf->AddPage();
$fpdf->setFillColor(222, 222, 222);

$fpdf->Rect(10,5, 282, 195);
$fpdf->Rect(18,32, 270, 100);

    $fpdf->Image('images/logo.jpg',20,10,40,20);

    $fpdf->AddFont('Times');
    $fpdf->SetFont('Times', 'B', 18);
    $fpdf->SetY(18);
	$fpdf->SetX(120);
    $fpdf->Cell(0,5,'-Reporte Pagos de Estudiantes-',0,1,'L');

    $fpdf->SetFont('Times', 'B', 12);
    $fpdf->SetY(35);
	$fpdf->SetX(20);
    $fpdf->Cell(0,5,'Nombre de la persona:',0,1,'L');

    $fpdf->SetFont('Times', 'B', 12);
    $fpdf->SetY(35);
	$fpdf->SetX(120);
    $fpdf->Cell(0,5,'Forma de pago:',0,1,'L');

    $fpdf->SetFont('Times', 'B', 12);
    $fpdf->SetY(35);
	$fpdf->SetX(160);
    $fpdf->Cell(0,5,'Cantidad:',0,1,'L');

    $fpdf->SetFont('Times', 'B', 12);
    $fpdf->SetY(35);
	$fpdf->SetX(190);
    $fpdf->Cell(0,5,'Fecha:',0,1,'L');


    $fpdf->SetFont('Times', 'B', 11);
    $fpdf->SetY(35);
	$fpdf->SetX(220);
    $fpdf->Cell(0,5,'Tarjeta:',0,1,'L');


    $fpdf->SetFont('Times', 'B', 11);
    $fpdf->SetY(35);
	$fpdf->SetX(250);
    $fpdf->Cell(0,5,'Folio:',0,1,'L');

   
        $i=45;
        $total=0;
        $val=true;
        $cont=0;
        foreach($Consult as $person ) {
        $cont++;
            if ($cont%2==0){
        $val=false;
                
            }else{
                $val=true;
            }
                        
        $fpdf->AddFont('Times');
        $fpdf->SetFont('Times', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(20);
        $fpdf->Cell(0,6,$person->nombre,0,1,'L',$val);


        $fpdf->AddFont('Times');
        $fpdf->SetFont('Times', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(120);
        $fpdf->Cell(0,5,$person->forma_pago,0,1,'L');


        $fpdf->AddFont('Times');
        $fpdf->SetFont('Times', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(160);
        $fpdf->Cell(0,5,$person->cantidad,0,1,'L');
        $total+=$person->cantidad;


        $fpdf->AddFont('Times');
        $fpdf->SetFont('Times', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(190);
        $fpdf->Cell(0,5,$person->fecha_pago,0,1,'L');


        $fpdf->AddFont('Times');
        $fpdf->SetFont('Times', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(220);
        $fpdf->Cell(0,5,$person->tipo_tarjeta,0,1,'L');

        
        $fpdf->AddFont('Times');
        $fpdf->SetFont('Times', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(250);
        $fpdf->Cell(0,5,$person->folio,0,1,'L');

        $i+=10;

        }
  
     
     



    
   
    

    // $fpdf->Output('D','ReporteQuincenal.pdf');
    $fpdf->Output();
    exit;
?>