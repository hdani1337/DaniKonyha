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
            Levesek - DaniKonyha
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
                      <li><a href="" class="nav-link px-2 text-secondary">Levesek</a></li>
                      <li><a href="desszertek" class="nav-link px-2 text-white">Desszertek</a></li>
                      <li><a href="feltoltes" class="nav-link px-2 text-white">Feltöltés</a></li>
                    </ul>
                  </div>
              </header>

            <div class="row mx-2 d-flex justify-content-center" id="oldal">
                <?php
                require_once ('cgi-bin/receptSubpage.php');
                receptSubpage('leves');
                ?>
            </div>
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