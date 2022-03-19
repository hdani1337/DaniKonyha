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
            DaniKonyha
        </title>
    </head>
    <body style="overflow-x: hidden;">
        <main>
            <header class="p-1 bg-dark text-white">

                  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                  <a href="/"><img width="80px"role="img" src="wp-content/logo.png"></a>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                      <li><a href="#" class="nav-link px-2 text-secondary">Kezdőlap</a></li>
                      <li><a href="foetelek.php" class="nav-link px-2 text-white">Főételek</a></li>
                      <li><a href="levesek.php" class="nav-link px-2 text-white">Levesek</a></li>
                      <li><a href="desszertek.php" class="nav-link px-2 text-white">Desszertek</a></li>
                      <li><a href="feltoltes.php" class="nav-link px-2 text-white">Feltöltés</a></li>
                    </ul>
            
                    <div class="text-end">
                      <button type="button" class="btn btn-outline-light me-2">Login</button>
                      <button type="button" class="btn btn-warning">Sign-up</button>
                    </div>
                  </div>

              </header>

              <br>

            <div class="row mx-2">
                <!--FŐ DIV-->
                <?php
                    $adatbazis = new mysqli("localhost","root","","lacikonyha");
                    $adatbazis->query("SET NAMES utf8");
                    $lekerdezes = "SELECT * FROM recept";
                    $eredmeny = $adatbazis->query($lekerdezes);

                    while ($sorok[]=$eredmeny->fetch_array());

                    echo '
                    <div class="col-4">
                        <div class="card">
                            <img class="card-img-top" src="wp-content/' . $sorok[count($sorok)-2][1] . '" alt="' . $sorok[count($sorok)-2][1] .'">
                            <div class="card-body">
                                <h4 class="card-title">'.$sorok[count($sorok)-2][0].' <span class="badge bg-primary">Új</span></h4>
                                <p class="card-text">'.'

                                <!--FELTÖLTŐ EMBER IKONNAL-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg> '.$sorok[count($sorok)-2][5].'<br>'.'

                                <!--DÁTUM NAPTÁR IKONNAL-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                </svg> '.$sorok[count($sorok)-2][4].'</p>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal'.$sorok[count($sorok)-2][7].'">Mutasd a receptet</button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal" id="Modal'.$sorok[count($sorok)-2][7].'">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">'.$sorok[count($sorok)-2][0].'</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <img class="img-fluid rounded" src="wp-content/' . $sorok[count($sorok)-2][1] . '" alt="' . $sorok[count($sorok)-2][1] .'">
                                <br><br><strong>Hozzávalók: </strong>'.$sorok[count($sorok)-2][2].'
                                <br><br><strong>Elkészítés: </strong>'.$sorok[count($sorok)-2][3].'
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Bezárás</button>
                            </div>

                            </div>
                        </div>
                    </div>
                ';
                ?>    
                <!--OLDALSÓ KISEBB RECEPTEK-->                   
                <div class="col-8">
                    <div class="row" id="oldal">
                        <?php
                            unset($sorok);
                            $adatbazis = new mysqli("localhost","root","","lacikonyha");
                            $adatbazis->query("SET NAMES utf8");
                            $lekerdezes = "SELECT * FROM recept";
                            $eredmeny = $adatbazis->query($lekerdezes);
    
                            while ($sorok[]=$eredmeny->fetch_array());

                            for($i=count($sorok)-3;$i>=0;$i--){
                                echo '
                                <div class="col-3">
                                    <div class="card">
                                        <img class="card-img-top" src="wp-content/' . $sorok[$i][1] . '" alt="' . $sorok[$i][1] .'">
                                        <div class="card-body">
                                            <h4 class="card-title">'.$sorok[$i][0].'</h4>
                                            <p class="card-text">'.'

                                            <!--FELTÖLTŐ EMBER IKONNAL-->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                            </svg> '.$sorok[$i][5].'<br>'.'

                                            <!--DÁTUM NAPTÁR IKONNAL-->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg> '.$sorok[$i][4].'</p>

                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal'.$sorok[$i][7].'">Mutasd a receptet</button>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal" id="Modal'.$sorok[$i][7].'">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">'.$sorok[$i][0].'</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <img class="img-fluid rounded" src="wp-content/' . $sorok[$i][1] . '" alt="' . $sorok[$i][1] .'">
                                            <br><br><strong>Hozzávalók: </strong>'.$sorok[$i][2].'
                                            <br><br><strong>Elkészítés: </strong>'.$sorok[$i][3].'
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Bezárás</button>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            ';
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>