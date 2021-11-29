


        <?php
        use Codedge\Fpdf\Fpdf\Fpdf;
        use Picqer\Barcode\BarcodeGeneratorPNG;
        $generador = new BarcodeGeneratorPNG();
        $texto = "G202111001";
        $tipo = $generador::TYPE_CODE_128;
        $imagen = $generador->getBarcode($texto, $tipo);
        $nombreArchivo = "codigo.png"; 
        $bytesEscritos = file_put_contents($nombreArchivo, $imagen);
        
        $fpdf = new Fpdf('L','cm', array(15,10));
        $fpdf->AddPage();

        $fpdf->Rect(1,1,13, 8);


        $fpdf->AddFont('Times');
        $fpdf->SetFont('Times', 'B', 18);
        $fpdf->SetY(1.5);
        $fpdf->SetX(5.2);
        $fpdf->Cell(0,1,'-Tarjeta de acceso-',0,1,'L');


        $fpdf->AddFont('Times');
        $fpdf->SetFont('Times', 'B', 12);
        $fpdf->SetY(5);
        $fpdf->SetX(9);
        $fpdf->Cell(0,1,'| G202111001 |',0,1,'L');
        $fpdf->Image('images/logo.jpg',1.3,1.3,3,2);
        $fpdf->Image('codigo.png',7,5.8,6,3);

       
            
           
            
        
        //     $fpdf->Output('D','ReporteQuincenal.pdf');
            $fpdf->Output();
            exit;
        ?>