<?php

namespace App\Http\Traits;


use Codedge\Fpdf\Fpdf\Fpdf;

class PDFTemplate extends Fpdf
{
    function Header()
    {
        // Select Arial bold 15
        $this->SetFont('Arial', 'B', 12);
        // Move to the right
        //  $this->Cell(80);
        // Framed title
        $this->Image("img/template/imagotipo_memla_small.png",5,5,40,0,'','http://www.memla.mx');
        $this->SetY(15);
        $this->SetX(15);

        $this->SetTextColor(180,180,180);
        $this->Cell(200,10,'Methodology for Experiments with Machine Learning Algorithms',0,0,'C');
        // Line break
        $this->Ln(20);

    }

    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-20);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 7);
        // Print centered page number
        $this->Cell(0, 3, 'Page '.$this->PageNo(), 0, 0, 'C');
        //  $this->Ln(20);
        $this->SetY(-17);
        $this->cell(0, 3, utf8_decode('If memla.mx was helpful to you, feel free to cite us:'), 0, 0, 'C');
        $this->SetY(-14);
        $this->Cell(0, 3,  utf8_decode('Sánchez-DelaCruz, E., Loeza-Mejía, C.I., Pozos-Parra, P., (2023). MEMLA: Methodology for Experiments with Machine Learning Algorithms. [In process]'), 0, 0, 'C');
        $this->SetY(-11);

        //$this->MultiCell(0, 3,  utf8_decode('-Loeza-Mejía, C.I., Sánchez-DelaCruz, E., Landero-Hernández, L.A. & José-Guzmán, I.O. (2023). Three decades of challenges, perspectives, and changes in methodologies to implement machine learning projects: a systematic review. [Under review]'), 0,  'C',0);

    }
}
