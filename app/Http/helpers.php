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