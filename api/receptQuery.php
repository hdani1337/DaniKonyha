<?php
//Kategóriát adunk meg neki paraméterben és lekérdezi azokat a recepteket
function receptQuery($kategoria)
{
    require_once ('database.php');
    $db_adatok = new database();
    unset($sorok);
    $adatbazis = new mysqli("$db_adatok->DB_SERV", "$db_adatok->DB_USER", "$db_adatok->DB_PASSW", "$db_adatok->DB_NAME");
    $adatbazis->query("SET NAMES utf8");
    $lekerdezes = "SELECT * FROM recept WHERE kategoria = '$kategoria'";
    $eredmeny = $adatbazis->query($lekerdezes);

    while ($receptek[] = $eredmeny->fetch_array()) ;
    return $receptek;
}

//Lekérdezi az összes receptet
function receptQueryAll(){
    require_once ('database.php');
    $db_adatok = new database();
    unset($sorok);
    $adatbazis = new mysqli("$db_adatok->DB_SERV", "$db_adatok->DB_USER", "$db_adatok->DB_PASSW", "$db_adatok->DB_NAME");
    $adatbazis->query("SET NAMES utf8");
    $lekerdezes = "SELECT * FROM recept";
    $eredmeny = $adatbazis->query($lekerdezes);

    while ($receptek[] = $eredmeny->fetch_array()) ;
    return $receptek;
}
?>