<?php
  require_once __DIR__ . '/../template/parts/head.php';

  $filterService = new FilterService();
  $searchService = new SearchService();

  $filters = $filterService->getFiltersByType($_GET['type'] ?? '');
  $filtersInJson = json_encode($filters);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/inz/index.html"><img src="/inz/logos/logo.png" alt="offer"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
              <a class="nav-link" href="/inz/index.html"">Home</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="search.php?type=rooms">Pokoje</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="search.php?type=apartments">Apartamenty</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="search.php?type=conference-rooms">Sale konferencyjne</a>
          </li>
      </ul>
  </div>
</nav>

<div class="container mt-10 search-page-container">
  <div class="row d-flex justify-content-center p-4">
    <div class="col-lg-4">
      <label class="filtersSectionLabel">Filtrowanie</label>
      <form id="filters-inner"></form>
      <button class="submitButton" onClick="submitFilter()">Wyszukaj oferty</button>
    </div>
    <div class="col-lg-8">
        <a id="offer-card-template" class="result-card col-lg-12 hidden" href="/inz/admin/offerDetails.php">
          <div class="card single-offer-card">
            <img
              src="https://gamingsociety.pl/wp-content/uploads/2020/03/call-of-duty-warzone-1.jpg"
              class="card-img-top"
              alt="..."
            >
            <div class="single-offer-card-body">
              <h4 class="card-text">Oferta</h4>
              <p class="price">Cena za noc: </p>
              <p class="details">Detale: </p>

            </div>
          </div>
        </a>

        <div id="loader" class="d-flex justify-content-center hidden">
          <div class="spinner-border" role="status">
            <span class="visually-hidden"></span>
          </div>
        </div>
        <div id="results"></div>
    </div>
  </div>
</div>

<?php
    asset_js('generateSearchFilters.js');
?>

<script defer>
    const filters = '<?php echo $filtersInJson;?>';
    renderFilters(filters);
</script>
