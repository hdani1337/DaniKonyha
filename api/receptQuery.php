<?php
//Kategóriát adunk meg neki paraméterben és lekérdezi azokat a recepteket
function receptQuery($kategoria)
{
    unset($sorok);
    $adatbazis = new mysqli("localhost", "root", "", "lacikonyha");
    $adatbazis->query("SET NAMES utf8");
    $lekerdezes = "SELECT * FROM recept WHERE kategoria = '$kategoria'";
    $eredmeny = $adatbazis->query($lekerdezes);

    while ($receptek[] = $eredmeny->fetch_array()) ;
    return $receptek;
}

//Lekérdezi az összes receptet
function receptQueryAll(){
    unset($sorok);
    $adatbazis = new mysqli("localhost", "root", "", "lacikonyha");
    $adatbazis->query("SET NAMES utf8");
    $lekerdezes = "SELECT * FROM recept";
    $eredmeny = $adatbazis->query($lekerdezes);

    while ($receptek[] = $eredmeny->fetch_array()) ;
    return $receptek;
}
?>