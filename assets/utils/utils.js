function calcularCantidadPallets(cantidadBultos, basePallet, alturaPallet, inputtext){
	
        bultosXPallet = basePallet*alturaPallet;
	cantPallets = cantidadBultos/bultosXPallet;
        $(inputtext).val(Math.ceil(cantPallets));
}  

function calcularCantidadBultos(cantidadPallets, basePallet, alturaPallet, inputtext){
	
        bultosXPallet = basePallet*alturaPallet;
	cantBultos = cantidadPallets * bultosXPallet;
        $(inputtext).val(Math.ceil(cantBultos));
}

function calcularCantidadBultos2(nroLineaAgregada, idVL, producto, nomCampoBultos, cantidadPallets, basePallet, alturaPallet, inputtext){
	
        bultosXPallet = basePallet*alturaPallet;
	cantBultos = cantidadPallets * bultosXPallet;
        $(inputtext).val(Math.ceil(cantBultos));
        
        validarBultos(nroLineaAgregada, idVL, producto, nomCampoBultos, basePallet, alturaPallet, inputtext);
        
}

function validarBultos(nroLineaAgregada, idVL, producto, nomCampoBultos, basePallet, alturaPallet,  input){
 
        bultosTotal = 0
        bulosLinea = 0;
        
        cantidadBultosProducto = $(nomCampoBultos).val();
        
	$(".cantidad_bultos_"+idVL).each(
		function(index, value) {
                        
                    if (!$(this).val())
                        bultosLinea = 0;
                    else
                        bultosLinea = eval($(this).val());
                    
                    bultosTotal = bultosTotal + bultosLinea;
		}
	);

	if (bultosTotal > cantidadBultosProducto)
        {
            swal("Oops...","La cantidad de bultos a repartir del producto "+producto+" no puede superar los "+cantidadBultosProducto+" bultos. Usted ingreso "+bultosTotal+" bultos", "error");
            input.value = 0;
            input.style.backgroundColor = "yellow";    
            input.focus();
            //input.style.background='#DF0101';"
        }
        else
        {
            calcularCantidadPallets(input.value, basePallet, alturaPallet, "input#cantPallets_"+nroLineaAgregada);
            input.style.backgroundColor = "white";    
            
            actualizarBultosRestantes (idVL, cantidadBultosProducto);
                  
        }
       
}

function actualizarBultosRestantes(idVL, cantidadBultosProducto){
 
        bultosTotal = 0
        bulosLinea = 0;
	$(".cantidad_bultos_"+idVL).each(
		function(index, value) {
                        
                    if (!$(this).val())
                        bultosLinea = 0;
                    else
                        bultosLinea = eval($(this).val());
                    
                    bultosTotal = bultosTotal + bultosLinea;
		}
	);
	
        bultosRestantes =  cantidadBultosProducto - bultosTotal;
        $("#tdBultos_"+idVL).html(cantidadBultosProducto + " (" + (bultosRestantes) + ") restantes");
        
       
}

function imprimir()
{
    alert('Gonzalo');
}



function marcarInputConError(inputtext)
{
    $(inputtext).css({background:"#FF0000"})    
    
    $(inputtext).focus();
}

function limpiarInputConError(inputtext)
{
    $(inputtext).css({background:"#FFFFFF"})    
}

