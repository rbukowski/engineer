<?php
    require_once __DIR__ . '/../template/parts/head.php';

    // TODO: motyl dlaczego to się wywala jak sie odkomentuje po imporcie heada
//     AuthorizationChecker::check();

    $dictionaryService = new DictionaryService();
    $roomTypes = $dictionaryService->getRoomTypes();
?>

<body>
    <section id="offer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center p-4 mb-3 mt-4">Dodaj pokój</h1>
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
                          <p class="form-dark-label">Nazwa: <input type="text" name="name" id="room" placeholder="Nazwa" required></p>
                          <p class="form-dark-label">Zdjęcie: <input type="file" name="photo" id="photo_room" required></p>
                          <p class="form-dark-label">Cena za dobę: <input type="number" name="price" id="price" required></p>
                          <div class="mt-3 form-dark-label">
                              Atrybuty:
                                <select class="styled-select" name="type" id="pokoj" multiple="multiple">
                                  <?php
                                      foreach ($roomTypes as $i => $singleRoomType) {
                                        echo "<option value='".$singleRoomType['id']."'>".$singleRoomType['type']."</option>";
                                      }
                                  ?>
                                </select>
                          </div>
                          <input type="text" name="submitType" class="hidden" id="room" placeholder="Nazwa" required value="rooms">
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

    <!-- selet2 implementation -->
    <script>
      $(document).ready(function() {
        $('#pokoj').select2({
          closeOnSelect: false,
        });
      });
    </script>

</body>

</html>
