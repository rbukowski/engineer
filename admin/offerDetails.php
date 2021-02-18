<?php
  require_once __DIR__ . '/../template/parts/head.php';

    // TODO: motyl dlaczego to się wywala jak sie odkomentuje po imporcie heada
    // AuthorizationChecker::check();
?>

<body>
  <section id="title">
      <div class="container">
          <div class="row">
              <div class="col-12 d-flex justify-content-between align-items-center">
                  <h4 class="p-4 mb-3 mt-4">Typ apartamentu: Nazwa</h1>
                  <button class="reservation-scroll-button">Zarezerwuj teraz</button>
              </div>
          </div>
      </div>
  </section>

  <section id="content">
      <div class="container">
          <div class="row">
              <div class="col-8 room-description">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non odio ut nisl bibendum posuere. Maecenas vehicula in ipsum id commodo. Duis sollicitudin non tortor nec pellentesque. Aenean in placerat lacus. Integer et pretium est, et ultricies augue. Maecenas bibendum faucibus purus. Duis sed mauris nec odio hendrerit molestie sit amet hendrerit ipsum. Maecenas pharetra nisi id pellentesque rutrum. Proin ut ipsum vel lacus iaculis scelerisque.
                  </br></br>
                  Vivamus convallis enim a interdum dapibus. Vivamus porta tempus urna, nec pretium dui euismod ac. Nam vulputate, eros a vehicula volutpat, enim urna blandit elit, id maximus odio nulla at felis. Mauris aliquam sapien condimentum, iaculis nulla id, tristique elit. Vivamus posuere ex at tellus viverra, quis posuere orci pharetra. Mauris ac euismod urna. In urna ipsum, pharetra eu laoreet at, ullamcorper at risus. Pellentesque aliquam, nisi ut faucibus rutrum, libero enim vestibulum enim, at egestas eros lacus vel ligula. Donec tempor egestas est, et sodales tellus pellentesque non. Nullam tincidunt, nibh id dignissim luctus, velit sem tincidunt quam, ac sollicitudin dui turpis nec arcu.
              </div>

              <div class="col-4">
                <div class="offer-hotel-logo">
                  <img src="logos/logo.png" alt="offer">
                </div>
                <div class="room-details">
                  <label>Cena za dobę:</label>
                  <div>
                    <span class="price-per-period">123</span> zł
                  </div>

                  <label class="mt-2">To pomieszczenie oferuje:</label>
                  <ul>
                    <li>Skórzane fotele</li>
                    <li>Rzutnik</li>
                    <li>Do 50 osób</li>
                    <li>Jest toaleta</li>
                  </ul>
                </div>
              </div>
          </div>
      </div>
  </section>

  <section id="content">
      <div class="container">
          <div class="row col-12 mt-4 mb-2">
            <h4>Dostępność</h3>
          </div>
          <div class="row col-12 reservation-wrapper">
            <div class="col-12">
              <label>Wybierz termin rezerwacji:</label>
            </div>
            <form class="row col-12" id="term-form">
              <div class="col-3">
                <label class="date-input-label" >Od</label>
                <input type="date" id="start" name="from" require>
              </div>
              <div class="col-3">
                <label class="date-input-label" >Do</label>
                <input type="date" id="emd" name="to" require>
              </div>
              <div class="col-6 control-buttons">
                <button
                  id="check-term-button"
                  class="check-available reservation-scroll-button"
                  onclick="checkTerm()"
                  type="button"
                >
                  Sprawdź termin
                </button>
                <button
                  id="book-button"
                  class="check-available reservation-scroll-button hidden"
                  onclick="checkTerm()"
                  type="button"
                >
                  Zarezerwuj
                </button>
              </div>
              <div class="col-12 mt-3 mb-3">
                <div id="price-result" class="hidden">
                  Cena za wybrany okres: <span class="price">---</span> zł
                </div>
                <div id="invalid" class="hidden"></div>
              </div>
            </form>
          </div>
      </div>
  </section>

  <?php
    asset_js('reservationScripts.js');
  ?>

  <!-- <script defer>
    renderFilters(filters);
  </script> -->
</body>