const form_usuario = document.getElementById("form_usuario");
const btn_enviar = document.getElementById("btn_enviar");
const contenedor_tabla = document.getElementById("contenedor_tabla");

const getUsers = async (contenedor) => {
    const response = await fetch(
        "./controllers/user.controller.php?accion=listar",
        {
            method: "GET",
        }
    );

    const result = await response.json();

    let html = "";

    html += `
    <table id="tabla_usuario" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Rol</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>`;

    result.forEach((user) => {
        html += `
            <tr>
                <td>${user.usuario_nombre}</td>
                <td>${user.usuario_apellidos}</td>
                <td>${user.usuario_correo}</td>
                <td>${user.rol_nombre}</td>
                <td class="text-center">
                    <button class="btn btn-primary btn-sm" onclick="getUser(${user.usuario_id})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="confirmDeletion(${user.usuario_id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });

    html += `
        </tbody>
    </table>`;

    contenedor.innerHTML = html;

    $("#tabla_usuario").DataTable({
        lengthMenu: [
            [5, 10, 15, 20, 25, -1],
            [5, 10, 15, 20, 25, "Todos"],
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
        },
    });
};

const getUser = async (id) => {
    const response = await fetch(
        `./controllers/user.controller.php?accion=obtener&usuario_id=${id}`,
        {
            method: "GET",
        }
    );

    const result = await response.json();

    $("#usuario_id").val(result[0].usuario_id);
    $("#usuario_nombre").val(result[0].usuario_nombre);
    $("#usuario_apellidos").val(result[0].usuario_apellidos);
    $("#usuario_correo").val(result[0].usuario_correo);
    $("#usuario_contrasenia").val(result[0].usuario_contrasenia);
    $("#rol_id").val(result[0].rol_id);
};

const createUser = async (form) => {
    const response = await fetch(
        "./controllers/user.controller.php?accion=crear",
        {
            method: "POST",
            body: new FormData(form),
        }
    );

    const result = await response.json();

    return result;
};

const updateUser = async (form) => {
    const response = await fetch(
        "./controllers/user.controller.php?accion=editar",
        {
            method: "POST",
            body: new FormData(form),
        }
    );

    const result = await response.json();

    return result;
};

const confirmDeletion = (id) => {
    Swal.fire({
        title: "¿Seguro/a desea eliminar el usuario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            deleteUser(id);
        }
    });
};

const deleteUser = async (id) => {
    const response = await fetch(
        "./controllers/user.controller.php?accion=eliminar&usuario_id=" + id,
        {
            method: "GET",
        }
    );

    const result = await response.json();

    if (result.status === "success") {
        Swal.fire({
            title: `${result.title}`,
            text: `${result.message}`,
            icon: "success",
            showConfirmButton: false,
            timer: 2500,
            allowOutsideClick: false,
        });

        await getUsers(contenedor_tabla);
    } else {
        Swal.fire({
            title: `${result.title}`,
            text: `${result.message}`,
            icon: "error",
            showConfirmButton: false,
            timer: 2500,
            allowOutsideClick: false,
        });
    }
};

document.addEventListener("DOMContentLoaded", async () => {
    await getUsers(contenedor_tabla);
});

btn_enviar.addEventListener("click", async (e) => {
    e.preventDefault();

    const usuario_id = document.getElementById("usuario_id");
    let result;

    if (usuario_id.value > 0) {
        result = await updateUser(form_usuario);
    } else {
        result = await createUser(form_usuario);
    }

    if (result.status === "success") {
        Swal.fire({
            title: `${result.title}`,
            text: `${result.message}`,
            icon: "success",
            showConfirmButton: false,
            timer: 2500,
            allowOutsideClick: false,
        });

        await getUsers(contenedor_tabla);
        usuario_id.value = "";
        form_usuario.reset();
    } else {
        Swal.fire({
            title: `${result.title}`,
            text: `${result.message}`,
            icon: "error",
            showConfirmButton: false,
            timer: 2500,
            allowOutsideClick: false,
        });
    }
});
