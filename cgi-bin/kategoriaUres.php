<?php
//Ez akkor fut le, ha egy kategóriába nincs recept feltöltve
function kategoriaUres()
{
    echo '
        <div class="alert alert-danger text-center" role="alert">
            Ebben a kategóriában sajnos még nem található recept :(<br><a href="index.php" class="alert-link">Vissza a kezdőlapra</a>
        </div>
        ';
}
?>