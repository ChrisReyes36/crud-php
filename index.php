<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
</head>

<body class="container">
    <div class="row justify-content-center">
        <h1 class="text-center mt-4 mb-4">CRUD PHP</h1>
        <div class="col-md-4">
            <form id="form_usuario">
                <div class="form-group mb-3">
                    <!-- <label for="usuario_id">ID</label> -->
                    <input type="hidden" name="usuario_id" id="usuario_id" autocomplete="off" class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="usuario_nombre">Nombre</label>
                    <input type="text" name="usuario_nombre" id="usuario_nombre" class="form-control" autocomplete="off" placeholder="Ingrese sus nombres" />
                </div>
                <div class="form-group mb-3">
                    <label for="usuario_apellidos">Apellidos</label>
                    <input type="text" name="usuario_apellidos" id="usuario_apellidos" class="form-control" autocomplete="off" placeholder="Ingrese sus apellidos" />
                </div>
                <div class="form-group mb-3">
                    <label for="usuario_correo">Correo</label>
                    <input type="text" name="usuario_correo" id="usuario_correo" class="form-control" autocomplete="off" placeholder="Ingrese su correo" />
                </div>
                <div class="form-group mb-3">
                    <label for="usuario_contrasenia">Contraseña</label>
                    <input type="password" name="usuario_contrasenia" id="usuario_contrasenia" class="form-control" autocomplete="off" placeholder="Ingrese su contraseña" />
                </div>
                <div class="form-group mb-3">
                    <label for="rol_id">Rol</label>
                    <select name="rol_id" id="rol_id" class="form-select">
                        <option value="">Seleccione Rol</option>
                        <option value="1">Administrador</option>
                        <option value="2">Cliente</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <input type="submit" id="btn_enviar" value="Guardar" class="btn btn-primary" />
                </div>
            </form>
        </div>
        <div class="col-md-8" id="contenedor_tabla">

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/user.js" type="text/javascript"></script>
</body>

</html>