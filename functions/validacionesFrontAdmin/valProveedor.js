//validacion para los proveedores
//Se toman cada uno de los campos y se validan que no esten vacios

function validarFormulario() {
    const nombre = document.getElementById("nombre").value;
    const telefono = document.getElementById("telefono").value;
    const email = document.getElementById("email").value;
    const direccion = document.getElementById("direccion").value;
    const localidad = document.getElementById("localidad").value;
    // const talle = document.getElementById("mochila").value;

    if (nombre.trim() === "") {
        alert("Por favor, ingrese su nombre");
        return false;
    }

    if (telefono.trim() === "") {
        alert("Por favor, ingrese su telefono");
        return false;
    }

    if (email.trim() === "") {
        alert("Por favor, ingrese un email");
        return false;
    }

    if (direccion.trim() === "") {
        alert("Por favor, ingrese su direccion");
        return false;
    }

    if (localidad.trim() === "") {
        alert("Por favor, ingrese un localidad");
        return false;
    }

    return true;

}