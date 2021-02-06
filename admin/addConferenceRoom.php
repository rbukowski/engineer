<?php
    session_start();
    if(!isset($_SESSION['logged']) || $_SESSION['logged'] !== true){
        die('Brak dostępu!');
    }

    require_once('functions.php');

    $conferenceRoomTypes = getConferenceRoomTypes();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

    <title>Dodaj salę konferencyjną</title>
</head>

<body>
    <section id="offer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center p-4 mb-3 mt-4">Dodaj salę konferencyjną</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="form">
      <div class="container">
          <div class="row">
              <div class="col-12 p-12">
                  <form 
                    action="addOffer.php" 
                    enctype="multipart/form-data"
                    method="POST"
                    class="d-flex flex-column justify-content-between"
                  >
                      <div class="forms">
                          <p class="form-dark-label">Nazwa: <input type="text" name="name" id="conference" placeholder="Nazwa" required></p>
                          <p class="form-dark-label">Zdjęcie: <input type="file" name="photo" id="photo_conference" required></p>
                          <p class="form-dark-label">Cena za dobę: <input type="number" name="price" id="price" required></p>
                          <div class="mt-3 form-dark-label">
                              Rodzaj: 
                              <select name="type" id="conference">
                              <?php
                                  foreach ($conferenceRoomTypes as $i => $singleConferenceType) { 
                                    echo "<option value='".$singleConferenceType['id']."'>".$singleConferenceType['type']."</option>";
                                  }
                                ?>
                              </select>
                          </div>
                          <input type="text" name="submitType" class="hidden" id="conference" placeholder="Nazwa" required value="conference_rooms">
                      </div>
                      <div class="d-flex justify-content-end form-control-buttons-wrapper">
                        <button class="btn btn-success">Dodaj</button>
                        <a href="dashboard.php" class="btn btn-danger">
                          Anuluj
                        </a>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>