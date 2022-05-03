<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="dist/css/headers.css" rel="stylesheet">
        <link href="wp-content/logo.png" rel="icon">
        <script src="dist/js/jquery-3.6.0.min.js"></script>
        <script src="dist/js/bootstrap.bundle.min.js"></script>
        <title>
            Feltöltés - DaniKonyha
        </title>
    </head>

    <body style="overflow-x: hidden;">
        <main>
            <header class="p-1 bg-dark text-white">

                  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="index"><img width="80px"role="img" src="wp-content/logo.png"></a>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                      <li><a href="index" class="nav-link px-2 text-white">Kezdőlap</a></li>
                      <li><a href="foetelek" class="nav-link px-2 text-white">Főételek</a></li>
                      <li><a href="levesek" class="nav-link px-2 text-white">Levesek</a></li>
                      <li><a href="desszertek" class="nav-link px-2 text-white">Desszertek</a></li>
                      <li><a href="" class="nav-link px-2 text-secondary">Feltöltés</a></li>
                    </ul>
                  </div>

              </header>

            <br>
            <div class="container">
                <form class="my-2 mx-5" action="feltoltes.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Étel neve</label>
                        <input class="form-control" id="nev" name="nev" placeholder="Ide írd a recept nevét...">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Milyen kategóriába esik a recepted?</label>
                        <select class="form-control" id="kategoria" name="kategoria">
                        <option>Főétel</option>
                        <option>Leves</option>
                        <option>Desszert</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Hozzávalók <small><em>(vesszővel elválasztva)</em></small></label>
                        <textarea class="form-control" id="hozzavalok" name="hozzavalok" rows="3" placeholder="Ide sorold fel a hozzávalókat vesszővel elválasztva..."></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Elkészítés</label>
                        <textarea class="form-control" id="leiras" name="leiras" rows="3" placeholder="Írd le a recept elkészítésének a menetét lépésről lépésre..."></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Tölts fel egy képet az elkészült ételről! (Max. 2MB)</label>
                        <br>
                        <input type="file" class="form-control-file" id="kep" name="kep">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Beküldő neve</label>
                        <input class="form-control" id="feltolto" name="feltolto" placeholder="Ide írd neved...">
                    </div>
                    <br>
                    <button type="submit" name="submit" class="btn btn-primary">Elküldés</button>
                    <p class="text-muted "><em><small>*Naponta 5 receptet tölthetsz fel az oldalra, ezért az Elküldés gombra kattintva beleegyezel a nyilvános IP-címed tárolására az oldal adatbázisában.</small></em></p>
                </form>
            </div>
            <?php
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                require_once ('api/database.php');
                $db_adatok = new database();
                unset($sorok);
                $adatbazis = new mysqli("$db_adatok->DB_SERV", "$db_adatok->DB_USER", "$db_adatok->DB_PASSW", "$db_adatok->DB_NAME");
                $adatbazis->query("SET NAMES utf8");
                $lekerdezes = "SELECT * FROM recept";
                $eredmeny = $adatbazis->query($lekerdezes);
                while ($sorok[]=$eredmeny->fetch_array());
                $id = count($sorok)-1;

                $target_dir = "wp-content/";
                $target_file = $target_dir . basename($_FILES["kep"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                $etelNeve=$_POST["nev"];
                $kategoria=$_POST["kategoria"];
                $hozzavalok=$_POST["hozzavalok"];
                $leiras=$_POST["leiras"];
                $bekuldo=$_POST["feltolto"];
                $ip = $_SERVER['REMOTE_ADDR'];

                if($etelNeve == ""){
                    $uploadOk = 0;
                    echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            Kérlek, <strong>add meg az étel nevét!</strong></div>';
                }
                if($kategoria == ""){
                    $uploadOk = 0;
                    echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Kérlek, <strong>add meg a recept kategóriáját!</strong></div>';
                }
                if($hozzavalok == ""){
                    $uploadOk = 0;
                    echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Kérlek, <strong>sorold fel az étel hozzávalóit!</strong></div>';
                }
                if($leiras == ""){
                    $uploadOk = 0;
                    echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Kérlek, <strong>írd le az étel elkészítésének menetét!</strong></div>';
                }
                if($bekuldo == ""){
                    $uploadOk = 0;
                    echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Kérlek, <strong>add meg a neved!</strong></div>';
                }

                if($_FILES["kep"]["tmp_name"] != ""){
                    $check = getimagesize($_FILES["kep"]["tmp_name"]);
                    if($check != false) {
                        //echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            Kérlek, <strong>képet tölts fel!</strong></div>';
                        $uploadOk = 0;
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            Ez a fájl <strong>már létezik,</strong> kérlek, adj meg egy másik nevet!</div>';
                        $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["kep"]["size"] > 2000000) {
                        echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            A fájl mérete <strong>túl nagy!</strong></div>';
                        $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                        echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            Csak <strong>JPG, PNG és JPEG</strong> fájlokat kezel az oldal.</div>';
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            A recept sajnos <strong>nem került beküldésre.</strong></div>';
                        echo '<div class="alert alert-info  my-4 mx-5 text-center alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            Kérlek, próbáld <a href="feltoltes.php" class="alert-link">újra feltölteni</a> a képet.</div>';
                        // if everything is ok, try to upload file
                    } else {
                        //Ellenőrizzük, hogy a mai nap hány receptet töltött fel
                        $datum = date("Y-m-d");
                        $feltoltesekLekerdezes = "SELECT * FROM recept WHERE datum = '$datum' AND ip = '$ip'";
                        $feltoltesekEredmeny = $adatbazis->query($feltoltesekLekerdezes);
                        while ($feltoltesek[] = $feltoltesekEredmeny->fetch_array());
                        if(count($feltoltesek)-1 < 5) {
                            if (move_uploaded_file($_FILES["kep"]["tmp_name"], $target_file)) {
                                echo '<div class="alert alert-success my-4 mx-5 text-center" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    A képet (' . htmlspecialchars(basename($_FILES["kep"]["name"])) . ') <strong>sikeresen feltöltöttem.</strong></div>';
                                //SIKERES KÉPFELTÖLTÉS, TÖBBI ADATOT IS ITT KELL KEZELNI
                                $fajlnev = $_FILES["kep"]["name"];
                                $lekerdezes = "INSERT INTO `recept` (`nev`, `kep`, `hozzavalok`, `leiras`, `datum`, `feltolto`, `kategoria`, `id`, `ip`) VALUES ('$etelNeve', '$fajlnev', '$hozzavalok', '$leiras', '$datum', '$bekuldo', '$kategoria', '$id', '$ip')";
                                $eredmeny = $adatbazis->query($lekerdezes);
                            } else {
                                echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    A kép feltöltése során <strong>hiba történt! :(</strong></div>';
                                echo '<div class="alert alert-info  my-4 mx-5 text-center alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    Kérlek, próbáld <a href="feltoltes.php" class="alert-link">újra feltölteni</a> a képet.</div>';
                            }
                        }else{
                            echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                Egy nap legfejlebb <strong>5 receptet </strong> tudsz beküldeni. Próbáld újra holnap!</div>';
                        }
                    }
                }else{
                    echo '<div class="alert alert-danger my-4 mx-5 text-center alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Kérlek, <strong>tölts fel képet!</strong></div>';
                }

                if($uploadOk == 0){
                    echo '<div class="alert alert-info  my-4 mx-5 text-center alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Kérlek, próbáld <a href="feltoltes.php" class="alert-link">újra beküldeni</a> a receptet.</div>';
                }
            }
            ?>
        </main>
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <p class="col-md-4 mb-0 text-muted">© 2022 Horváth Dániel</p>

                <a href="index" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img width="60px"role="img" src="wp-content/logo.png">
                </a>

                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href="https://hdani1337.hu" target="_blank"><img src="wp-content/icon.ico" width="60px"></a></li>
                </ul>
            </footer>
        </div>
    </body>
</html>