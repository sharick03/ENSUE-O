<?php
//SE INCLUYEN LOS ARCHIVOS NECESARIOS PARA LA ELABORACIÓN DEL FORMULARIO 
require('fpdf/fpdf.php');
require('../MODELOS/conexion.php');
require('../MODELOS/transaccion.php');
//CREAMOS UNA CLASE PARA PODER COLOCAR ENCABEZADO Y PIE DE PAGINA AL REPORTE
class PDF extends FPDF
{
    // Cabecera de pagina
    function Header()   
    {
        // Se inserta el logo
        $this->Image('img/Logo.png',10,8,-800);
        // Times 18 
        $this->SetFont('Times','B',18);
        // Movernos a la derecha 
        $this->Cell(60);
        // Titulo
        $this->Cell(90,10,'Reporte De Transacciones',1,0,'C');
        // Salto de linea 
        $this->Ln(20);
    }
    //Pie de página
    function Footer()
    {
        // Posicion: a 1,5 cm del final 
        $this->SetY(-15);
        // Times italic 8
        $this->SetFont('Times','I',8);
        // Numero de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C'); 
    }
}
// Instanciamos una transaccion para poder utilizar la función listar del modelo
$model = new Transaccion();
// Instanciamos un elemento de la clase PDF para usar todos sus atributos y métodos
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);
// Se crean las celdas con las que se va a trabajar para la creación del reporte como si fueran celdas de una tabla
$pdf->Cell(10);
// Se colocan los encabezados de las columnas del reporte (se pueden agregar los que se necesiten)
// Cada celda tiene dentro de la funcion Cell 
//ancho, alto, cadena a mostrar, borde, posicion de la cdelda, alineacion, fonde de celda
$pdf->Cell(35,10,utf8_decode('Id Transacción'),1,0,'C',0);  
$pdf->Cell(35,10,utf8_decode('Id Usuario'),1,0,'C',0);  
$pdf->Cell(35,10,utf8_decode('Tipo de transacción'),1,0,'C',0);  
$pdf->Cell(35,10,utf8_decode('Valor transacción'),1,0,'C',0);
$pdf->Cell(35,10,utf8_decode('Fecha transacción'),1,1,'C',0);
// invocamos la función listar para que consulte en este caso las transacciones 
$Transaccion=$model->Listar();
    if($Transaccion!=null){
        foreach($Transaccion as $r){
            //Consulta
            
                //posicion inicial de las celdas para el reporte 
                $pdf->Cell(10);
                $pdf->Cell(35,10,utf8_decode($r['id_transaccion']),1,0,'C',0);  
                $pdf->Cell(35,10,utf8_decode($r['id_usuario']),1,0,'C',0);   
                $pdf->Cell(35,10,utf8_decode($r['tipo_transaccion']),1,0,'C',0);  
                $pdf->Cell(35,10,utf8_decode($r['valor_transaccion']),1,0,'C',0);
                $pdf->Cell(35,10,utf8_decode($r['fecha']),1,1,'C',0);
                   
        }
    }
//Muestra el reporte en una ventana nueva del navegador
$pdf->Output();

?>