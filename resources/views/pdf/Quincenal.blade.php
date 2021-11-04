<?php
use Codedge\Fpdf\Fpdf\Fpdf;


use Picqer\Barcode\BarcodeGeneratorPNG;
$generador = new BarcodeGeneratorPNG();
$texto = "parzibyte.me";
$tipo = $generador::TYPE_CODE_128;
$imagen = $generador->getBarcode($texto, $tipo);
$nombreArchivo = "codigo.png";

$bytesEscritos = file_put_contents($nombreArchivo, $imagen);


$fpdf = new Fpdf;
$fpdf->AddPage();
$fpdf->Rect(8,8,200,80);
$number_of_teachers = count($Classes_month);




$fpdf->SetFont('Arial', 'B', 16);
    $fpdf->SetY(10);
	$fpdf->SetX(60);
    $fpdf->Cell(0,5,'-Reporte Quincenal-',0,1,'L');

    $fpdf->SetFont('Arial', 'B', 11);
    $fpdf->SetY(22);
	$fpdf->SetX(20);
    $fpdf->Cell(0,5,'Nombre del Profesor.',0,1,'L');

    $fpdf->SetFont('Arial', 'B', 11);
    $fpdf->SetY(22);
	$fpdf->SetX(80);
    $fpdf->Cell(0,5,'Hrs. asignadas.',0,1,'L');

    $fpdf->SetFont('Arial', 'B', 11);
    $fpdf->SetY(22);
	$fpdf->SetX(120);
    $fpdf->Cell(0,5,'Hrs. impartidas:.',0,1,'L');

    $fpdf->SetFont('Arial', 'B', 11);
    $fpdf->SetY(22);
	$fpdf->SetX(170);
    $fpdf->Cell(0,5,'Pago:',0,1,'L');

   
        $i=35;
        foreach ($Classes_month as $teacher ) {
            # code...
        $fpdf->SetFont('Arial', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(20);
        $fpdf->Cell(0,5, $teacher[0]->name,0,1,'L');

        $fpdf->SetFont('Arial', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(80);
        $fpdf->Cell(0,5, $teacher[0]->number,0,1,'L');
        


        $fpdf->SetFont('Arial', 'B', 11);
        $fpdf->SetY($i);
        $fpdf->SetX(120);
        $fpdf->Cell(0,5, $teacher[0]->number,0,1,'L');
        $i+=10;
        }

        $fpdf->SetFont('Arial', 'B', 11);
        $fpdf->SetY(100);
        $fpdf->SetX(120);
        $fpdf->Cell(0,5,'Valor' ,0,1,'L');


        $fpdf->Image('codigo.png',20,100,100,50);

    
   
    

    $fpdf->Output();
    exit;
?>