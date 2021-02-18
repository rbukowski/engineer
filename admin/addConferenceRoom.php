<?php
    require_once __DIR__ . '/../template/parts/head.php';

    // TODO: motyl dlaczego to się wywala jak sie odkomentuje po imporcie heada
    // AuthorizationChecker::check();

    $dictionaryService = new DictionaryService();
    $conferenceRoomTypes = $dictionaryService->getConferenceRoomTypes();
?>

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
                          <p class="form-dark-label">Cena za godzinę: <input type="number" name="price" id="price" required></p>
                          <div class="mt-3 form-dark-label">
                              Atrybuty:
                              <!-- TODO: Multiselect -->
                              <select class="styled-select" name="type[]" id="conference_select" multiple="multiple" required>
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

    <!-- selet2 implementation -->
    <script>
      $(document).ready(function() {
        $('#conference_select').select2({
          closeOnSelect: false,
        });
      });
    </script>

</body>

</html>
