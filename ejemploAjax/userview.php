<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8"/>
	</head>
	<body>		
		<section id="content"><h1>GET JSON DATA FROM PHP AND MYSQL USING AJAX</h1><hr/> </section>
                
		<script src="http://localhost/sikronk/assets/plugins/jquery/jquery.min.js"></script>
		<script>
			function calcular_total() {
				loadData();
			};	
			
                        
                        
			var loadData = function(){
				$.ajax({
					type:"POST",
					url:"Users.php"
                                        
				}).done(function(data){
					console.log(data);
					var users = JSON.parse(data);
					for(var i in users){
						$("#content").append(users[ i ].mail + " " + users[ i ].nombre + "<br>");
					}
				});
			}
                        
                        
                        
                        
                        var insertar = function(){
                                var parametros = {
                                "id_viaje" : "1",
                                "id_pago" : "1",
                                "monto_viaje" : "4500",
                                "monto_pagado" : "4500"
                                };
                            
				$.ajax({
					type:"POST",
					data:  parametros,
                                        url:"http://localhost/sikronk/index.php/procesaPago/asignarPago",                                        
				}).done(function(data){
                                        console.log(data);
					alert(data);
				});
			}
			
		</script>
                
                <input type="button" value="Calcular" onclick="calcular_total()"/>
                <input type="button" value="Insertar" onclick="insertar()"/>
	</body>
</html>