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

    <body style="overflow-x: hidden;">
        <main>
            <header class="p-1 bg-dark text-white">

                  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/"><img width="80px"role="img" src="wp-content/logo.png"></a>
            
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                      <li><a href="index.php" class="nav-link px-2 text-white">Kezdőlap</a></li>
                      <li><a href="foetelek.php" class="nav-link px-2 text-white">Főételek</a></li>
                      <li><a href="levesek.php" class="nav-link px-2 text-white">Levesek</a></li>
                      <li><a href="desszertek.php" class="nav-link px-2 text-white">Desszertek</a></li>
                      <li><a href="#" class="nav-link px-2 text-secondary">Feltöltés</a></li>
                    </ul>
            
                    <div class="text-end">
                      <button type="button" class="btn btn-outline-light me-2">Login</button>
                      <button type="button" class="btn btn-warning">Sign-up</button>
                    </div>
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
                        <label for="exampleFormControlTextarea1">Hozzávalók</label>
                        <textarea class="form-control" id="hozzavalok" name="hozzavalok" rows="3" placeholder="Ide sorold fel a hozzávalókat..."></textarea>
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
                </form>
            </div>
            <?php
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
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

                $etelNeve=$_POST["nev"];
                $kategoria=$_POST["kategoria"];
                $hozzavalok=$_POST["hozzavalok"];
                $leiras=$_POST["leiras"];
                $bekuldo=$_POST["feltolto"];
                $ip = $_SERVER['REMOTE_ADDR'];

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
                        //Ellenőrizzük, hogy a mai nap hány receptet töltött fel
                        $datum = date("Y-m-d");
                        $feltoltesekLekerdezes = "SELECT * FROM recept WHERE datum = '$datum' AND ip = '$ip'";
                        $feltoltesekEredmeny = $adatbazis->query($feltoltesekLekerdezes);
                        while ($feltoltesek[] = $feltoltesekEredmeny->fetch_array());
                        if(count($feltoltesek)-1 < 5) {
                            if (move_uploaded_file($_FILES["kep"]["tmp_name"], $target_file)) {
                                echo '<div class="alert alert-success my-4 mx-5 text-center" role="alert">A képet (' . htmlspecialchars(basename($_FILES["kep"]["name"])) . ') <strong>sikeresen feltöltöttem.</strong></div>';
                                //SIKERES KÉPFELTÖLTÉS, TÖBBI ADATOT IS ITT KELL KEZELNI
                                $fajlnev = $_FILES["kep"]["name"];
                                $lekerdezes = "INSERT INTO `recept` (`nev`, `kep`, `hozzavalok`, `leiras`, `datum`, `feltolto`, `kategoria`, `id`, `ip`) VALUES ('$etelNeve', '$fajlnev', '$hozzavalok', '$leiras', '$datum', '$bekuldo', '$kategoria', '$id', '$ip')";
                                $eredmeny = $adatbazis->query($lekerdezes);
                            } else {
                                echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">A kép feltöltése során <strong>hiba történt! :(</strong></div>';
                                echo '<div class="alert alert-info  my-4 mx-5 text-center" role="alert">Kérlek, próbáld <a href="feltoltes.php" class="alert-link">újra feltölteni</a> a képet.</div>';
                            }
                        }else{
                            echo '<div class="alert alert-danger my-4 mx-5 text-center" role="alert">Egy nap legfejlebb <strong>5 receptet </strong> tudsz beküldeni. Próbáld újra holnap!</div>';
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
        </main>
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <p class="col-md-4 mb-0 text-muted">© 2022 Horváth Dániel</p>

                <a href="/danikonyha/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img width="60px"role="img" src="wp-content/logo.png">
                </a>

                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href="https://hdani1337.hu" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-globe2" viewBox="0 0 16 16">
                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855-.143.268-.276.56-.395.872.705.157 1.472.257 2.282.287V1.077zM4.249 3.539c.142-.384.304-.744.481-1.078a6.7 6.7 0 0 1 .597-.933A7.01 7.01 0 0 0 3.051 3.05c.362.184.763.349 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9.124 9.124 0 0 1-1.565-.667A6.964 6.964 0 0 0 1.018 7.5h2.49zm1.4-2.741a12.344 12.344 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332zM8.5 5.09V7.5h2.99a12.342 12.342 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.612 13.612 0 0 1 7.5 10.91V8.5H4.51zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741H8.5zm-3.282 3.696c.12.312.252.604.395.872.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a6.696 6.696 0 0 1-.598-.933 8.853 8.853 0 0 1-.481-1.079 8.38 8.38 0 0 0-1.198.49 7.01 7.01 0 0 0 2.276 1.522zm-1.383-2.964A13.36 13.36 0 0 1 3.508 8.5h-2.49a6.963 6.963 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667zm6.728 2.964a7.009 7.009 0 0 0 2.275-1.521 8.376 8.376 0 0 0-1.197-.49 8.853 8.853 0 0 1-.481 1.078 6.688 6.688 0 0 1-.597.933zM8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855.143-.268.276-.56.395-.872A12.63 12.63 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.963 6.963 0 0 0 14.982 8.5h-2.49a13.36 13.36 0 0 1-.437 3.008zM14.982 7.5a6.963 6.963 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008h2.49zM11.27 2.461c.177.334.339.694.482 1.078a8.368 8.368 0 0 0 1.196-.49 7.01 7.01 0 0 0-2.275-1.52c.218.283.418.597.597.932zm-.488 1.343a7.765 7.765 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z"/>
                    </svg></use></svg></a></li>
                </ul>
            </footer>
        </div>
    </body>
</html>