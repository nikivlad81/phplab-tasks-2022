<?php
require_once './functions.php';

$airports = require './airports.php';
//var_dump($_GET);
$newAirports = $airports;

if (isset($_GET["filter_by_first_letter"])) {
    array_splice($newAirports, 0);

    foreach ($airports as $value) {

        if (substr($value['name'], 0, 1) === $_GET["filter_by_first_letter"]) {
            $newAirports[] = $value;
        }
    }
    if (count($newAirports) <= 5 ) {$_GET['page'] =1;}
}

if ($_GET["filter_by_state"]) {
    $_GET["filter_by_first_letter"] = '';
    foreach ($airports as $value) {

        if ($value['state'] === $_GET["filter_by_state"]) {
            $newAirportsByState[] = $value;
        }
    }
    if (count($newAirports) <= 5 ) {$_GET['page'] =1;}
}


// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 */

// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 */

// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B

        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->
    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach (getUniqueFirstLetters(require './airports.php') as $letter): ?>
            <a href="?page=<?= $_GET['page'] ?>&filter_by_first_letter=<?=trim($letter)?>&filter_by_state=<?= $_GET['filter_by_state'] ?>"><?= $letter ?></a>
        <?php endforeach; ?>

        <a href="/src/web/?page=1&filter_by_first_letter=&filter_by_state=" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc

        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="#">Name</a></th>
            <th scope="col"><a href="#">Code</a></th>
            <th scope="col"><a href="#">State</a></th>
            <th scope="col"><a href="#">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B

            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 5;
        $offset = $limit * ($page -1);

        if ($_GET["filter_by_state"]) {
            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            $total_pages = round(count($newAirportsByState) / $limit, 0, PHP_ROUND_HALF_DOWN);

            $outputByState = array_slice($newAirportsByState, $offset, $limit);
            foreach ($outputByState as $airport): ?>
                <tr>
                    <td><?= $airport['name'] ?></td>
                    <td><?= $airport['code'] ?></td>
                    <td><a href="?page=<?= $_GET['page'] ?>&filter_by_first_letter=<?= $_GET['filter_by_first_letter'] ?>&filter_by_state=<?= $airport['state'] ?>"><?= $airport['state'] ?></a></td>
                    <td><?= $airport['city'] ?></td>
                    <td><?= $airport['address'] ?></td>
                    <td><?= $airport['timezone'] ?></td>
                </tr>
            <?php endforeach; } else

        if ($_GET["filter_by_first_letter"]) {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

            $total_pages = round(count($newAirports) / $limit, 0, PHP_ROUND_HALF_DOWN);

            $output = array_slice($newAirports, $offset, $limit);
            foreach ($output as $airport): ?>
                <tr>
                    <td><?= $airport['name'] ?></td>
                    <td><?= $airport['code'] ?></td>
                    <td><a href="?page=<?= $_GET['page'] ?>&filter_by_first_letter=<?= $_GET['filter_by_first_letter'] ?>&filter_by_state=<?= $airport['state'] ?>"><?= $airport['state'] ?></a></td>
                    <td><?= $airport['city'] ?></td>
                    <td><?= $airport['address'] ?></td>
                    <td><?= $airport['timezone'] ?></td>
                </tr>
            <?php endforeach; } else {
            $limit = 20;
            $total_pages = round(count($airports) / $limit, 0, PHP_ROUND_HALF_DOWN);

            $output = array_slice($airports, $offset, $limit);

        foreach ($output as $airport): ?>
            <tr>
                <td><?= $airport['name'] ?></td>
                <td><?= $airport['code'] ?></td>
                <td><a href="?page=<?= $_GET['page'] ?>&filter_by_first_letter=<?= $_GET['filter_by_first_letter'] ?>&filter_by_state=<?= $airport['state'] ?>"><?= $airport['state'] ?></a></td>
                <td><?= $airport['city'] ?></td>
                <td><?= $airport['address'] ?></td>
                <td><?= $airport['timezone'] ?></td>
            </tr>
        <?php endforeach; } ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied

        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset

         /?page=1&filter_by_first_letter=Q
    -->

    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <?php if ($total_pages > 2) {
            for ($i=1; $i<$total_pages; $i++) {

                ?>
            <li class="page-item <?php if ($_GET['page'] == $i) { echo "active"; }; ?>"><a class="page-link" href="?page=<?php echo $i ?>&filter_by_first_letter=<?= $_GET['filter_by_first_letter'] ?>&filter_by_state=<?= $_GET['filter_by_state'] ?>"><?php echo $i ?></a></li>
            <?php } }?>

        </ul>
    </nav>

</main>
</html>
