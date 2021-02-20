<?php
  require_once __DIR__ . '/../template/parts/head.php';

    // TODO: motyl dlaczego to się wywala jak sie odkomentuje po imporcie heada
    // AuthorizationChecker::check();
?>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/inz/index.html"><img src="/inz/logos/logo.png" alt="offer"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="smoothScroll('#offer')">Oferta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="smoothScroll('#fun')">Rozrywka</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="smoothScroll('footer')">Kontakt</a>
            </li>
        </ul>
    </div>
  </nav>

  <section id="title" style="margin-top: 60px;">
      <div class="container">
          <div class="row">
              <div class="col-12 d-flex justify-content-between align-items-center">
                  <h4 class="p-4 mb-3 mt-4">Typ apartamentu: Nazwa</h4>
              </div>
          </div>
      </div>
  </section>

  <section id="gallery">
      <div class="container">
          <div class="row gallery-container">
              <img src="https://cf.bstatic.com/images/hotel/max1024x768/167/167534297.jpg" />
              <img src="https://www.berjayahotel.com/sites/default/files/hotel-category-offers/kualalumpur/offers-room-berjaya-times-square-hotel-kuala-lumpur.jpg" />
              <img src="https://www.gannett-cdn.com/-mm-/05b227ad5b8ad4e9dcb53af4f31d7fbdb7fa901b/c=0-64-2119-1259/local/-/media/USATODAY/USATODAY/2014/08/13/1407953244000-177513283.jpg?width=660&height=373&fit=crop&format=pjpg&auto=webp" />
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSN15Dtdnt35BDXTT_XCVA2BqbnH5ilsmggHw&usqp=CAU" />
              <img src="https://res.cloudinary.com/wegowordpress/images/f_auto,q_auto/v1564055978/shutterstock_383952736_onyu7j/shutterstock_383952736_onyu7j.jpg" />

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
                  <img src="/inz/logos/logo.png" alt="offer">
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
            <h4>Dostępność</h4>
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
                <div id="price-result" class="alert alert-primary hidden" role="alert">
                  Cena za wybrany okres: <span class="price">---</span>
                </div>
                <div id="invalid" class="alert alert-danger hidden" role="alert"></div>
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