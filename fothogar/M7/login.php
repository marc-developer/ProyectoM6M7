<?php
    session_start();
    try {
        $db = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $user = $_POST["username"];
        $pwd = $_POST["pwd"];
        $consulta = $db->prepare("SELECT pwd FROM usuarios WHERE usuario = ?");
        $consulta -> execute(array($user));
        $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
        if(password_verify($pwd,$resultado['pwd'])) {
            if(!isset($_SESSION['username'])){
                $_SESSION['userName'] = $user;
            }
            echo "pa'lante";
            header('Location:fetchSelects.php');
        }
        else {
            echo "usuario o contraseña incorrectos";
        }
    }
    catch (PDOException $e) {
        echo ($e->getMessage());
    }
?>