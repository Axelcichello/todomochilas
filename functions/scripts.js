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




