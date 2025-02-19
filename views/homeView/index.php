<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
    <div class="container mt-2">
        <a class="btn btn-secondary" href="<?=url("create")?>">Crear</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>USUARIO</th>
                    <th>EMAIL</th>
                    <th>PASSWORD</th>
                    <th>FECHA CREADO</th>
                    <th>FECHA UPDATE</th>
                    <th colspan="2">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $user):?>
                    <tr>
                        <td>#</td>
                        <td><?=$user["usuario"]?></td>
                        <td><?=$user["email"]?></td>
                        <td><?=$user["password"]?></td>
                        <td><?=$user["date_create"]?></td>
                        <td><?=$user["date_update"]?></td>
                        <td><a class="btn btn-warning" href="<?=url("update/$user[id_usuario]")?>">Editar</a></td>
                        <td><a class="btn btn-danger" href="<?=url("delete/$user[id_usuario]")?>">Eliminar</a></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>