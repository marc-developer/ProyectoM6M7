 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fetchSelects</title>
</head>
<body>
    <a href="../M6/dragDrop.html">Subir imagenes</a>
    <a href="modifica.php">modificar inmueble</a>
    <a href="delete.php">borra una casa</a>
    <select name="categoria" id="categoria">
        <option value="1">Categoria 1</option>
    </select>
    <select name="subCategoria" id="subCategoria">
        <option value="1">Categoria 2</option>
    </select> <br>

</body>
   
</html> 

<?php 
    $folderPath = '../imgs/';
    $numFiles = glob($folderPath . '*.jpg');
    $folder = opendir($folderPath);
   
   
        for ($i = 0; $i < count($numFiles); $i++) {
            
            $filePath = $numFiles[$i];
           
           // echo $filePath;
            $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            
            if($extension == 'jpg' || $extension == 'png') {
                ?>
                <a href="detalle.php?foto=<?php echo $filePath;?>"><img src="<?php echo $filePath; ?>"style = "width: 30% ;height: 30%"></a>
                <?php
                
                
            } 
        }
        //while(false !== ($file = readdir($folder))){
            //echo $file;
              
        //}

    closedir($folder);
?>

