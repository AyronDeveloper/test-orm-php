<?php

use configs\Handle\Request;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Update</title>
</head>
<body class="bg-primary-subtle">
    <div class="container">
        <h1 class="text-cente">ACTUALIZAR USUARIO</h1>
        <a href="<?=url()?>" class="btn btn-primary mb-3">Atras</a>
        <form class="border border-primary border-3 p-3 rounded-2" action="<?=url("update/$id_usuario")?>" method="post">
            <?=Request::method("put")?>
            <div class="mb-2">
                <label class="form-label" for="">Usuario</label>
                <input class="form-control" type="text" name="usuario" value="<?=$usuario["usuario"]?>">
            </div>
            <div class="mb-2">
                <label class="form-label" for="">Email</label>
                <input class="form-control" type="text" name="email" value="<?=$usuario["email"]?>">
            </div>
            <div class="mb-2">
                <label class="form-label" for="">Contraseña</label>
                <input class="form-control" type="password" name="password" value="<?=$usuario["password"]?>">
            </div>
            <button class="btn btn-success mt-2">ACTUALIZAR</button>
        </form>
    </div>
    
</body>
</html>