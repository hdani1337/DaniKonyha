<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="dist/css/headers.css" rel="stylesheet">
        <link href="wp-content/logo.png" rel="icon">
        <script src="dist/js/jquery-3.6.0.min.js"></script>
        <title>
            Feltöltés - DaniKonyha
        </title>
    </head>
<body>

<header class="p-1 bg-dark text-white">

        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/"><img width="80px"role="img" src="wp-content/logo.png"></a>
            
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 text-white">Kezdőlap</a></li>
                <li><a href="foetelek.php" class="nav-link px-2 text-white">Főételek</a></li>
                <li><a href="levesek.php" class="nav-link px-2 text-white">Levesek</a></li>
                <li><a href="desszertek.php" class="nav-link px-2 text-white">Desszertek</a></li>
                <li><a href="feltoltes.php" class="nav-link px-2 text-secondary">Feltöltés</a></li>
            </ul>
            
            <div class="text-end">
                <button type="button" class="btn btn-outline-light me-2">Login</button>
                <button type="button" class="btn btn-warning">Sign-up</button>
            </div>
        </div>
    </div>
</header>
<?php
    unset($sorok);
    $adatbazis = new mysqli("localhost","root","","lacikonyha");
    $adatbazis->query("SET NAMES utf8");
    $lekerdezes = "SELECT * FROM recept";
    $eredmeny = $adatbazis->query($lekerdezes);
    while ($sorok[]=$eredmeny->fetch_array());
    $id = count($sorok)-1;

    $target_dir = "wp-content/";
    $target_file = $target_dir . basename($_FILES["kep"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $etelNeve=$_POST["nev"];
        $kategoria=$_POST["kategoria"];
        $hozzavalok=$_POST["hozzavalok"];
        $leiras=$_POST["leiras"];
        $bekuldo=$_POST["feltolto"];

        if($etelNeve == ""){
            $uploadOk = 0;
            echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">Kérlek, <strong>add meg az étel nevét!</strong></div>';
        }
        if($kategoria == ""){
            $uploadOk = 0;
            echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">Kérlek, <strong>add meg a recept kategóriáját!</strong></div>';
        }
        if($hozzavalok == ""){
            $uploadOk = 0;
            echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">Kérlek, <strong>sorold fel az étel hozzávalóit!</strong></div>';
        }
        if($leiras == ""){
            $uploadOk = 0;
            echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">Kérlek, <strong>írd le az étel elkészítésének menetét!</strong></div>';
        }
        if($bekuldo == ""){
            $uploadOk = 0;
            echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">Kérlek, <strong>add meg a neved!</strong></div>';
        }

        if($_FILES["kep"]["tmp_name"] != ""){
            $check = getimagesize($_FILES["kep"]["tmp_name"]);
                if($check != false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">Kérlek, <strong>képet tölts fel!</strong></div>';
                    $uploadOk = 0;
                }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">Ez a fájl <strong>már létezik,</strong> kérlek, adj meg egy másik nevet!</div>';
                $uploadOk = 0;
                }
            
                // Check file size
                if ($_FILES["kep"]["size"] > 2000000) {
                echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">A fájl mérete <strong>túl nagy!</strong></div>';
                $uploadOk = 0;
                }
            
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">Csak <strong>JPG, PNG és JPEG</strong> fájlokat kezel az oldal.</div>';
                $uploadOk = 0;
                }
            
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">A recept sajnos <strong>nem került beküldésre.</strong></div>';
                    echo '<div class="alert alert-info  my-4 mx-5 text-center" role="alert">Kérlek, próbáld <a href="feltoltes.php" class="alert-link">újra feltölteni</a> a képet.</div>';
                    // if everything is ok, try to upload file
                } else {
                if (move_uploaded_file($_FILES["kep"]["tmp_name"], $target_file)) {
                    echo '<div class="alert alert-success my-4 mx-5 text-center" role="alert">A képet (' . htmlspecialchars( basename( $_FILES["kep"]["name"])). ') <strong>sikeresen feltöltöttem.</strong></div>';
                    //SIKERES KÉPFELTÖLTÉS, TÖBBI ADATOT IS ITT KELL KEZELNI
                    $adatbazis = new mysqli("localhost","root","","lacikonyha");
                    $adatbazis->query("SET NAMES utf8");
                    $fajlnev = $_FILES["kep"]["name"];
                    $datum = date("Y-m-d");
                    $lekerdezes = "INSERT INTO `recept` (`nev`, `kep`, `hozzavalok`, `leiras`, `datum`, `feltolto`, `kategoria`, `id`) VALUES ('$etelNeve', '$fajlnev', '$hozzavalok', '$leiras', '$datum', '$bekuldo', '$kategoria', '$id')";
                    $eredmeny = $adatbazis->query($lekerdezes);
                } else {
                    echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">A kép feltöltése során <strong>hiba történt! :(</strong></div>';
                    echo '<div class="alert alert-info  my-4 mx-5 text-center" role="alert">Kérlek, próbáld <a href="feltoltes.php" class="alert-link">újra feltölteni</a> a képet.</div>';
                }
            }
        }else{
            echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">Kérlek, <strong>tölts fel képet!</strong></div>';
        }

        if($uploadOk == 0){
            echo '<div class="alert alert-info  my-4 mx-5 text-center" role="alert">Kérlek, próbáld <a href="feltoltes.php" class="alert-link">újra beküldeni</a> a receptet.</div>';
        }
    }
?>
</body>
</html>