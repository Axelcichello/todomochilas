<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalizer.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>TodoMochilas | Contacto</title>
</head>

<body>

    <?php
    include 'functions/arrays.php';
    include 'templates/header.php';

    ?>

    <main class="contenedor">
        <h1 class="subtitulo">Contacto</h1>

        <form method="POST" action="notificacion.php" class="formulario" onsubmit="return validarFormulario();">

            <fieldset>
                <legend>Informacion de contacto</legend>

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Ingrese su nomobre">

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" placeholder="Ingrese su apellido" name="apellido">

                <label for="telefono">Telefono</label>
                <input type="number" id="telefono" placeholder="Numero de contacto" name="telefono">

                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Correo electronico de contacto" name="email">

                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje"></textarea>
            </fieldset>

            <fieldset class="sublimado" id="sublimado">
                <legend>Sublimados</legend>

                <label for="mochila">Talle de mochila</label>
                <select name="mochila" id="mochila">
                    <option value="S">Talle S</option>
                    <option value="M">Talle M</option>
                    <option value="L">Talle L</option>
                    <option value="XL">Talle XL</option>
                </select>

                <label for="foto">Foto</label>
                <p>Cargue el archivo para subimado</p>
                <input type="file" name="foto" id="foto">

                <p>En caso de que la imagen enviada no se pueda cargar</p>

                <div class="similitud">
                    <label for="igual">Adaptarla</label>
                    <input type="radio" name="similitud" value="adaptar" id="igual">

                    <label for="buscar">Buscar otra</label>
                    <input type="radio" name="similitud" value="buscar" id="buscar">
                </div>

                <div class="terminos">
                    <input type="checkbox" id="terminos" class="check-terminos">
                    <label for="terminos">Terminos y condiciones</label>
                </div>

            </fieldset>


            <input type="submit" id="sendContacto" disabled class="boton" value="ENVIAR">

        </form>
    </main>

    <?php

    include 'templates/footer.php';

    ?>

</body>

<script>
    function validarFormulario() {
        const nombre = document.getElementById("nombre").value;
        const apellido = document.getElementById("apellido").value;
        const telefono = document.getElementById("telefono").value;
        const email = document.getElementById("email").value;
        const mensaje = document.getElementById("mensaje").value;
        // const talle = document.getElementById("mochila").value;

        if (nombre.trim() === "") {
            alert("Por favor, ingrese su nombre");
            return false;
        }

        if (apellido.trim() === "") {
            alert("Por favor, ingrese su apellido");
            return false;
        }

        if (telefono.trim() === "") {
            alert("Por favor, ingrese un teléfono");
            return false;
        }

        if (email.trim() === "") {
            alert("Por favor, ingrese su email");
            return false;
        }

        if (mensaje.trim() === "") {
            alert("Por favor, ingrese un mensaje");
            return false;
        }

        return true;

    }


    //Variables para terminos
    var tyc = document.getElementById('terminos')
    var submit = document.getElementById('sendContacto');


    //Variables para armar las notificaciones
    var checkNotif = document.createElement('input');
    var labelNotif = document.createElement('label');
    var nuevoDiv = document.createElement('div');
    var fieldTerminos = document.getElementById('sublimado')


    //Seteo atributos del check de notificaciones
    checkNotif.type = "checkbox";
    checkNotif.name = "notificaciones"
    checkNotif.id = "notificaciones"
    checkNotif.className = "check-terminos"


    //Seteo atributos del label de notificacioens
    labelNotif.htmlFor = "notificaciones";
    labelNotif.appendChild(document.createTextNode("Acepta recibir notificaciones sobre nuevos productos"));


    //defino y agrego los elementos al nuevo div 
    nuevoDiv.className = "notificaciones-cont"
    nuevoDiv.id = "notificaciones"
    nuevoDiv.appendChild(checkNotif);
    nuevoDiv.appendChild(labelNotif);

    tyc.addEventListener("change", validaCheckbox);

    function validaCheckbox() {
        var checked = tyc.checked;

        if (checked) {
            submit.removeAttribute("disabled")
            submit.classList.remove('boton')
            submit.classList.add('boton-amarillo')

            sublimado.appendChild(nuevoDiv)


        } else {
            submit.classList.add('boton')
            submit.classList.remove('boton-amarillo')
            submit.setAttribute("disabled", "true")

            var divNotif = document.getElementById('notificaciones')
            divNotif.remove();
        }
    }
</script>

</html>