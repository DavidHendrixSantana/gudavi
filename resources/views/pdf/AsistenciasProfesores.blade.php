<?php
    use Codedge\Fpdf\Fpdf\Fpdf;
    use App\Models\MonthAsi;


    $fpdf = new Fpdf('L','pt','Legal');
    $fpdf->AddPage();
    $fpdf->AddFont('helvetica');
    $fpdf->SetFont('helvetica', 'B', 18);
    $fpdf->SetY(15);
	$fpdf->SetX(400);
    $fpdf->Cell(0,5,'- Asistencias Mensuales-',0,1,'L');
    $fpdf->SetFont('helvetica', 'B',12);
    $fpdf->setFillColor(222, 222, 222);



    $fpdf->SetY(18);
    $fpdf->SetX(10);
    $fpdf->cell(0,5, 'Profesor', 0,1,'L');

    
    $fpdf->SetY(18);
    $fpdf->SetX(130);
    $fpdf->cell(0,5, 'Dias', 0,1,'L');

    $fpdf->SetFont('helvetica', 'B',14);
    
    $y = 60;
    $x = 35;
    foreach($Teachers as $teacher){
        $x = 10;
        $fpdf->SetY($y);
        $fpdf->SetX($x);
        $fpdf->SetFont('helvetica', 'B',12);
        $fpdf->cell(0,35, $teacher->nombre, 0,1,'L',1);

        $TeacherAsis= MonthAsi::where('teacher_id', $teacher->id)->get();
        $cont = 0;
        foreach ($TeacherAsis as $asis ) {
            if($cont == 0){
            $x+=80;
            }
            $x+=30;
            $cont++;
            $fpdf->SetY($y +5);
            $fpdf->SetX($x);
            $fpdf->SetFont('helvetica', 'B',8);
            $w= $y;
            $w+=17;
            $fpdf->cell(0,5, $asis->day, 0,1,'L');
            $fpdf->SetY($w);
            $fpdf->SetX($x);
            $fpdf->cell(0,5,  substr($asis->hour, 0, 5), 0,1,'L');
            
        }
        $y+=40;

    }



    $fpdf->Output();
    exit;
    ?>