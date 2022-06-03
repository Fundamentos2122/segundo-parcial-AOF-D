<?php

require '../database.php';

$db = new Database();
$con = $db->conectar();

$correcto = false;

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ahorrado = $_POST['ahorrado'];
    $fecha = $_POST['fecha'];

    $query = $con->prepare("UPDATE  metas SET titulo=?, descripcion=?, ahorrado=?, fecha=?  WHERE id=?");
    $resultado = $query->execute(array($titulo, $descripcion, $ahorrado, $fecha, $id));

    if($resultado){
        $correcto = true;
    }

}else {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ahorrado = $_POST['ahorrado'];
    $fecha = $_POST['fecha'];
    

    
    $query = $con->prepare("INSERT INTO metas (titulo, descripcion, ahorrado, fecha, activo) VALUES (:tit, :descr, :aho, :fec, 1)");
    $resultado = $query->execute(array('tit' => $titulo, 'descr' => $descripcion, 'aho' => $ahorrado, 'fec' => $fecha));

    if($resultado){
        $correcto = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <nav class="navbar bg-primary">
            <!-- LOGO -->
            <div class="logo">Money Me</div>
            <!-- NAVIGATION MENU -->
            <ul class="nav-links">
                <input type="checkbox" id="checkbox_toggle" />
                <label for="checkbox_toggle" class="hamburger">&#9776;</label>
                <!-- NAVIGATION MENUS -->
                <div class="menu">
                    <li><a href="../../dashboard-user.php">Dashboard</a></li>
                </div>
            </ul>
            </nav>
    </header>

    <div class="dashboard-container text-justify first">
        <h2 class="text-center color-primary">Nueva meta</h2>
        <section id="form">
            <?php if ($correcto) { ?>
                 <h2>Tu meta fue guardado exitosamente. </h2>
            <?php } else {?>
                 <h2>Tu meta no fue guardado exitosamente. </h2>
            <?php }?>
            <div class="flex" data-state="column vertical-center user-list form-adapt" >  
                <div class="form-box">
                <button class="btn text-center" type="submit"><a href="../../dashboard-user.php">Regresar</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>