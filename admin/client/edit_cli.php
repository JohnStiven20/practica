<?php

session_start();

if (!isset($_SESSION["name"]) && isset($_SESSION["email"]) && !isset($_SESSION["rol"])) {
    header("Location: admin/index.php");
    exit;
}

include("../db/db.inc");

function validaciones($campo)
{
    return htmlspecialchars($_POST[$campo]);
}



if (isset($_POST["nombre"])  && !empty($_POST["nombre"])) {

    $nombre = validaciones("nombre");
    $apellidos = validaciones("apellidos");
    $email = validaciones("email");
    $genero = validaciones(("genero"));
    $direccion = validaciones("direccion");
    $codigo_postal = validaciones("codigo_postal");
    $poblacion = validaciones("poblacion");
    $provincia = validaciones("provincia");
    $password = validaciones("password");

    $sql = "SELECT * FROM clientes WHERE email = '$email'";

    $res = mysqli_query($con, $sql);

    $id = $_GET["edit"];

    $update = "UPDATE clientes 
           SET nombre='$nombre', 
               apellidos='$apellidos', 
               email='$email', 
               genero='$genero', 
               direccion='$direccion', 
               codPostal='$codigo_postal', 
               poblacion='$poblacion', 
               provincia='$provincia' 
           WHERE id=$id";

    if (mysqli_query($con, $update)) {
        header("Location: gestion_clientes.php?cli=0");
        exit;
    } else {
        header("Location:../admin/client/gestion_clientes.php?cli=2");
    }

    print $insert;
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        .header {
            background-color: blue !important;
            color: white !important;
        }
    </style>

</head>

<body>
    <div class="container mt-5 card p-0">


        <?php

        if (isset($_GET["edit"])) {
            $id = intval($_GET["edit"]);
            $sql = "SELECT * FROM clientes WHERE id = $id";
            $res = mysqli_query($con, $sql);

            if (mysqli_num_rows($res) > 0) {
                $cliente = mysqli_fetch_assoc($res);
            } else {
                header("Location: gestion_clientes.php");
            }
        }
        ?>


        <header class="container header w-100">
            <h1 class="p-2">Registro de Cliente con Mysqli</h1>
        </header>
        <form class="container d-flex flex-column p-3 gap-3 w-100" action="" method="post">
            <div class="flex-row d-flex gap-5 w-100 mb-3 mt-3">
                <div class="w-50">
                    <label class="form-label" for="">Nombre</label>
                    <input class="form-control" type="text" name="nombre" value="<?= $cliente["nombre"] ?>">
                </div>
                <div class="w-50">
                    <label class="form-label" for="">Apellidos</label>
                    <input class="form-control" type="text" name="apellidos" value="<?= $cliente["apellidos"] ?>">
                </div>
            </div>
            <div class="flex-row d-flex gap-5 w-100 mb-3">
                <div class="w-50">
                    <label class="form-label" for="">Email</label>
                    <input class="form-control" type="text" name="email" value="<?= $cliente["email"] ?>">
                </div>
                <div class="w-50">
                    <label class="form-label" for="">Genero</label>
                    <select class="form-select" name="genero" value="<?= $cliente["genero"] ?>">
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </div>
            </div>
            <div class="flex-row d-flex gap-5 w-100 mb-3">
                <div class="w-100">
                    <label class="form-label" for="">Direccion</label>
                    <input class="form-control" type="text" name="direccion" value="<?= $cliente["direccion"] ?>">
                </div>
            </div>
            <div class="flex-row d-flex gap-5 w-100 mb-3 justify-content-center">
                <div class="w-50">
                    <label class="form-label" for="">Codigo Postal</label>
                    <input class="form-control" type="text" name="codigo_postal" value="<?= $cliente["codpostal"] ?>">
                </div>
                <div class="w-50">
                    <label class="form-label" for="">Poblacion</label>
                    <input class="form-control" type="text" name="poblacion" value="<?= $cliente["poblacion"] ?>">
                </div>
                <div class="w-50">
                    <label class="form-label" for="">Provincia</label>
                    <input type="text" class="form-control" name="provincia" value="<?= $cliente["provincia"] ?>">
                </div>
            </div>
            <div class="flex-row d-flex gap-5 w-100 mb-3">
                <div class="w-25">
                    <button type="submit" class="btn btn-success">Actualizar cliente</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>