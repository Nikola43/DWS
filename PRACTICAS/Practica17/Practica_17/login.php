<?php
    if (isset($_POST["entrar"])){
        try
        {
            $conexion = new PDO('mysql:host=localhost;dbname=dwes', 'alumno', 'velazquez');
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			
           // $sql = "SELECT * FROM usuarios WHERE usuario = :login and contrasena = :password";

           // $resultado = $conexion->prepare($sql);
            $login = htmlentities(addslashes($_POST["usuario"]));
			$password = htmlentities(addslashes($_POST["clave"]));

           // $resultado->bindValue(":login", $login);
           //$resultado->bindValue(":password", $password);
           // $resultado->execute();
		   
			$sql = "SELECT * FROM usuarios WHERE usuario = :login and contrasena = :password";
			$resultado = $conexion->query($sql);

            $numero_registro = $resultado->rowCount();


            if ($numero_registro!=0){

                session_start();

                $_SESSION["usuario"]=$_POST["usuario"];

                header("location:productos.php");

            }else{

                print "<p>Acceso no autorizado</p><p>[ <a href='login.php'> Conectar </a>]</p>";

            }

            $resultado->closeCursor();

        } catch(Exception $e){

            die('Error: '. $e->GetMessage());	
        }

    }else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Practica 16</title>
    </head>
    <body>
        <p>Para entrar debe identificarse.</p>

        <form action="<?php print $_SERVER['PHP_SELF']?>" method="post">       
            <table>
                <tr>
                    <td><b>Usuario:</b></td>
                    <td><input type="text" name="usuario"></td>
                </tr>
                <tr>
                    <td><b>Clave:</b></td>
                    <td><input type="password" name="clave"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="entrar" value="Entrar"></td>
                </tr>
            </table>
        </form>

        <?php    
        }
        ?>


    </body>
</html>