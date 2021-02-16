<?php
    require_once __DIR__ . '/src/autoload.php';

    AuthorizationChecker::check();

    $dashboardService = new DashboardService();

    $rooms = $dashboardService->getRoomsOnAdminDashboard();
    $apartments = $dashboardService->getApartmentsOnAdminDashboard();
    $conferenceRooms = $dashboardService->getConferenceOnAdminDashboard();
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
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


    <title>Raport</title>
</head>

<body>
    <div class="container-fluid bg-dark p-3">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-3 mb-3 text-light">System do zarządzania hotelem</h3>
            </div>
        </div>
    </div>

    <!-- Adding rooms -->
    <div class="container p-3 mt-4">
        <h2 class="text-center p-4">Pokoje</h2>
        <div class="row">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">Id pokoju</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Typ</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($rooms as $singleRoom) {
                            echo "<tr>";
                            echo "<td scope='row'>" . $singleRoom['id'] . "</td>";
                            echo "<td scope='row'>" . $singleRoom['name'] . "</td>";
                            echo "<td scope='row'>"
                                . decode_multiline($singleRoom['types'])
                                . "</td>";
                            echo "<td scope='row'>" . $singleRoom['price'] . "</td>";
                            echo "<td scope='row'>
                              <button class='action-button-edit'>
                                <i class='fas fa-pen' ></i>
                              </button>
                              <button class='action-button-delete'>
                                <i class='fas fa-trash' ></i>
                              </button>
                              </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>

            <div class="row ">
                <a href="addRoom.php">
                    <button class="btn btn-success align-right">Dodaj</button>
                </a>
            </div>

        </div>
    </div>

    <!-- Adding apartments -->
    <div class="container p-3 mt-4">
        <h2 class="text-center p-4">Apartamenty</h2>
        <div class="row">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">Id apartamentu</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Typ</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($apartments as $i => $singleApartment) {
                            echo "<tr>";
                            echo "<td scope='row'>" . $singleApartment['id'] . "</td>";
                            echo "<td scope='row'>" . $singleApartment['name'] . "</td>";
                            echo "<td scope='row'>"
                                . decode_multiline($singleApartment['types'])
                                . "</td>";
                            echo "<td scope='row'>" . $singleApartment['price'] . "</td>";
                            echo "<td scope='row'>
                              <button class='action-button-edit'>
                                <i class='fas fa-pen' ></i>
                              </button>
                              <button class='action-button-delete'>
                                <i class='fas fa-trash' ></i>
                              </button>
                              </td>";

                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>

            <div class="row ">
                <a href="addApartment.php">
                    <button class="btn btn-success align-right">Dodaj</button>
                </a>
            </div>

        </div>
    </div>

    <!-- Adding conference rooms -->
    <div class="container p-3 mt-4">
        <h2 class="text-center p-4">Sale konferencyjne</h2>
        <div class="row">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">Id sali konferencyjnej</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Typ</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($conferenceRooms as $i => $singleConferenceRoom) {
                            echo "<tr>";
                            echo "<td scope='row'>" . $singleConferenceRoom['id'] . "</td>";
                            echo "<td scope='row'>" . $singleConferenceRoom['name'] . "</td>";
                            echo "<td scope='row'>"
                                . decode_multiline($singleConferenceRoom['types'])
                                . "</td>";
                            echo "<td scope='row'>" . $singleConferenceRoom['price'] . "</td>";
                            echo "<td scope='row'>
                              <button class='action-button-edit'>
                                <i class='fas fa-pen' ></i>
                              </button>
                              <button class='action-button-delete'>
                                <i class='fas fa-trash' ></i>
                              </button>
                              </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>

            <div class="row ">
                <a href="addConferenceRoom.php">
                    <button class="btn btn-success align-right">Dodaj</button>
                </a>
            </div>

        </div>
    </div>

    <div class="container-fluid bg-dark">
        <div class="row">
            <div class="col-6 p-5">
                <table class="table text-light">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Pokoje</th>
                            <th scope="col">Usuń</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">1</th>
                            <th scope="col">dwuosobowy</th>
                            <th scope="col">
                                <button
                                    class="btn btn-danger"
                                    onclick="(function(){
                                        location.href = 'delete/delete_room.php?id=1';
                                    })()"
                                >
                                    X
                                </button>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">2</th>
                            <th scope="col">jednoosobowy</th>
                            <th scope="col"><button class="btn btn-danger">X</button></th>
                        </tr>
                        <tr>
                            <th scope="col">3</th>
                            <th scope="col">czteroosobowy</th>
                            <th scope="col"><button class="btn btn-danger">X</button></th>
                        </tr>
                    </tbody>
                </table>
                <form action="addOffer.php" enctype="multipart/form-data" method="POST" class="text-white d-flex justify-content-between align-items-center">
                    <div class="forms">
                        <p>Nazwa: <input type="text" name="name" id="room" placeholder="Nazwa" required></p>
                        <p>Zdjęcie: <input type="file" name="photo" id="photo_room" required></p>
                        <p>Cena za dobę: <input type="number" name="price" id="price" required></p>
                        <div class="mt-3">
                            Rodzaj: <select name="type" id="pokoj">
                                <option value="" disabled>Pokój</option>
                                <option value="1">dwuosobowy</option>
                                <option value="2">jednoosobowy</option>
                                <option value="3">czteroosobowy</option>
                            </select>
                        </div>
                        <input type="text" name="submitType" class="hidden"  id="room" placeholder="Nazwa" required value="room">
                    </div>
                    <button class="btn btn-success">Dodaj</button>
                </form>
            </div>
            <div class="col-6 p-5">
                <table class="table text-light">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Apartamenty</th>
                            <th scope="col">Usuń</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">1</th>
                            <th scope="col">Dla dwojga</th>
                            <th scope="col"><button class="btn btn-danger">X</button></th>
                        </tr>
                        <tr>
                            <th scope="col">2</th>
                            <th scope="col">Z mini barem</th>
                            <th scope="col"><button class="btn btn-danger">X</button></th>
                        </tr>
                        <tr>
                            <th scope="col">3</th>
                            <th scope="col">Dla czterech osób</th>
                            <th scope="col"><button class="btn btn-danger">X</button></th>
                        </tr>
                    </tbody>
                </table>
                <form action="addOffer.php" enctype="multipart/form-data" method="POST" class="text-white d-flex justify-content-between align-items-center">
                    <div class="forms">
                        <p>Nazwa: <input type="text" name="name" id="apartment" placeholder="Nazwa" required></p>
                        <p>Zdjęcie: <input type="file" name="photo" id="photo_apartment" required></p>
                        <input type="text" name="submitType" class="hidden"  id="room" placeholder="Nazwa" required value="apartments">
                        <div class="mt-3">
                            Apartamenty: <select name="type" id="pokoj">
                                <option value="" disabled>Apartament</option>
                                <option value="dla_dwojga">dla dwojga</option>
                                <option value="z_barem">Z mini barem</option>
                                <option value="dla_czterech">Dla czterech osób</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-success">Dodaj</button>
                </form>
            </div>
            <div class="col-6 p-5">
                <table class="table text-light">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Sale konferencyjne</th>
                            <th scope="col">Usuń</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">1</th>
                            <th scope="col">Z telewizorem</th>
                            <th scope="col"><button class="btn btn-danger">X</button></th>
                        </tr>
                        <tr>
                            <th scope="col">2</th>
                            <th scope="col">Z tablicą interaktywną</th>
                            <th scope="col"><button class="btn btn-danger">X</button></th>
                        </tr>
                        <tr>
                            <th scope="col">3</th>
                            <th scope="col">Z projektorem</th>
                            <th scope="col"><button class="btn btn-danger">X</button></th>
                        </tr>
                    </tbody>
                </table>
                <form action="addOffer.php" enctype="multipart/form-data" method="POST" class="text-white d-flex justify-content-between align-items-center">
                    <div class="forms">
                        <p>Nazwa: <input type="text" name="name" id="apartment" placeholder="Nazwa" required></p>
                        <p>Zdjęcie: <input type="file" name="photo" id="photo_apartment" required></p>
                        <input type="text" name="submitType" class="hidden" id="room" placeholder="Nazwa" required value="conference">
                        <div class="mt-3">
                            Sale konferencyjne: <select name="type" id="pokoj">
                                <option value="" disabled>Sale konferencyjne</option>
                                <option value="z_telewizorem">Z telewizorem</option>
                                <option value="z_tablica">Z tablicą interaktywną</option>
                                <option value="z_projektorem">Z projektorem</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-success">Dodaj</button>
                </form>
            </div>
        </div>
    </div>

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
