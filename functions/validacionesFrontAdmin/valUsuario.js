//validacion para las usuarios
//Se toman cada uno de los campos y se validan que no esten vacios

function validarFormulario() {
    const nombre = document.getElementById("nombre").value;
    const apellido = document.getElementById("apellido").value;
    const dni = document.getElementById("dni").value;
    const legajo = document.getElementById("legajo").value;
    const correo = document.getElementById("correo").value;
    const password = document.getElementById("password").value;
    const password2 = document.getElementById("password2").value;
    // const talle = document.getElementById("mochila").value;

    if (nombre.trim() === "") {
        alert("Por favor, ingrese su nombre");
        return false;
    }

    if (apellido.trim() === "") {
        alert("Por favor, ingrese su apellido");
        return false;
    }

    if (dni.trim() === "") {
        alert("Por favor, ingrese un dni");
        return false;
    }

    if (legajo.trim() === "") {
        alert("Por favor, ingrese su legajo");
        return false;
    }

    if (correo.trim() === "") {
        alert("Por favor, ingrese un correo");
        return false;
    }

    if (password.trim() === "") {
        alert("Por favor, ingrese un password");
        return false;
    }

    if (password2.trim() === "") {
        alert("Por favor, repita el password");
        return false;
    }

    return true;

}