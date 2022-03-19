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

            <form class="my-2 mx-5" action="upload.php" method="post" enctype="multipart/form-data">
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
        </main>
    </body>
</html>