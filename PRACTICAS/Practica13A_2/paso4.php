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
                $conexion = new PDO("mysql:host=localhost;dbname=lindavista", "alumno", "velazquez");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                $error1 = $e->getCode();
                $mensaje = $e->getMessage();
            }
            if (isset($error1)) {
                print("Se ha producido un error en la conexion");
            }else{
                $tipo = $_SESSION['tipo'];
                $zona = $_SESSION['zona'];
                $dormitorios = $_SESSION['dormitorios'];
                $precio = $_SESSION['precio'];
                $min = $_SESSION['min'];
                $max = $_SESSION['max'];
                if(isset($_POST["finalizar"])){
                   $extras = $_POST['extras'];
                   
                   $n = count ($extras);
                    if ($n > 0)
                    {
                    $ex = $extras[0];
                    for ($i=1; $i<$n; $i++)
                    $ex = $ex ."," . $extras[$i];
                    }
                    else
                    $ex = "";
                   //enviar consulta
                        $instrucciones="select * from viviendas where tipo='$tipo' and zona='$zona' and ndormitorios='$dormitorios' and precio between $min and $max  and extras='$ex'";
                        $consulta = $conexion->query($instrucciones);
                       
                        print "<h1>busqueda de viviendas</h1>";
                        print "<p>vivienda(s) encontradas(s)</p>";
                       
                        //mostrar consulta
                        $nfilas = $consulta->rowCount();
                        if($nfilas > 0){
                            print "<table width='650'>\n";
                            print "<tr>";
                            print "<th width='100'>tipo</th>\n";
                            print "<th width='100'>zona</th>\n";
                            print "<th width='100'>ndormitorios</th>\n";
                            print "<th width='100'>precio</th>\n";
                            print "<th width='100'>extras</th>\n";
                            print "</tr>\n";
                            
                            //en este for muestro los datos de la viviendas
                            for($i=0; $i<$nfilas ;$i++){
                                $resultado= $consulta->fetch();
                                print ("<tr>\n");
                                print("<td>". $resultado['tipo']."</td>");
                                print("<td>". $resultado['zona']."</td>");
                                print("<td>". $resultado['ndormitorios']."</td>");
                                print("<td>". $resultado['precio']."</td>");
                                print("<td>". $resultado['extras']."</td>");
                               
                                print ("</tr>\n");
                            }
                        print "</table>\n";
                        }else{
                            print "no se han encontrado viviendas";

                        }
               }else{
                   if(isset($_POST["atras"])){
                       
                        
                       ?>
                        
                       <?php
                   }else{
                        ?>
                        <h2>Búsqueda de vivienda</h2>
                        <p>1.Tipo > 2.Zona > 3.Caracteristicas > <strong>4.Extras</strong></p>
                        <p><i>Paso 2:Elija las caracteristicas extras de la vivienda</i></p>
                        <FORM ACTION="paso4.php" METHOD="POST"  ENCTYPE="multipart/form-data">
                            <table>
                                
                            <tr>
                                <td>Extra(marque los que procedan):</td>
                                 <td>
                                     <!-- creo un input para cada uno de las opciones de extras-->
                                  <?php
                                    if (isset($_SESSION['extras'])){
                                        $extras = $_SESSION['extras'];
                                    }else{
                                        $extras=0;
                                    }
                                  
                                  ?>
                                  <?php
                                     // Obtener los valores del tipo enumerado

                                         $instruccion ="SHOW columns FROM viviendas LIKE 'extras'";
                                         $consulta = $conexion->query($instruccion);
                                         $row =$consulta->fetch();

                                         // Pasar los valores a una tabla
                                         $lis = strstr ($row[1], "(");
                                         $lis = ltrim
                                         ($lis, "(");
                                         $lis = rtrim ($lis, ")");
                                         $lista = explode (",", $lis);


                                         $extras = explode (",", $extras);
                                         // Mostrar cada valor en un elemento OPTION
                                         

                                         for ($i=0; $i<count($lista); $i++){
                                             $cad = trim ($lista[$i], "'");
                                             
                                            print ("<input type='checkbox' name='extras[]' value='$cad' >" . $cad . "\n");
                                         } 
                                       ?>
                            </tr>
                            
                            <tr>
                                <td>
                                    <a href="paso3.php">ir a la pagina anterior</a>
                                <INPUT TYPE="submit" name= "finalizar" VALUE="finalizar">
                                
                                </td>
                            </tr>
                        </table>

                        </form>
                        <?php echo "Buscando ". $_SESSION['tipo'].", ".$_SESSION['zona'].", con ".$_SESSION['dormitorios']." dormitorios y un precio ".$_SESSION['precio'];?>
        <?php
        
                    
                   }
                }
            }
        ?>
    </body>
</html>
