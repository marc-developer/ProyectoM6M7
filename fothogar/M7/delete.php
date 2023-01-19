<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
</head>
<body>
    <form action="" method="POST">

        UserName: <input type ="text" id="username" name="username"> <br>
        Contraseña: <input type="password" id="password" name="pwd"> <br>
        <button type="submit">Enviar</button>
    </form>
    
</body>
</html>

<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $user = $_POST["username"];
    $pwd = $_POST["pwd"];
    
    $consulta = $db->prepare("SELECT pwd FROM usuarios WHERE usuario = ?");
    $consulta -> execute(array($user));
    $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
   
    
    if(password_verify($pwd,$resultado['pwd'])) {
        $db2 = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
        $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $id = $db2 ->prepare("SELECT id FROM usuarios WHERE usuario = ?");
        $idUser = $id -> execute(array($user));
        
        
        $borra ="DELETE FROM casas WHERE idUsuario = 1";
       
        $db2->exec($borra);
        echo "borrado";
    }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    

?>