<?php

    try{
        $db = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $files = $_FILES["inputFiles"];

        $user = $_POST["user"];
        $inmueble = $_POST['inmueble'];
        $tipo = $_POST['tipo'];
        $precio = $_POST['precio'];
        $descrip = $_POST['desc'];
        $metros = $_POST['m2'];
        $direccion = $_POST['direccion'];
        
        $query = $db->prepare("SELECT id FROM usuarios WHERE usuario = ?");
        $id = $query->execute(array($user));
        
        $db2 = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
        $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consultaCasa = $db2->prepare("INSERT INTO casas (idUsuario,inmueble,tipo,precio,descripcion,metros,direccion) VALUES (?,?,?,?,?,?,?)");
    
        $insertFoto = $consultaCasa -> execute(array($id,$inmueble,$tipo,$precio,$descrip,$metros,$direccion));
        
        
        $filas = $consultaCasa->rowCount();
        
        
        $db3 = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
        $db3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $queryIdCasa = $db3->prepare("SELECT id FROM casas WHERE idUsuario = ?");
        $idCasa = $queryIdCasa -> execute(array($id));

        if($filas != 0) {
            for($i=0;$i<count($files['name']);$i++){

                $imagename = $files['name'][$i];

                $imagetemp = $files['tmp_name'][$i];

                //echo $imagename . " " . $imagetemp . "<br>";
                //The path you wish to upload the image to
                $imagePath = "../imgs/";

                    if(move_uploaded_file($imagetemp, $imagePath . $imagename)) {
                        chmod($imagePath.$imagename, 0777);
                        header('Location:fetchSelects.php');
                        /* echo "Sussecfully uploaded your image.";
                        echo'<p><img src="'.$imagePath.$imagename.'"></p>'; */
                    }
                    else {
                        echo "Failed to move your image.";
                    }

                $consulta = $db->prepare("INSERT INTO imagen (idCasa,foto) VALUES (?,?)");
                $consulta ->execute([$idCasa,$imagename]);
            }
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
?>