



<?php
require_once "../config/Conexion.php";
            
            $id_registro = $_GET['id'];
            $sql_fetch_todos = "select * from tickets where id=".$_GET['id'];
            $query = mysqli_query($conexion, $sql_fetch_todos);

            
             if($datos=mysqli_fetch_array($query)){


            
include "fpdf/fpdf.php";
$pdf = new FPDF();
$pdf->AddPage();
        $pdf->SetTitle('TICKET#'.$datos['id']);
        $pdf->Image('img/cti.png', 10, 0, 40, 35); 
        $pdf->Ln(5);        
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(155,0,"                                     MESA DE SERVICIO AGAM");
        $pdf->SetTextColor(196,54,18);
        $pdf->Cell(0,0,iconv('utf-8', 'ISO-8859-1',"TICKET # ".$datos['id']));                 
        $pdf->Ln(5);
        $pdf->Cell(155,0," ");
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(0,0,date('d/m/Y'),0,1,'L');
        $pdf->Ln(10);
        $pdf->Cell(5,0," ");

        $pdf->MultiCell(100,5,iconv('utf-8', 'ISO-8859-1',"Creado: ".$datos['fecha']." a las ".$datos['hora']." hrs"),1,1,0);
                  
                 
        $pdf->Cell(5,0," ");
        $pdf->MultiCell(100,5,iconv('utf-8', 'ISO-8859-1',"Generó: CTI"),1,1,0);    
               
        $pdf->Cell(5,0," ");
        $pdf->MultiCell(100,5,iconv('utf-8', 'ISO-8859-1',"Asignó : ".$datos['tipo']),1,1,0); 


        $pdf->Cell(5,0," ");
        $pdf->MultiCell(180,10,iconv('utf-8', 'ISO-8859-1',"Impreso por : ".$datos['responsable']),1,1,0);    
                 
        $pdf->Cell(5,0," ");
        $pdf->MultiCell(180,10,iconv('utf-8', 'ISO-8859-1',"Para el área : ".$datos['area_solicitante']),1,1,0);             
 
                 
        $pdf->Cell(5,0," ");
        $pdf->MultiCell(180,10,iconv('utf-8', 'ISO-8859-1',"Concepto : ".$datos['problema']),1,1,0);

        $pdf->Cell(5,0," ");
        $pdf->MultiCell(180,10,iconv('utf-8', 'ISO-8859-1',"Comentarios : ".$datos['observaciones']),1,1,0);  


        $pdf->Cell(5,0," ");
        $pdf->MultiCell(180,40,iconv('utf-8', 'ISO-8859-1',"Observacónes del técnico: "),1,1,0);  


        $pdf->Ln(10);                                  
        $pdf->Cell(5,0," ");
        $pdf->Cell(0,0,iconv('utf-8', 'ISO-8859-1',"ENCUESTA DE SATISFACCIÓN DE SERVICIO")); 
                 

                 

        $pdf->Ln(10);        
        $pdf->Cell(5,0," ");                                  
        $pdf->Cell(0,0,iconv('utf-8', 'ISO-8859-1',"2.- ¿Que tan satisfecho está con el servicio técnico que se le brindó?"));  

        $pdf->Ln(10);        
        $pdf->Cell(20,0," ");                                  
        $pdf->Cell(0,0,iconv('utf-8', 'ISO-8859-1',"Encierre un número en donde 1 es insatisfecho y 10 es satisfecho"));  


        $pdf->Ln(10);        
        $pdf->Cell(20,0," ");                                  
        $pdf->Cell(0,0,iconv('utf-8', 'ISO-8859-1',"1           2          3          4          5          6          7          8          9          10"));                 
        $pdf->Ln(10);        
        $pdf->Cell(5,0," ");                                  
        $pdf->Cell(0,0,iconv('utf-8', 'ISO-8859-1',"3.- ¿Su requerimiento fué solucionado?"));  

        $pdf->Ln(10);        
        $pdf->Cell(50,0," ");                                  
        $pdf->Cell(0,0,iconv('utf-8', 'ISO-8859-1',"Por favor encierre la respuesta"));  



        $pdf->Ln(10);        
        $pdf->Cell(40,0," ");                                  
        $pdf->Cell(0,0,iconv('utf-8', 'ISO-8859-1',"          SI                              NO     ¿por que?:"));     


        $pdf->Ln(20);        
        $pdf->Cell(50,0," ");                                  
        $pdf->Cell(0,0,iconv('utf-8', 'ISO-8859-1',"____________________________"));        


        $pdf->Ln(5);        
        $pdf->Cell(50,0," ");                                  
        $pdf->Cell(0,0,iconv('utf-8', 'ISO-8859-1',"          Firma de conformidad"));       

        $pdf->Ln(20);        
        $pdf->Cell(5,0," ");                                  
        $pdf->Cell(0,0,iconv('utf-8', 'ISO-8859-1',"Nota: quejas o sugerencias referentes al servicio prestado a la extensión 6113"));                         
  


                 
                   
                 
                 
                 
                 
        
        

      

$pdf->output();

             }

?>

