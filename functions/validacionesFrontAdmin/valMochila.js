//validacion para las mochilas
//Se toman cada uno de los campos y se validan que no esten vacios

function validarFormulario() {
    const nombre = document.getElementById("nombre").value;
    const proveedor = document.getElementById("proveedor").value;
    const precio = document.getElementById("precio").value;
    const stock = document.getElementById("stock").value;
    const descripcion = document.getElementById("descripcion").value;
    const foto = document.getElementById("foto").value;
    // const talle = document.getElementById("mochila").value;

    if (nombre.trim() === "") {
        alert("Por favor, ingrese su nombre");
        return false;
    }

    if (proveedor.trim() === "") {
        alert("Por favor, ingrese su proveedor");
        return false;
    }

    if (precio.trim() === "") {
        alert("Por favor, ingrese un precio");
        return false;
    }

    if (stock.trim() === "") {
        alert("Por favor, ingrese su stock");
        return false;
    }

    if (descripcion.trim() === "") {
        alert("Por favor, ingrese un descripcion");
        return false;
    }

    if (foto.trim() === "") {
        alert("Por favor, ingrese un foto");
        return false;
    }

    
    return true;

}