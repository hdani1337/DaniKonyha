<?php
//Ide csak a kategóriát kell átadni paraméterben, és megcsinálja a kategória oldalának receptjeit
function receptSubpage($kategoria){
    require_once ('cgi-bin/receptKartya.php');
    require_once ('cgi-bin/kategoriaUres.php');
    require_once ('api/receptQuery.php');
    $receptek = receptQuery($kategoria);
    if(count($receptek)>1){
        for($i=count($receptek)-2;$i>=0;$i--){
            echo ' <div class="col-lg-2 pt-4">';
            kartya($receptek[$i]);
            echo  '</div>';
        }
    }else{
        kategoriaUres();
    }
}
?>