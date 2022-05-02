<?php

require_once "../models/user.model.php";

if (isset($_POST) || isset($_GET)) {
    // Creamos una instancia de la clase UserModel, la cual hereda de Connection
    $user = new User();
    // Obtenemos los datos del formulario
    $usuario_id = isset($_POST["usuario_id"]) ? $_POST["usuario_id"] : false;
    $usuario_nombre = isset($_POST["usuario_nombre"]) ? $_POST["usuario_nombre"] : false;
    $usuario_apellidos = isset($_POST["usuario_apellidos"]) ? $_POST["usuario_apellidos"] : false;
    $usuario_correo = isset($_POST["usuario_correo"]) ? $_POST["usuario_correo"] : false;
    $usuario_contrasenia = isset($_POST["usuario_contrasenia"]) ? $_POST["usuario_contrasenia"] : false;
    $rol_id = isset($_POST["rol_id"]) ? $_POST["rol_id"] : false;
    $accion = isset($_GET["accion"]) ? strtolower($_GET["accion"]) : false;

    if ($accion) {
        switch ($accion) {
            case "listar":
                print_r(json_encode($user->getAllUsers()));
                break;

            case "obtener":
                $usuario_id = isset($_GET["usuario_id"]) ? $_GET["usuario_id"] : false;
                // Validamos que los campos no estén vacíos
                if ($usuario_id) {
                    $user->setUsuario_id($usuario_id);
                    print_r(json_encode($user->getUserById($usuario_id)));
                }
                break;

            case "crear":
                // Validamos que los campos no estén vacíos
                if ($usuario_nombre && $usuario_apellidos && $usuario_correo && $usuario_contrasenia && $rol_id) {
                    $user->setUsuario_id($usuario_id);
                    $user->setUsuario_nombre($usuario_nombre);
                    $user->setUsuario_apellidos($usuario_apellidos);
                    $user->setUsuario_correo($usuario_correo);
                    $user->setUsuario_contrasenia($usuario_contrasenia);
                    $user->setRol_id($rol_id);

                    // Creamos el usuario
                    if ($user->createUser()) {
                        print_r(json_encode([
                            "status" => "success",
                            "message" => "Usuario creado correctamente",
                            "title" => "¡Éxito!"
                        ]));
                    } else {
                        print_r(json_encode([
                            "status" => "error",
                            "message" => "Error al crear el usuario",
                            "title" => "¡Error!"
                        ]));
                    }
                } else {
                    print_r(json_encode([
                        "status" => "error",
                        "message" => "Todos los campos son obligatorios",
                        "title" => "¡Error!"
                    ]));
                }
                break;

            case "editar":
                // Validamos que los campos no estén vacíos
                if ($usuario_nombre && $usuario_apellidos && $usuario_correo && $usuario_contrasenia && $rol_id) {
                    $user->setUsuario_id($usuario_id);
                    $user->setUsuario_nombre($usuario_nombre);
                    $user->setUsuario_apellidos($usuario_apellidos);
                    $user->setUsuario_correo($usuario_correo);
                    $user->setUsuario_contrasenia($usuario_contrasenia);
                    $user->setRol_id($rol_id);

                    // Editamos el usuario
                    if ($user->updateUser()) {
                        print_r(json_encode([
                            "status" => "success",
                            "message" => "Usuario editado correctamente",
                            "title" => "¡Éxito!"
                        ]));
                    } else {
                        print_r(json_encode([
                            "status" => "error",
                            "message" => "Error al editar el usuario",
                            "title" => "¡Error!"
                        ]));
                    }
                } else {
                    print_r(json_encode([
                        "status" => "error",
                        "message" => "Todos los campos son obligatorios",
                        "title" => "¡Error!"
                    ]));
                }
                break;

            case "eliminar":
                $usuario_id = isset($_GET["usuario_id"]) ? $_GET["usuario_id"] : false;
                // Validamos que los campos no estén vacíos
                if ($usuario_id) {
                    $user->setUsuario_id($usuario_id);

                    // Eliminamos el usuario
                    if ($user->deleteUser()) {
                        print_r(json_encode([
                            "status" => "success",
                            "message" => "Usuario eliminado correctamente",
                            "title" => "¡Éxito!"
                        ]));
                    } else {
                        print_r(json_encode([
                            "status" => "error",
                            "message" => "Error al eliminar el usuario",
                            "title" => "¡Error!"
                        ]));
                    }
                } else {
                    print_r(json_encode([
                        "status" => "error",
                        "message" => "Falta el ID del usuario",
                        "title" => "¡Error!"
                    ]));
                }
                break;

            default:
                // code...
                break;
        }
    }
}
