<?php
    $fotoPath = $_GET['foto'];
    $foto = explode("/", $fotoPath)[2];
    
     try {
        $db = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $consulta = $db->prepare("SELECT idCasa FROM imagen WHERE foto = ?");
        $idCasa = $consulta->execute(array($foto));
        
        
        $db2 = new PDO("mysql:host=localhost;dbname=Fothogar", "marc", "marc");
        $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $info = $db2->prepare("SELECT * FROM casas WHERE id = ?");
        
        $infoCasa = $info->execute(array($idCasa));
        
      
     

       while ($fila=$info->fetch(PDO::FETCH_ASSOC)){
        echo "tipo ".$fila['tipo'] . '<br />';
        echo $fila['inmueble'] . '<br />';
        echo "Precio ".$fila['precio'] . '<br />';
        echo "Descripcion ".$fila['descripcion'] . '<br />';
        echo "Metros ".$fila['metros'] . '<br />';
        echo "Direccion ".$fila['direccion'] . '<br />';
       /* for ($i = 0; $i < count($infoCasa); $i++) {
           
       } */

    }
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
?>