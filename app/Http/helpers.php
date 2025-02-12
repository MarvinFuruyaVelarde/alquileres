<?php
function isActiveRoute($routeName){
    return request()->routeIs($routeName) ? '' : 'collapsed';
}
function isActiveSubMenu($routeName){
    return request()->routeIs($routeName) ? 'active' : '';
}

function mostrar($routeName){
    return request()->routeIs($routeName) ? 'show' : '';
}
function mes_texto($numero)
{
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    return $meses[$numero -1 ];
}
function mes_texto_corto($numero)
{
    $meses = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
    return $meses[$numero -1 ];
}
function convertirNumeroATexto($numero) {
    if (!is_numeric($numero)) {
        return "El valor no es un número.";
    }

    $unidades = [
        0 => "cero", 1 => "uno", 2 => "dos", 3 => "tres", 4 => "cuatro",
        5 => "cinco", 6 => "seis", 7 => "siete", 8 => "ocho", 9 => "nueve",
        10 => "diez", 11 => "once", 12 => "doce", 13 => "trece", 14 => "catorce",
        15 => "quince", 16 => "dieciséis", 17 => "diecisiete", 18 => "dieciocho", 19 => "diecinueve",
    ];
    $decenas = [
        2 => "veinte", 3 => "treinta", 4 => "cuarenta", 5 => "cincuenta",
        6 => "sesenta", 7 => "setenta", 8 => "ochenta", 9 => "noventa"
    ];
    $centenas = [
        1 => "ciento", 2 => "doscientos", 3 => "trescientos", 4 => "cuatrocientos",
        5 => "quinientos", 6 => "seiscientos", 7 => "setecientos", 8 => "ochocientos", 9 => "novecientos"
    ];

    $miles = [
        1 => "mil", 2 => "dos mil", 3 => "tres mil", 4 => "cuatro mil", 5 => "cinco mil",
        6 => "seis mil", 7 => "siete mil", 8 => "ocho mil", 9 => "nueve mil"
    ];

    $millones = [
        1 => "un millón", 2 => "dos millones", 3 => "tres millones", 4 => "cuatro millones",
        5 => "cinco millones", 6 => "seis millones", 7 => "siete millones", 8 => "ocho millones", 9 => "nueve millones"
    ];

    if ($numero < 20) {
        $numero = intval($numero);
        return $unidades[$numero];
    } elseif ($numero < 100) {
        $decena = intval($numero / 10);
        $unidad = $numero % 10;
        return $decenas[$decena] . ($unidad ? " y " . $unidades[$unidad] : "");
    } elseif ($numero < 1000) {
        $centena = intval($numero / 100);
        $resto = $numero % 100;
        return $centenas[$centena] . ($resto ? " " . convertirNumeroATexto($resto) : "");
    } elseif ($numero < 10000) {
        $mil = intval($numero / 1000);
        $resto = $numero % 1000;
        return $miles[$mil] . ($resto ? " " . convertirNumeroATexto($resto) : "");
    } elseif ($numero < 1000000) {
        $millon = intval($numero / 1000);
        $resto = $numero % 1000;
        return convertirNumeroATexto($millon) . " mil" . ($resto ? " " . convertirNumeroATexto($resto) : "");
    } elseif ($numero < 1000000000) {
        $millon = intval($numero / 1000000);
        $resto = $numero % 1000000;
        return $millones[$millon] . ($resto ? " " . convertirNumeroATexto($resto) : "");
    }

    return "Número muy grande o fuera de rango";
}