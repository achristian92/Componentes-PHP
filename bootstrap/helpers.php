<?php

function view($template,array $vars)
{
    extract($vars);

    $path = __DIR__.'/../views/'; //almaneceran las plantillas

    ob_start(); //activar el almacenamiento en buffer de salida

    require ($path . $template . '.php'); //atracar no mostrara al usuario

    $templateContent = ob_get_clean(); //obtener el contenido de la plantilla

    require ($path .'layout.php'); //cargar segunda plantilla
}