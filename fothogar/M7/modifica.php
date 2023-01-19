<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifica</title>
</head>
<body>
    <form action="modifica.php" method="POST">
        UserName: <input type ="text" id="username" name="username"> <br>
        Password: <input type ="password" id="pwd" name="pwd"> <br>
        Que quieres modificar? <select name="cambio">
            <option name="inmueble">casa o local</option>
            <option name="tipo">compra o alquiler</option>
            <option name="precio">precio</option>
            <option name="metros">metros cuadrados</option>
            <option name="descripcion">descripcion</option>
            <option name="direccion">direccion</option>
        </select> <br>
        Nuevo valor: <input type="text" id="newValue" name="newValue">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

<?php
   //try {
    $user = $_POST["username"];
    $pwd = $_POST["pwd"];
    $db = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $consulta = $db->prepare("SELECT pwd FROM usuarios WHERE usuario = ?");
    $consulta -> execute(array($user));
    $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
    if(password_verify($pwd,$resultado['pwd'])) {
            $cambio = $_POST['cambio'];
            $nuevoValor = $_POST['newValue'];
            echo "XXXX";
            $db2 = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
            $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "AAAAA";
            $idUser = $db2->prepare("SELECT id FROM usuarios WHERE usuario = ?");
            $idUser -> execute(array($user));
            $id = $idUser->fetch(PDO::FETCH_ASSOC);
        echo "BBBBBB";
            $db3 = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
            $db3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            
            $statement = $db3->prepare("UPDATE casas set precio = ? WHERE idUsuario = ?");
            echo "AAAAAAAA";
        
            $statement -> execute(array($nuevoValor, $idUser));
            echo "BBBBBB";
            $modifica = $statement->fetch(PDO::FETCH_ASSOC);
            echo "hola";
            if($db->query($statement)) {
                echo "hola2";
            }
            
            /* $actualiza = $db3->prepare("UPDATE casas SET ? = ? WHERE idUsuario = ?");
            
            $actualiza -> execute([$cambio,$nuevoValor,$idUser]); */

            
            
        }
    /* }
    catch (PDOException $e) {
        echo ($e->getMessage());
   } */
?>