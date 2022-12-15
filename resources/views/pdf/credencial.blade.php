        <?php
        use Codedge\Fpdf\Fpdf\Fpdf;
        use Picqer\Barcode\BarcodeGeneratorPNG;
        $generador = new BarcodeGeneratorPNG();
        $matricula = '|'.$person->matricula;
        $tipo = $generador::TYPE_CODE_128;
        $imagen = $generador->getBarcode($matricula, $tipo);
        $nombreArchivo = "codigo.png"; 
        $bytesEscritos = file_put_contents($nombreArchivo, $imagen);
       

        
        $fpdf = new Fpdf('P','cm', array(5.4, 8.6));
        $fpdf->AddPage();
        $fpdf->setFillColor(0, 174, 234);
        $fpdf->Rect(0,0, 0.5, 8.6, 'F');
        $fpdf->Rect(4.8,0, 0.7, 8.6, 'F');
        


        $fpdf->AddFont('Times');
        $fpdf->SetFont('Times', 'B', 12);
        $fpdf->SetY(0.1);
        $fpdf->SetX(1);
        $fpdf->Cell(0,1,'-Tarjeta de acceso-',0,1,'L');

        $fpdf->AddFont('Helvetica');
        $fpdf->SetFont('Helvetica', '',6);
        $fpdf->SetY(4.5);
        $fpdf->SetX(0.8);
        $fpdf->Multicell(0,0.3, $person->nombre ,0,'L');



        $fpdf->AddFont('Times');
        $fpdf->SetFont('Times', 'B', 12);
        $fpdf->SetY(5);
        $fpdf->SetX(1.2);
        $fpdf->Cell(0,1,'| ' . $matricula .' |',0,1,'L');
        $fpdf->Image('images/logo.jpg',1,1.1,3,2);
        $fpdf->Image('codigo.png',0.7,5.7,4,2);

        $fpdf->AddPage();

        $fpdf->setFillColor(0, 174, 234);
        $fpdf->Rect(4.8,0, 1, 8.6, 'F');
        $fpdf->Rect(0,8.1, 5.4, 0.1, 'F');
        $fpdf->Rect(0,8.3, 5.4, 0.3, 'F');

        $fpdf->AddFont('Times');
        $fpdf->SetFont('Times', 'B', 6);
        $fpdf->SetY(0.4);
        $fpdf->SetX(0.2);
        $fpdf->Multicell(0,0.3,"Para tener derecho a reposicion debe de cumplir con los siguientes requisitos:");
        $fpdf->SetFont('Times', '', 6);
        $fpdf->SetY(1.4);
        $fpdf->SetX(0.2);
        $fpdf->Multicell(0,0.3," 1.	Pago puntual (Realizar pago dentro de los 7 primeros dias de cada mes).
2.	Avisar dentro del tiempo establecido (Si es posible avisar 2 horas antes de su clase, de no ser asi, cuenta con 72 horas para hacerlo).
3.	Unicamente se hara reposicion de clase presentando justificante medico.
4.	La reposicion debe de ser programada dentro de los siguientes 15 dias posteriores a su falta.
5.	En caso de programar su reposicion y no asistir no se puede reprogramar (esta clase se pierde)
6.	Avisar por medio de WhatsApp para dejar constancia del aviso y que usted tenga la certeza de que se le agendo su reposicion, nuestro numero es 44 31 97 97 90.");  
           
            
        
   
                $fpdf->Output();
            // $fpdf->Output('D','Credencial.pdf');

                
        
            exit;
        ?>