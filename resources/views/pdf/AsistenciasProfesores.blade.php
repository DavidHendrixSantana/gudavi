<?php
    use Codedge\Fpdf\Fpdf\Fpdf;
    use App\Models\MonthAsi;


    $fpdf = new Fpdf('L');
    $fpdf->AddPage();
    $fpdf->AddFont('Times');
    $fpdf->SetFont('Times', 'B', 18);
    $fpdf->SetY(5);
	$fpdf->SetX(100);
    $fpdf->Cell(0,5,'- Asistencias Mensuales-',0,1,'L');
    $fpdf->SetFont('Times', 'B',12);
    $fpdf->setFillColor(222, 222, 222);



    $fpdf->SetY(18);
    $fpdf->SetX(10);
    $fpdf->cell(0,5, 'Profesor', 0,1,'L');

    
    $fpdf->SetY(18);
    $fpdf->SetX(130);
    $fpdf->cell(0,5, 'Dias', 0,1,'L');

    $fpdf->SetFont('Times', 'B',8);
    
    $y = 30;
    $x = 35;
    foreach($Teachers as $teacher){
        $x = 10;
        $fpdf->SetY($y);
        $fpdf->SetX($x);
        $fpdf->cell(0,8, $teacher->nombre, 0,1,'L',1);

        $TeacherAsis= MonthAsi::where('teacher_id', $teacher->id)->get();
        foreach ($TeacherAsis as $asis ) {
            $x+=15;
            $fpdf->SetY($y);
            $fpdf->SetX($x);
            $w= $y;
            $w+=3;
            $fpdf->cell(0,5, $asis->day, 0,1,'L');
            $fpdf->SetY($w);
            $fpdf->SetX($x);
            $fpdf->cell(0,5,  substr($asis->hour, 0, 5), 0,1,'L');
            
        }
        $y+=10;

    }



    $fpdf->Output();
    exit;
    ?>