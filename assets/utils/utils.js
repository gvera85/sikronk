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

function imprimir(parametro){
    alert(parametro);
}


