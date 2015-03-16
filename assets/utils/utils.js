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

function validarBultos(nroLineaAgregada, idProducto, producto, cantidadBultosProducto, basePallet, alturaPallet,  input){
 
        bultosTotal = 0
        bulosLinea = 0;
	$(".cantidad_bultos_"+idProducto).each(
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
            alert("La cantidad de bultos a repartir del producto "+producto+" no puede superar los "+cantidadBultosProducto+" bultos. Ustede ingreso "+bultosTotal+" bultos");
            input.style.backgroundColor = "yellow";    
            input.focus();
            //input.style.background='#DF0101';"
        }
        else
        {
            calcularCantidadPallets(input.value, basePallet, alturaPallet, "input#cantPallets_"+nroLineaAgregada);
            input.style.backgroundColor = "white";    
        }
       
}

function imprimir()
{
    alert('Gonzalo');
}

