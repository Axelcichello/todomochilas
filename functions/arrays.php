<?php

//array para el menu
$menu = array('Empresa', 'Galeria', 'Contacto');

//array de caracteres especiales, se usa para el saneo
$caracteresEspeciales = array(
    "\\", "¨", "º", "-", "~",
    "#", "@", "|", "!", "\"",
    "·", "$", "%", "&", "/",
    "(", ")", "?", "'", "¡",
    "¿", "[", "^", "`", "]",
    "+", "}", "{", "¨", "´",
    ">", "< ", ";", ",", ":",
    "."
);


//Array de derrores, se va llenando dinamicamente en las validaciones cuando se encuentran arrores
$errores = array();


