<?php



session_start();

if (!isset($_SESSION["name"]) && isset($_SESSION["email"]) && !isset($_SESSION["rol"])) {
    header("Location: admin/index.php");
    exit;
}

include("../db/db_pdo.inc");

$clientes = $pdo->query("SELECT * FROM clientes ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

$nombre = $_SESSION["name"];
$rol = $_SESSION["rol"];

// Eliminar cliente -> Si existe la variable eliminar, eliminamos al
//cliente con id pasado en esta variable

if (isset($_GET["eliminar"])) {
    print "hOLA";
    $id = intval($_GET['eliminar']);
    $pdo->prepare("DELETE FROM clientes WHERE id = ?")->execute([$id]);
    header("Location: gestion_clientes.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min
.css" rel="stylesheet">

    <style>
        img {
            height: 40px;
            width: 40px;
        }

        .tarjeta {
            border-radius: 10px !important;
            border: 1px solid white;
            background-color: blue !important;
        }

        p {
            margin: 0;
        }

        button img {
            width: 24px;
            height: 24px;
        }

        button {
            height: 40px;
            width: 40px;
            border-radius: 50px;
        }

        ul {
            margin-top: 30px;
            text-decoration: none;
            list-style: none;
            padding-left: 50px !important;
        }

        .opcion:hover {
            color: white;
        }

        .sujeto {
            border-radius: 50px !important;
        }

        .boton-salir {
            background-image: url(../img/descarga.png);
        }
    </style>

</head>

<body class="bg-light">
    <div class="d-flex flex-row vh-100">
        <div class="bg bg-primary w-25">
            <div class="card tarjeta m-3 p-3 d-flex flex-row justify-content-between text-white">
                <div class="d-flex flex-row justify-content-center align-items-center p-3 gap-3">
                    <img class="sujeto" src="../img/admin.jpg" alt="">
                    <div class="d-flex flex-column justify-content-between">
                        <p><?= $nombre ?></p>
                        <?= $rol == 1 ? "Administrador" : "Usuario" ?>
                    </div>
                </div>
                <!-- Botón circular con ícono -->
                <button class="btn btn-danger align-self-center rounded-circle d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;" aria-label="Cerrar sesión">
                    <a href="" style="text-decoration: none; color: white;">Salir</a>
                </button>
            </div>

            <div class="secciones">
                <ul class="d-flex flex-column gap-3 text-black">
                    <li>
                        <p class="text-white">Menu principal</p>
                        <hr>
                    </li>
                    <li class="opcion">Clientes</li>
                    <li class="opcion">Productos</li>
                    <li class="opcion">Pedidos</li>
                </ul>
            </div>
        </div>
        <div class="container mt-4">
            <h2 class="text-center mb-4">📋 Gestión de Clientes</h2>
            <!-- Tabla de clientes -->
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">📋 Lista de
                    Clientes</div>
                <div class="card-body">
                    <?php if (isset($_GET["cli"])) { ?>
                        <?php if ($_GET["cli"] == 0) { ?>
                            <div class="alert alert-success">
                                Todo Correcto
                            </div>
                        <?php } ?>
                        <?php if ($_GET["cli"] == 1) { ?>
                            <div class="alert alert-warning">
                                Ya existe
                            </div>
                        <?php } ?>
                        <?php if ($_GET["cli"] == 2) { ?>
                            <div class="alert alert-danger">
                                Error en el ingreso
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <div class="row mb-3 me-2 float-end">
                        <a href="../../ui/ins_cli_mysqli.php" class="btn btn-success">➕
                            Nuevo Cliente</a>
                    </div>
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Género</th>
                                <th>Dirección</th>
                                <th>Código Postal</th>
                                <th>Población</th>
                                <th>Provincia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $c): ?>
                                <tr>
                                    <td><?= $c['id'] ?></td>
                                    <td><?= htmlspecialchars($c['nombre']) ?></td>
                                    <td><?= htmlspecialchars($c['apellidos']) ?></td>
                                    <td><?= htmlspecialchars($c['email']) ?></td>
                                    <td><?= $c['genero'] ?></td>
                                    <td><?= htmlspecialchars($c['direccion']) ?></td>
                                    <td><?= $c['codpostal'] ?></td>
                                    <td><?= htmlspecialchars($c['poblacion']) ?></td>
                                    <td><?= htmlspecialchars($c['provincia']) ?></td>
                                    <td>
                                        <a href="edit_cli.php?edit=<?= $c['id']; ?>" class="btn btn-sm btnwarning">✏️</a>
                                        <a href="gestion_clientes.php?eliminar=<?= $c['id']?>" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar cliente?');">🗑️</a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundl
e.min.js"></script>
</body>

</html>