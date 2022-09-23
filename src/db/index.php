<?php
/**
 * Connect to DB
 */
/** @var \PDO $pdo */
require_once './pdo_ini.php';

$airports = [];
$sql = "SELECT a.name, a.code, c.name AS city_id, s.name AS state_id, a.address, a.timezone FROM airports a LEFT OUTER JOIN cities c ON a.city_id = c.id JOIN states s ON a.state_id = s.id ";
if (isset($_GET["filter_by_state"])) {
    $states = $_GET["filter_by_state"];
    $sql = "SELECT a.name, a.code, c.name AS city_id, s.name AS state_id, a.address, a.timezone FROM airports a LEFT OUTER JOIN cities c ON a.city_id = c.id JOIN states s ON a.state_id = s.id WHERE s.name LIKE '$states%'";
}
if (isset($_GET["filter_by_first_letter"])) {
    $letters = $_GET["filter_by_first_letter"];
    $sql = "SELECT a.name, a.code, c.name AS city_id, s.name AS state_id, a.address, a.timezone FROM airports a LEFT OUTER JOIN cities c ON a.city_id = c.id JOIN states s ON a.state_id = s.id WHERE a.name LIKE '$letters%' ";
}

if (isset($_GET["filter_by_first_letter"]) and isset($_GET["filter_by_state"])) {
    $sql = "SELECT a.name, a.code, c.name AS city_id, s.name AS state_id, a.address, a.timezone FROM airports a LEFT OUTER JOIN cities c ON a.city_id = c.id JOIN states s ON a.state_id = s.id WHERE s.name LIKE '$states' AND a.name LIKE '$letters%' ";
}

function createArray($sql, $pdo): array
{
    $airports = [];
    if ($result = $pdo->query($sql)) {
        while ($row = $result->fetch()) {
            array_push($airports, [
                "name" => $row['name'],
                "code" => $row['code'],
                "city" => $row['city_id'],
                "state" => $row['state_id'],
                "address" => $row['address'],
                "timezone" => $row['timezone'],]);
        }
    }
    return $airports;
}

$airports = createArray($sql, $pdo);
$count = count($airports);
$sql = paginationNew($sql);
$airports = createArray($sql, $pdo);

if (isset($_GET["sorting_by"])) {
    $sql = sorting($sql);
    $airports = createArray($sql, $pdo);
}

function linkNew(): string
{
    foreach ($_GET as $key => $value) {
        $key == "page" ? $link = "?page=" . $_GET["page"] : $link .= "&$key" . "=$value";
    }
    return $link;
}

/**
 * SELECT the list of unique first letters using https://www.w3resource.com/mysql/string-functions/mysql-left-function.php
 * and https://www.w3resource.com/sql/select-statement/queries-with-distinct.php
 * and set the result to $uniqueFirstLetters variable
 */

// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 *
 * For filtering by first_letter use LIKE 'A%' in WHERE statement
 * For filtering by state you will need to JOIN states table and check if states.name = A
 * where A - requested filter value
 */

// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 *
 * For sorting use ORDER BY A
 * where A - requested filter value
 */

function sorting($sql)
{
    $pieces = explode('LIMIT', $sql);
    switch ($_GET["sorting_by"]) {
        case ($_GET["sorting_by"] == 'name'):
            $sql = $pieces[0] . 'ORDER BY a.name LIMIT' . $pieces[1];
            break;
        case ($_GET["sorting_by"] == 'code'):
            $sql = $pieces[0] . 'ORDER BY a.code LIMIT' . $pieces[1];
            break;
        case ($_GET["sorting_by"] == 'state'):
            $sql = $pieces[0] . 'ORDER BY state_id LIMIT' . $pieces[1];
            break;
        case ($_GET["sorting_by"] == 'city'):
            $sql = $pieces[0] . 'ORDER BY city_id LIMIT' . $pieces[1];
            break;
    }

    return $sql;
}

// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 *
 * For pagination use LIMIT
 * To get the number of all airports matched by filter use COUNT(*) in the SELECT statement with all filters applied
 */

function paginationNew($sql)
{
    isset($_GET["page"]) ? $page = $_GET["page"] : $page = 1;
    $offset = limitNew() * ($page - 1);
    $sql .= "LIMIT " . limitNew() . " OFFSET $offset";
    return $sql;
}

function limitNew(): int
{
    $limit = 20;
    if (isset($_GET["filter_by_first_letter"]) or isset($_GET["filter_by_state"])) $limit = 5;
    return $limit;
}

/**
 * Build a SELECT query to DB with all filters / sorting / pagination
 * and set the result to $airports variable
 *
 * For city_name and state_name fields you can use alias https://www.mysqltutorial.org/mysql-alias/
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>
    <link rel="shortcut icon" href="../web/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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

        <?php
        $sql = "SELECT DISTINCT LEFT(name, 1) FROM cities GROUP BY name; ";
        if ($result = $pdo->query($sql)) {
            while ($row = $result->fetch()) {
                $letter[] = $row[0];
            }
        }
        foreach ($letter as $value): ?>
            <a href="<?= linkNew() ?>&filter_by_first_letter=<?= $value ?>"><?= $value ?></a>
        <?php endforeach; ?>
        <a href="?page=1" class="float-right">Reset all filters</a>
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
            <th scope="col"><a href="<?= linkNew() ?>&sorting_by=name">Name</a></th>
            <th scope="col"><a href="<?= linkNew() ?>&sorting_by=code">Code</a></th>
            <th scope="col"><a href="<?= linkNew() ?>&sorting_by=state">State</a></th>
            <th scope="col"><a href="<?= linkNew() ?>&sorting_by=city">City</a></th>
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
        <?php foreach ($airports as $airport): ?>
            <tr>
                <td><?= $airport['name'] ?></td>
                <td><?= $airport['code'] ?></td>
                <td><a href="<?= linkNew() ?>&filter_by_state=<?= $airport['state'] ?>"><?= $airport['state'] ?></a>
                </td>
                <td><?= $airport['city'] ?></td>
                <td><?= $airport['address'] ?></td>
                <td><?= $airport['timezone'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied
        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <?php
    function param()
    {
        $link = null;
        foreach ($_GET as $key => $value) {
            if ($key !== 'page') $link .= "&$key" . "=$value";
        }
        return $link;
    }

    ?>
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i < count($airports); $i++) { ?>
                <li class="page-item <?php if (isset($_GET['page']) and $_GET['page'] == $i) echo "active"; ?>"><a
                            class="page-link" href="?page=<?php echo $i . param(); ?>"><?php echo $i ?></a></li>
            <?php } ?>
        </ul>
    </nav>
</main>
</html>
