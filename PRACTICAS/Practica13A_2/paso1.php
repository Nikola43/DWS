<?php
    session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <style>
            h1{
                color : #3E78E1;
            }
            table{
                padding: 10px;
                border :#3E78E1 2px dashed;
            }
            
            span{
                color: red;
            }
    </style>
    <body>
        
        <?php
        // Conectar con el servidor de base de datos
            try {
                $conexion = new PDO("mysql:host=localhost;dbname=lindavista", "root", "paulo1994");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                $error1 = $e->getCode();
                $mensaje = $e->getMessage();
            }
            if (isset($error1)) {
                print("Se ha producido un error en la conexion");
            }else{
                
                
               if(isset($_POST["siguiente"]) && $_POST["opcionViviendas"]!="selecciona"){
                   
                   $_SESSION['tipo']=$_POST["opcionViviendas"];
                   
                    header ("Location:paso2.php");
               }else{
                   if(isset($_POST["siguiente"]) && $_POST["opcionViviendas"]=="selecciona" || !isset($_POST["siguiente"])){
                       
                    ?>

                    <h2>Búsqueda de vivienda</h2>
                    <p><strong>1.Tipo</strong> > 2.Zona > 3.Caracteristicas > 4.Extras</p>
                    <p><i>Paso 1:Elija el tipo de vivienda</i></p>
                    <FORM ACTION="paso1.php" METHOD="POST"  ENCTYPE="multipart/form-data">
                        <table>
                        <tr>

                            <td>Tipo de viviendas </td>
                          
                            <td><SELECT NAME="opcionViviendas">
                            <?php
                            //recojo el valor del tipo de viviendasseleccionado anteriormente-->
                            if(isset($_SESSION['tipo'])){
                                $opcionViviendas = $_SESSION['tipo'];
                            }else{
                                $opcionViviendas="selecciona";
                            }

                                // Obtener los valores del tipo enumerado
                                    print ("<OPTION  selected value='selecciona'>selecciona</option>\n");
                                    $instruccion ="SHOW columns FROM viviendas LIKE 'tipo'";
                                    $consulta = $conexion->query($instruccion);
                                    $row = $consulta->fetch();

                                    // Pasar los valores a una tabla
                                    $lis = strstr ($row[1], "(");
                                    $lis = ltrim
                                    ($lis, "(");
                                    $lis = rtrim ($lis, ")");
                                    $lista = explode (",", $lis);

                                    // Mostrar cada valor en un elemento OPTION

                                    $selected = $opcionViviendas;

                                    //for que recorre todos los tipos de viviendas
                                    for ($i=0; $i<count($lista); $i++){
                                    $cad = trim ($lista[$i], "'");
                                    //si cad es la viviendas eleccionada la selecciono
                                    if ($cad == $selected)
                                        print ("<OPTION SELECTED value='$opcionViviendas'>" . $opcionViviendas . "</option>\n");
                                    else
                                        print ("<OPTION value='$cad'>" . $cad . "</option>\n");
                                    }
                                  ?>
                                </SELECT>
                            </td>
                            
                        </tr>
                        <?php
                        if(isset($_POST["siguiente"]) && $_POST["opcionViviendas"]=="selecciona"){
                            echo '<span>debe elegir una opcion</span>';
                        }
                        ?>
                        <tr>
                            <td>
                            <INPUT TYPE="submit" name= "siguiente" VALUE="siguiente" >
                            </td>
                        </tr>
                    </table>

                    </form>
        <?php
                   }
                   
               }
           }
        ?>
    </body>
</html>
