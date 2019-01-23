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
                if(isset($_POST["siguiente"]) && $_POST["opcionZona"]!="selecciona"){
                   
                   $_SESSION['zona']=$_POST["opcionZona"];
                   
                    header ("Location:paso3.php");
               }else{
                   
                       if(isset($_POST["siguiente"]) && $_POST["opcionZona"]=="selecciona" || !isset($_POST["siguiente"])){
            
                        ?>
                        <h2>Búsqueda de vivienda</h2>
                        <p>1.Tipo > <strong>2.Zona</strong> > 3.Caracteristicas > 4.Extras</p>
                        <p><i>Paso 2:Elija la zona de vivienda</i></p>
                        <FORM ACTION="paso2.php" METHOD="POST"  ENCTYPE="multipart/form-data">
                            <table>
                                
                            <tr>
                                <td>Zona:</td>
                                <!--hago un select en el que guarde las opciones de zona-->
                                <td><SELECT NAME="opcionZona">
                                <?php
                                //recojo el valor del tipo de zona seleccionado anteriormente-->
                                    
                            if(isset($_SESSION['zona'])){
                                $opcionZona = $_SESSION['zona'];
                            }else{
                                $opcionZona="selecciona";
                            }
                                ?>
                                 <?php
                                    // Obtener los valores del tipo enumerado
                                        print ("<OPTION  selected value='selecciona'>selecciona</option>\n");
                                        $instruccion ="SHOW columns FROM viviendas LIKE 'zona'";
                                        $consulta = $conexion->query($instruccion);
                                        $row = $consulta->fetch();

                                        // Pasar los valores a una tabla
                                        $lis = strstr ($row[1], "(");
                                        $lis = ltrim
                                        ($lis, "(");
                                        $lis = rtrim ($lis, ")");
                                        $lista = explode (",", $lis);

                                        // Mostrar cada valor en un elemento OPTION

                                            $selected = $opcionZona;
                                        //for que recorre los tipos de zona 
                                        for ($i=0; $i<count($lista); $i++){
                                        $cad = trim ($lista[$i], "'");
                                        //si cad es la zona seleccionada la selecciono
                                        if ($cad == $selected)
                                            print ("<OPTION SELECTED value='$opcionZona'>" . $opcionZona . "</option>\n");
                                        else
                                            print ("<OPTION value='$cad'>" . $cad . "</option>\n");
                                        }
                                      ?>
                                </SELECT></td>
                            </tr>
                            <?php
                            if(isset($_POST["siguiente"]) && $_POST["opcionZona"]=="selecciona"){
                                echo '<span>debe elegir una opcion</span>';
                            }
                            ?>
                            <tr>
                                <td>
                                    <a href="paso1.php">ir a la pagina anterior</a>
                                <INPUT TYPE="submit" name= "siguiente" VALUE="siguiente">
                                
                                </td>
                            </tr>
                        </table>

                        </form>
                        <?php echo "Buscando ". $_SESSION['tipo'];?>
        <?php
                   }
                   
               }
           }
        ?>
    </body>
</html>
