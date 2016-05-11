<?php 
require "vendor/autoload.php";
ini_set('date.timezone', 'America/Argentina/Buenos_Aires');
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class generarPDFConf extends CI_Controller {
 
    public function pdf2($p_idViaje)
    {
        ini_set('date.timezone', 'America/Argentina/Buenos_Aires');
        // Se carga el modelo alumno
        $this->load->model('viaje_m');
        $this->load->model('cliente_m');
        $this->load->model('reporte_ventas_m');
        // Se carga la libreria fpdf
        $this->load->library('pdf');
 
        // Se obtienen los alumnos de la base de datos        
        $resumenViaje = $this->reporte_ventas_m->getResumenViaje($p_idViaje);
        $lineasViaje = $this->viaje_m->getLineasViaje($p_idViaje);
        $lineasReparto = $this->viaje_m->getRepartoConfirmado($p_idViaje, null);
        
        foreach( $resumenViaje as $resumen ) : 
            $idViaje = $resumen['id'];
            $nroViaje = $resumen['numero_de_viaje'];
            $fechaSalida = date_format(date_create($resumen['fecha_estimada_salida']), 'd/m/Y');
            $valorMercaderia = $resumen['valor_mercaderia'];
            $valorMercaderiaProveedor = $resumen['valor_mercaderia_proveedor'];
            $valorGastosProveedor = $resumen['valor_gastos_proveedor'];
            $valorGastosDistribuidor = $resumen['valor_gastos_distribuidor'];
            $valorAPagarAlProveedor = $valorMercaderiaProveedor - $valorGastosProveedor;
        endforeach; 
 
        // Creacion del PDF
 
        /*
         * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
         * heredó todos las variables y métodos de fpdf
         */
        $this->pdf = new Pdf();
        // Agregamos una página
        $this->pdf->AddPage();
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();
 
        /* Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */
        $this->pdf->SetTitle("Resumen de viaje");
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFillColor(200,200,200);
 
        // Se define el formato de fuente: Arial, negritas, tamaño 9
        $this->pdf->SetFont('Arial', 'B', 9);
        /*
         * TITULOS DE COLUMNAS
         *
         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
         */
 
        $this->pdf->Cell(15,5,'ID','TBLR',0,'C','1');
        $this->pdf->Cell(15,5,$idViaje,'TBLR',0,'C','0');
        $this->pdf->Cell(20,5,'Nro. Viaje','TBLR',0,'C','1');
        $this->pdf->Cell(15,5,$nroViaje,'TBLR',0,'C','0');
        $this->pdf->Cell(15,5,'Fecha','TBLR',0,'C','1');
        $this->pdf->Cell(20,5,$fechaSalida,'TBLR',0,'C','0');
        
        $this->pdf->Ln(5);
        
        $this->pdf->Cell(85,5,'Valor total de la mercaderia cobrada a los clientes','TBLR',0,'L','1');
        $this->pdf->Cell(15,5,$valorMercaderia,'TBLR',0,'C','0');
        $this->pdf->Ln(5);
        
        $this->pdf->Cell(85,5,'Valor total de la mercaderia adeudada al proveedor','TBLR',0,'L','1');
        $this->pdf->Cell(15,5,$valorMercaderiaProveedor,'TBLR',0,'C','0');
        $this->pdf->Ln(5);
        
        $this->pdf->Cell(85,5,'Valor total de los gastos a cargo del proveedor','TBLR',0,'L','1');
        $this->pdf->Cell(15,5,$valorGastosProveedor,'TBLR',0,'C','0');
        $this->pdf->Ln(5);
        
        $this->pdf->Cell(85,5,'Valor total de los gastos a cargo del distribuidor','TBLR',0,'L','1');
        $this->pdf->Cell(15,5,$valorGastosDistribuidor,'TBLR',0,'C','0');
        $this->pdf->Ln(5);
        
        $this->pdf->Cell(85,5,'Valor total a abonar al proveedor','TBLR',0,'L','1');
        $this->pdf->Cell(15,5,$valorAPagarAlProveedor,'TBLR',0,'C','0');
        $this->pdf->Ln(5);
        
        $this->pdf->Ln(5);
        $this->pdf->Cell(140,5,utf8_decode('Reparto de mercadería'),'TBLR',0,'L','1');
        $this->pdf->Ln(7);
        
        foreach( $lineasViaje as $lineas ) :
            $this->pdf->Cell(30,5,$lineas['producto'],'TBLR',0,'C','2');
            $this->pdf->Cell(50,5,$lineas['codigo_vl']." - ".$lineas['vl']." - ".$lineas['peso']. "[KG] - Pallet:".$lineas['base_pallet']."x".$lineas['altura_pallet'],'TBLR',0,'C','0');
        
            
        
            $this->pdf->Ln(5);
            foreach( $lineasReparto as $reparto ) :
                    $this->pdf->Cell(15,5,$reparto['cantidad_pallets'],'TBLR',0,'C','0');
                    $this->pdf->Ln(5);
            endforeach;
        endforeach;
        
        
        
        
        
        /*
        
        
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;
        foreach ($alumnos as $alumno) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15,5,$x++,'BL',0,'C',0);
            // Se imprimen los datos de cada alumno
            $this->pdf->Cell(25,5,$alumno['tipo'],'B',0,'L',0);
            $this->pdf->Cell(25,5,$alumno['fecha_pago'],'B',0,'L',0);
            $this->pdf->Cell(25,5,$alumno['razon_social'],'B',0,'L',0);
            $this->pdf->Cell(40,5,$alumno['descripcion'],'B',0,'C',0);
            $this->pdf->Cell(25,5,$alumno['debe'],'B',0,'L',0);
            $this->pdf->Cell(25,5,$alumno['haber'],'BR',0,'C',0);
            //Se agrega un salto de linea
            $this->pdf->Ln(5);
        }
         * */
         
        /*
         * Se manda el pdf al navegador
         *
         * $this->pdf->Output(nombredelarchivo, destino);
         *
         * I = Muestra el pdf en el navegador
         * D = Envia el pdf para descarga
         *
         */
        $this->pdf->Output("Lista de viajes.pdf", 'I');
    }
    
    
    function comprobanteViaje($idViaje, $modo)
    {          
        $this->load->model('viaje_m');
        $this->load->model('cliente_m');
        $this->load->model('reporte_ventas_m');

        $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
        $lineasReparto = $this->viaje_m->getRepartoConfirmadoParaPDF($idViaje, null);
        $clientes = $this->cliente_m->getClientes();
        $resumenViaje = $this->reporte_ventas_m->getResumenViaje($idViaje);
        $lineasGastos = $this->reporte_ventas_m->getGastos($idViaje);    
        $cabeceraProveedor = $this->viaje_m->getCabeceraViajePDF($idViaje);
        

        $data['resumenViaje'] = $resumenViaje;    
        $data['lineasViaje'] = $lineasViaje;
        $data['lineasReparto'] = $lineasReparto;
        $data['lineasGastos'] = $lineasGastos;
        $data['cabeceraProveedor'] = $cabeceraProveedor;
        

        $htmlComprobante = $this->load->view('pdf/comprobanteViaje',$data, true);
        
        if ($modo == 0)
            $this->load->view('pdf/comprobanteViaje',$data);
        
        if ($modo == 1)        
            $this->crearPDF('comprobanteViaje', 'P', 'A4', $htmlComprobante);
    }
    
    
    function crearPDF($path='',$paper_1='P',$paper_2='A4', $htmlComprobante)
    {    
        if( $htmlComprobante!='' )
        {
            ob_start();            
            
            $content = $htmlComprobante;
            
            echo '<page>'.$content.'</page>';

            //Añadimos la extensión del archivo. Si está vacío el nombre lo creamos
            $path!='' ? $path = $path.'_'.date("d-m-Y_H-i-s"). '.pdf' : $path = $this->crearNombrePDF(10);  

            $content = ob_get_clean(); 
            //require_once('html2pdf/html2pdf.class.php'); 

            //Orientación / formato del pdf y el idioma.
            $pdf = new HTML2PDF($paper_1,$paper_2,'es', array(10, 10, 10, 10) /*márgenes*/); //los márgenes también pueden definirse en <page> ver documentación

            //$content = ob_get_clean(); 
            
            $pdf->WriteHTML($content);
           
            //El pdf es creado "al vuelo", el nombre del archivo aparecerá predeterminado cuando le demos a guardar
            $pdf->Output($path); // mostrar
            //$pdf->Output('ejemplo.pdf', 'D');  //forzar descarga 
           

        }

    }

    function crearNombrePDF($length)
    {
        if( ! isset($length) or ! is_numeric($length) ) $length=6;

        $str  = "0123456789abcdefghijklmnopqrstuvwxyz";
        $path = '';

        for($i=1 ; $i<$length ; $i++)
          $path .= $str{rand(0,strlen($str)-1)};

        return $path.'_'.date("d-m-Y_H-i-s").'.pdf';    
    }
}