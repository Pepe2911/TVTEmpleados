<?php 
    require('../fpdf/fpdf.php');
    include '../Model/vacaciones.php';
    
    /*print_r($empleadoV);
    echo "<br>".$empleadoV[0][0]['diasVacaciones'];
    echo "<br> Desde: ".$empleadoV[0][0]['inicio'];
    echo "<br> Hasta:".$empleadoV[0][0]['fin'];
    echo "<br> Dias Tomados: ".$diasTomados[0]['Dias_transcurridos'];
    echo "<br> Restantes:".$restantes;
    echo "<br> Dias solicitados".dias_transcurridos($empleadoV[0][0]['inicio'],$empleadoV[0][0]['fin']);*/
    function dias_transcurridos($fecha_i,$fecha_f)
    {
        $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
        $dias 	= abs($dias); $dias = floor($dias);		
        return $dias;
    }
    class PDF extends FPDF
    {
        
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('LogoTVT.jpg',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',16);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(90,10,'SOLICITUD DE DESCANSO VACACIONAL',0,0,'C');
        // Salto de línea
        $this->Ln(40);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
    function TablaBasica($header)
   {
    $diasTomados = 0;
    $restantes = 0;
    $EmpleadoV = new vacaciones();
    $empleadoV[] = $EmpleadoV->getSolicitudesBy($_GET['c'],$_GET['a']);
    $diasTomados = $EmpleadoV->diasTomados($_GET['c']);
    if(isset($diasTomados[0]['Dias_transcurridos'])){
        $restantes = $empleadoV[0][0]['diasVacaciones'] - $diasTomados[0]['Dias_transcurridos'] ;
     }
     else{
         $diasTomados[0]['Dias_transcurridos'] = 0;
         $restantes = $empleadoV[0][0]['diasVacaciones'];
     }
     $otorgadas = dias_transcurridos($empleadoV[0][0]['inicio'],$empleadoV[0][0]['fin']) + 1;
    //Cabecera
    foreach($header as $col)
    $this->Cell(60,7,$col,1,0,'C');
    $this->Ln();
   
      $this->Cell(60,5,utf8_decode("Días"),1,0,'C');
      $this->Cell(60,5,utf8_decode("Días"),1,0,'C');
      $this->Cell(60,5,utf8_decode("Días"),1,0,'C');
      $this->Ln();
      $this->Cell(60,15,$otorgadas - $diasTomados[0]['Dias_transcurridos'],1,0,'C');
      $this->Cell(60,15,$otorgadas,1,0,'C');
      $this->Cell(60,15,$restantes,1,0,'C');
      
   }
    }

    $pdf = new PDF();
    $header=array('Saldo Anterior','Otorgadas','Saldo Actual');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(30,10,utf8_decode('Tala Jalisco '.date("d-M-Y")));
    $pdf->Ln(15);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,10,utf8_decode('Asunto: Solicitud de descanso vacacional'));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(30);
    $pdf->Cell(40,5,utf8_decode('Mediante la presente, y para que quede constancia por escrito, me dirijo a usted para solicitar'));
    $pdf->Ln();
    $pdf->Cell(40,5,utf8_decode('los dias de vacacions correpondientes a este año.'));
    $pdf->Ln();
    $pdf->Cell(40,5,utf8_decode('De acuerdo con la normativa vigente, para este período anual me corresponden: '));
    $pdf->Ln(120);
    $pdf->Cell(190,5,utf8_decode('EXCLUSIVO PARA USO INTERNO'),0,0,'C');
    $pdf->Ln();
    $pdf->TablaBasica($header);
    $pdf->Output();
?>