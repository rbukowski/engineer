<?php
  require_once __DIR__ . '/../template/parts/head.html';
  require_once __DIR__ . '/src/autoload.php';


  $filterService = new FilterService(PDOBuilder::getInstance());
  $searchService = new SearchService(PDOBuilder::getInstance());

  $filters = $filterService->getFiltersByType($_GET['type'] ?? '');
  $elements = $searchService->searchByType(
      $_GET['type'] ?? '',
      $_GET['filterTypeIds'] ?? []
  );

  echo json_encode([
    'filters' => $filters,
    'elements' => $elements,
  ]);exit;
?>

<div class="container">
  <div class="row">
      <div class="col-12">
          <h1 class="text-center p-4 mb-3 mt-4">Wykurwiarka :D</h1>
      </div>
  </div>
  <div class="row d-flex justify-content-center p-4">
      <div class="col-lg-4">
          <a class="card-link" href="admin/search.php?type=apartments">
              <div class="card">
                  <img src="asset/offer/1.jpg" alt="offer">
                  <div class="card-body">
                      <h4 class="text-center p-3">Apartamenty</h4>
                      <p>Luksusowe aparamenty z pełnym wyposażeniem i mini barem.</p>
                  </div>
              </div>
          </a>
      </div>
      <div class="col-lg-8">
          <a class="card-link" href="/inz/index.html">
              <div class="card">
                  <img src="asset/offer/2.jpg" alt="offer">
                  <div class="card-body">
                      <h4 class="text-center p-3">Pokoje</h4>
                      <p>Pokoje do wynajęcia.</p>
                  </div>
              </div>
          </a>
      </div>
  </div>
</div>
