<?php
    session_start();
    try{
        $db = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $user = $_POST["username"];
        $email = $_POST["email"];
        $pwd = password_hash($_POST["pwd"],PASSWORD_DEFAULT);

        $consultaSelect = $db->prepare("SELECT * FROM usuarios WHERE usuario = ? AND email = ?");
        $consultaSelect -> execute([$user,$email]);
        $fila=$consultaSelect->fetch(PDO::FETCH_ASSOC);
        if(!$fila) {
            $consulta = $db->prepare("INSERT INTO usuarios (usuario, email, pwd) VALUES (?,?,?)");
            $consulta ->execute([$user,$email,$pwd]);
            $_SESSION['userName'] = $user;
            echo "registrao";
            header('Location:fetchSelects.php');
        }else {
            echo "Usuario ya en uso";
        }
    }
    catch (PDOException $e) {
        echo ($e->getMessage());
    }

?>