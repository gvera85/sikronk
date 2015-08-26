<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Consultas Ajax con jQuery</title>
    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/jquery-ui-git.js"/>
    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/jquery-ui-git.css"/>
</head>
<body>
    <div class="page">
        <div class="content">
            <h1>Consultas Ajax con jQuery</h1>
            <hr />
            <p class="description">Este es un ejemplo pr&amp;aacute;ctico del mecanismo para consultas Ajax en jQuery.</p>
            <p>Por favor, especifica una c&amp;eacute;dula:</p>
            <table>
                <tr>
                    <td>Materia:</td>
                    <td><input id="txtCedula" type="text" size="50" required /></td>
                </tr>
            </table>
            <table id="tblAlumnos">
                <tr>
                    <th class='id'>Registro</th>
                    <th class='nombre'>Nombre</th>
                    <th class='numerico'>Edad</th>
                    <th class='numerico'>Grado</th>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
 
    // esta rutina se ejecuta cuando jquery esta listo para trabajar
    $(function() 
    {
        // configuramos el control para realizar la busqueda de cedulas
        $("#txtCedula").autocomplete({
            source: "buscar.php", /* el que realiza la búsqueda */
            minLength: 1, /* basta con escribir una letra */
            select: registroSeleccionado,
            focus: registroMarcado
        }).focus();
    });
    
    // tras seleccionar un registro, 
    // recuperamos la lista de los alumnos inscritos
    function registroSeleccionado(event, ui)
    {
        var registro = ui.item.value;   
        // el servidor nos proporciona los siguientes datos:
        // cedula : {
        //   id : numérico,
        //   descripcion: texto
        // }

        // no quiero que jquery maneje el texto del control porque 
        // no puede manejar objetos, así que escribimos los datos 
        // nosotros y cancelamos el evento (intenta comentando este 
        // código para ver a que me refiero)
        $("#txtCedula").val(registro.descripcion);
        event.preventDefault();

        // ahora recuperamos los registros de los alumnos 
        // inscritos bajo esta cédula
        recuperarAlumnos(registro);
    }
    
    // recupera la lista de los alumnos inscritos a la cedula
    function recuperarAlumnos(cedula)
    {
        try
        {
            // preparamos el registro con las instrucciones que
            // enviaremos al servidor en este ejemplo practico,
            // utilizaremos una variable de nombre "task" para 
            // indicar al servidor lo que queremos hacer, así
            // como una variable "cedula" en donde colocaremos 
            // el ID de la cedula para la cual deseamos recuperar
            // la lista de alumnos
            var data = "tarea=1&cedula=" + cedula.id;
            $.ajax(
                {
                    // puede ser "get" y "post"
                    type: "post",
                    // el módulo que hará la búsqueda
                    url: "alumnos.php",
                    // los datos para la consulta
                    data: data,
                    // este no viaja al servidor
                    context : { "cedula" : cedula },
                    // que hacer si esto falla
                    error: callback_error,
                    // que hacer si funciona 
                    success: recuperarAlumnos_callback
                });
        }
        catch(ex)
        {
            alert(ex.description);
        }
    }
    
    // mostramos un mensaje con la causa del problema
    function callback_error(XMLHttpRequest, textStatus, errorThrown)
    {
        // en ambientes serios esto debe manejarse con mucho cuidado, 
        // aquí optamos por una solución simple
        alert(errorThrown);
    }
    
    // recuperamos la informacion que nos ha enviado el servidor
    function procesarRespuesta(ajaxResponse)
    { 
        // observa que aquí asumimos que el resultado es un objeto 
        // serializado en JSON, razón por la cual tomamos este dato
        // y lo procesamos para recuperar un objeto que podamos
        // manejar fácilmente
        if (typeof ajaxResponse == "string")
            ajaxResponse = $.parseJSON(ajaxResponse);
        return ajaxResponse;
    }
    
    // recupera la informacion de los alumnos inscritos a esta cédula
    function recuperarAlumnos_callback(ajaxResponse, textStatus)
    {
        var alumnos = procesarRespuesta(ajaxResponse);
        if (!alumnos)
        {
            // no se encontraron registros :(
            return;
        }

        // recupera la instancia de la tabla en donde colocaremos los 
        // registros que recuperamos y elimina todos salvo el primero, 
        // que es donde se encuentra el encabezado de la tabla
        var $tabla = $("#tblAlumnos");
        $tabla.find("tr:gt(0)").remove();

        // ahora, para cada registro que recuperamos
        var alumno;
        for (var idx in alumnos)
        {
            alumno = alumnos[idx];
            $tabla.append(
                "<tr><td class='id'>" + alumno.id + 
                "</td><td class='nombre'>" + alumno.nombre + 
                "</td><td class='numerico'>" + alumno.edad + 
                "</td><td class='numerico'>" + alumno.grado + 
                "</td></tr>"); 
        } 
    }
    
    / la estructura que utilizaremos es bastante simple:
    //   identificador de la cédula : registros de alumno
    // en donde:
    //   registro de alumno : id del registro, nombre, edad, grado
    $registros = array(
        "1" => 
            array(
                array(100, "Pedro Páramo", 18, 1),
                array(115, "Gilberto Pérez", 19, 2),
                array(200, "Ángel González", 18, 1)
                ),
        "2" => 
            array(
                array(100, "Pedro Páramo", 18, 1),
                array(100, "Ángel González", 18, 1),
                array(100, "Roberto Menéndez", 17, 1),
                array(100, "Juan Castro", 20, 3)
                ),
        "3" =>
            array(
                array(100, "Ángel González", 18, 1)
                )
        );
    
    // valida que se haya especificado una tarea
    if (!isset( $_POST['tarea'])) 
    {
        print false;
        exit;
    }

    $tarea = $_POST['tarea']; 
    switch($tarea)
    {
        case '1':   // recuperar los registros del catalogo
                obtenerRegistros();
                break;

        default:
                print false;
    }
    
    function obtenerRegistros()
    { 
        global $registros;
        $cedula = $_POST['cedula'];

        if (isset($registros[$cedula]))
        {
            // es mucho mas sencillo manejar el codificador JSON que viene 
            // con PHP, tendríamos que colocar algo como lo siguiente:
            // print json_encode($registros[$cedula]); 

            // pero como soy de la idea que tienes que entender como 
            // funcionan las cosas para poder mejorar todo lo que sabes, 
            // aquí les va la versión con cincel y piedra:
            $contador = 0;
            $alumnos = $registros[$cedula];

            // iniciamos el resultado indicando que es un arreglo
            print '[';
            // y para cada alumno encontrado
            foreach ($alumnos as $alumno) 
            {
                // agregamos esta línea porque cada elemento 
                // debe estar separado por una coma
                if ($contador++ > 0) print ", "; 
                print "{ \"id\" : $alumno[0], \"nombre\" : \"$alumno[1]\", \"edad\" : $alumno[2], \"grado\" : $alumno[3] }";
            }
            // con esto termina el arreglo
            print ']';
        }
        else
            print false;
    }
 
    </script>
</body>
</html>