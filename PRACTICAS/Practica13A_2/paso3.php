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
        
                $tipo = $_SESSION['tipo'];
                $zona = $_SESSION['zona'];
                
                   if(isset($_POST["siguiente"])){
                       
                       echo $_POST["precio"];

                        $_SESSION['dormitorios']=$_POST["NumeroDeDormitorios"];
                        $_SESSION['precio']=$_POST["precio"];

                        if($_POST["precio"]== '<100.000'){
                            echo $_POST["precio"];
                            $_SESSION['min']=0;
                            $_SESSION['max']=100000;
                        }
                       
      
                        header ("Location:paso4.php");
                        
                   }
                     
                        ?>
                        <h2>Búsqueda de vivienda</h2>
                        <p>1.Tipo > 2.Zona > <strong>3.Caracteristicas</strong> > 4.Extras</p>
                        <p><i>Paso 2:Elija las caracteristicas basicas de la vivienda</i></p>
                        <FORM ACTION="paso3.php" METHOD="POST"  ENCTYPE="multipart/form-data">
                            <table>
                                
                            <tr>
                                <!-- creo un input para cada uno de las opciones de numero de dormuitorios-->
                                
                                <td>Numero de dormitorios:</td>
                                <?php
                                    if (isset($_SESSION['dormitorios'])){
                                        $NumeroDeDormitorios = $_SESSION['dormitorios'];
                                    }else{
                                        $NumeroDeDormitorios=0;
                                    }
                                ?>
                                <td><INPUT TYPE="radio" NAME="NumeroDeDormitorios" VALUE="1" checked
                                        <?php if(isset($_SESSION['dormitorios']) && $NumeroDeDormitorios=='1')
                                                   echo 'checked="checked"';
                                         ?>>1
                                     <INPUT TYPE="radio" NAME="NumeroDeDormitorios" VALUE="2" 
                                            <?php if(isset($_SESSION['dormitorios']) && $NumeroDeDormitorios=='2')
                                                    echo 'checked="checked"';
                                         ?>>2
                                     <INPUT TYPE="radio" NAME="NumeroDeDormitorios" VALUE="3" 
                                            <?php if(isset($_SESSION['dormitorios']) && $NumeroDeDormitorios=='3')
                                                      echo 'checked="checked"';
                                         ?>>3
                                     <INPUT TYPE="radio" NAME="NumeroDeDormitorios" VALUE="4" 
                                            <?php if(isset($_SESSION['dormitorios']) && $NumeroDeDormitorios=='4')
                                                     echo 'checked="checked"';
                                    ?>>4</td>
                                <?php
                                    if(isset($_POST['siguiente']) && $NumeroDeDormitorios==0){
                                        print "<span>selecciona un numero de dormitorios</span>";
                                    }
                                ?>
                            </tr>
                            <tr>
                            <!-- creo un input para introducir el precio de la viviendas y una etiqueta php para controlar los errores-->
                                 
                                <td>Precio:</td>
                                <?php
                                    if (isset($_SESSION['precio'])){
                                        $min = $_SESSION['min'];
                                        $max = $_SESSION['max'];
                                    }else {
                                        $min=0;
                                        $max=0;
                                    }
                                ?>
                                <td><INPUT TYPE="radio" NAME="precio" VALUE="<100.000" checked
                                        <?php if(isset($_SESSION['precio']) && ($_SESSION['precio'])=='<100.000')
                                                   echo 'checked="checked"';
                                                  
                                         ?>><100.000
                                     <INPUT TYPE="radio" NAME="precio" VALUE="100.000-200.000" 
                                            <?php if(isset($_SESSION['precio']) && ($_SESSION['precio'])=='100.000-200.000')
                                                    echo 'checked="checked"';
                                                  
                                         ?>>100.000-200.000
                                     <INPUT TYPE="radio" NAME="precio" VALUE="200.000-300.000" 
                                            <?php if(isset($_SESSION['precio']) && ($_SESSION['precio'])=='200.000-300.000')
                                                      echo 'checked="checked"';
                                                 
                                         ?>>200.000-300.000
                                     <INPUT TYPE="radio" NAME="precio" VALUE=">300.000" 
                                            <?php if(isset($_SESSION['precio']) && ($_SESSION['precio'])=='>300.000')
                                                     echo 'checked="checked"';
                                                     
                                    ?>>>300.000</td>
                                
                             </tr>
                           
                            <tr>
                                <td>
                                    <a href="paso2.php">ir a la pagina anterior</a>
                                <INPUT TYPE="submit" name= "siguiente" VALUE="siguiente">
                                
                                </td>
                            </tr>
                        </table>

                        </form>
                        <?php echo "Buscando ". $_SESSION['tipo'] .", ".$_SESSION['zona'];?>
        <?php
                   
                   
               
           
        ?>
    </body>
</html>
