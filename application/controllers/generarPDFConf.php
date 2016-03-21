<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class generarPDFConf extends CI_Controller {
 
    public function resumen($p_idViaje)
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
    
    
    
    public function generarPDF($p_idViaje)
    {       
        $content = "
                    <page>
                        <h1>Exemple d'utilisation</h1>
                        <br>
                        Ceci est un <b>exemple d'utilisation</b>
                        de <a href='http://html2pdf.fr/'>HTML2PDF</a>.<br>
                    </page>";

        /*require_once(base_url().'third_party/html2pdf-4.5.1/html2pdf.class.php');*/
        
        require_once APPPATH."/third_party/html2pdf-4.5.1/html2pdf.class.php";
        
        $html2pdf = new HTML2PDF('P','A4','fr');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('exemple.pdf');
    
    }
    
    public function dopdf($idViaje){       

            $this->output->enable_profiler(false);
            $this->load->library('parser');
            require_once(APPPATH.'third_party/html2pdf-4.5.1/html2pdf.class.php');

            // set vars
            $tpl_path = 'path/to/view_tpl.php';
            $thefullpath = '/path/to/file_pdf.pdf';
            $preview = false;
            $previewpath = '/path/to/preview_pdf.pdf';


            // PDFs datas
            $datas = array(
              'first_name' => "Gonzalo",
              'last_name'  => "Vera",
              'site_title' => config_item('site_title'),
            );

            // Encode datas to utf8
            $tpl_data = array_map('utf8_encode',$datas);


            // 
            // GENERATE PDF AND SAVE FILE (OR OUTPUT)
            //

            $content = $this->CI->parser->parse($tpl_path, $tpl_data, TRUE);
            $html2pdf = new HTML2PDF('P','A4','fr', true, 'UTF-8',  array(7, 7, 10, 10));
            $html2pdf->pdf->SetAuthor($tpl_data['site_title']);
            $html2pdf->pdf->SetTitle($tpl_data['site_title']);
            $html2pdf->pdf->SetSubject($tpl_data['site_title']);
            $html2pdf->pdf->SetKeywords($tpl_data['site_title']);
            $html2pdf->pdf->SetProtection(array('print'), '');//allow only view/print
            $html2pdf->WriteHTML($content);
            if (!$preview) //save
              $html2pdf->Output($thefullpath, 'F');
            else { //save and load
              $html2pdf->Output($previewpath, 'D');
            }

        }
}