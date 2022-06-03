<?php

require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$activo = 1;

$control_mensajes = $con->prepare("SELECT id, asunto, mensaje, fecha FROM mensajes WHERE activo=:mi_activo ORDER BY id ASC");
$control_mensajes->execute(['mi_activo' => $activo]);
$mensajes = $control_mensajes->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
                    <li><a href="index.php">Inicio</a></li>
                    <li class="services">
                        <a href="/">Dashboard</a>
                        <ul class="dropdown">
                            <li><a href="#usuarios">Mis usuarios</a></li>
                            <li><a href="#mensajes">Alertas</a></li>
                        </ul>
                    </li>
                    <li class="services">
                        <a>Admin</a>
                        <ul class="dropdown">
                            <li><a href="index.php">Log out</a></li>
                        </ul>
                    </li>
                </div>
            </ul>
            </nav>
    </header>

    <div class="dashboard-container text-justify first">
        <section id="usuarios" class="flex" data-state="justify-between vertical-center ">
            <div class="flex" data-state="column ">
                <h2 class="text-center color-primary">Mis usuarios</h2>
                <img src="https://picsum.photos/2000/1000" alt="">
            </div>
            <div class="box flex" data-state=" column vertical-center">
                <h2>Recordatorios</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius repellat omnis cupiditate quis corrupti perferendis eveniet tempora? Veritatis quae facere quos labore molestiae in! Repellat, aliquam. Doloremque repellat velit nobis!</p>
            </div>
        </section>
        
        <!-- <section id="mensajes" class="flex form-admin" data-state="vertical-center justify-evenly">
            <div class="flex admin-box" data-state="column">
                <div class="col">
                    <h2>Mensaje / Alertas</h2>
                    <label for="standard-select">Nombre de usuario</label>
                    <div class="select">
                        <select id="standard-select">
                            <option value="Option 1">User 1</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label for="standard-select">Alerta ó mensaje</label>
                    <div class="select">
                        <select id="standard-select">
                            <option value="Option 1">Alerta</option>
                            <option value="Option 2">Mensaje</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label for="">Escribe el mensaje</label>
                    <br>
                    <textarea name="" id="" placeholder="Aquí va tu mensaje o alerta..."></textarea>
                    <button class="btn text-center" type="submit" class="form-input"><a>Enviar mensaje</a></button>
                </div>
            </div>
            <div class="">
                <img src="https://picsum.photos/500/500" alt="">
            </div>
        </section> -->
        
        <section id="alertas">
            <h2 class="text-center">Lista de usuarios</h2>            
            <h2>Usuarios en verde</h2>            
            <div class="flex" data-state="wrap" >
                <div class="user-box-metas">
                    <h2>Nombre: Fulanito1</h2> 
                    <h2>Username Fulanito10:</h2> 
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident eius accusamus molestiae doloribus reiciendis aperiam, velit quis minus officia ab soluta minima accusantium asperiores quas, ipsam ipsum dolore nemo aut!</p>
                </div>
            </div>
            <h2>Usuarios en amarillo</h2>            
            <div class="flex" data-state="wrap" >
                <div class="user-box-metas">
                    <h2>Nombre: Fulanito1</h2> 
                    <h2>Username Fulanito10:</h2> 
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident eius accusamus molestiae doloribus reiciendis aperiam, velit quis minus officia ab soluta minima accusantium asperiores quas, ipsam ipsum dolore nemo aut!</p>
                </div>
            </div>
            <h2>Usuarios en rojo</h2>            
            <div class="flex" data-state="wrap" >
                <div class="user-box-metas">
                    <h2>Nombre: Fulanito1</h2> 
                    <h2>Username Fulanito10:</h2> 
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident eius accusamus molestiae doloribus reiciendis aperiam, velit quis minus officia ab soluta minima accusantium asperiores quas, ipsam ipsum dolore nemo aut!</p>
                </div>
            </div>
        </section>

        <section id="mensajes">     
            <h2 class="text-center">Lista de mensajes</h2>
            <button class=" text-center" type="submit"><a href="new-mensaje.php">Crear nuevo mensaje</a></button>       
            <div class="flex" data-state="wrap">
                    <?php
                        foreach($mensajes AS $row){
                    ?>
                <div class="user-box-metas">
                    <h2><?php echo $row['asunto']?>.</h2> 
                    <p><?php echo $row['mensaje']?></p>
                    <h2 class="text-right">Fecha: <?php echo $row['fecha']?>.</h2>
                    <div class="flex" data-state="">
                    <button class="btn text-center" type="submit"><a href="edit-mensaje.php?id=<?php echo $row['id']?>">Editar</a></button>
                    <button class="btn text-center" type="submit"><a href="config/delete/mensajes.php?id=<?php echo $row['id']?>">Eliminar</a></button>
                    </div>
                </div>
                <?php }?>
            </div>
        </section>

    </div>
</body>
</html>