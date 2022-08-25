<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param  array  $airports
 * @return string[]
 */

const LIMIT = 5; // The number of values per page when sorted.
const LIMIT_ALL = 20; // Number of values per page without sorting.

function getUniqueFirstLetters(array $airports): array
{

    $letter = [];
    foreach ($airports as $value) {
        $unique[] = substr($value['name'], 0, 1);
    }

    foreach (array_unique($unique) as $item) {
        $result[] = $item;
    }

    sort($result);
    foreach ($result as $val) {
        $letter[] = $val;
    }
    return $letter;
}

/**
 * @param array $airports
 * @return array
 */

function getSort (array $airports): array
{

    foreach ($airports  as $value) {
        $airport[] = $value;
    }
    return $airport;
}

/**
 * @param array $airports,
 * @return array
 */

function getSortByFirstLetter (array $airports) : array
{

    foreach (getSort($airports) as $value ) {
        if (substr($value['name'], 0, 1) === $_GET["filter_by_first_letter"]) {
            $airport[] = $value;
        }
    }
    return $airport;
}

/**
 * @param array $airports,
 * @return array
 */

function getSortByFirstState (array $airports) : array
{

    foreach (getSort($airports) as $value ) {
        if ($value['state'] === $_GET["filter_by_state"]) {
            $airport[] = $value;
        }
    }
    return $airport;
}

/**
 * @param array $airports
 * @param string $field
 * @return array
 */

function isParamSort(array $airports, string $field): array
{

    $sortArr = array();
    foreach ($airports as $key => $val) {
        $sortArr[$key] = $val[$field];
    }

    array_multisort($sortArr, $airports);

    return $airports;
}

/**
 * @param array $airports,
 * @return array
 */

function isParam (array $airports) : array
{
    switch ($_GET) {
        case (isset($_GET["filter_by_first_letter"]) and isset($_GET["filter_by_state"]) and isset($_GET["sorting_by"])):
        {
            $airports = getSortByFirstState($airports);
            $airports = getSortByFirstLetter($airports);
            $airports = isParamSort($airports, $_GET["sorting_by"]);
            return $airports;
        }
        case (isset($_GET["filter_by_first_letter"]) and isset($_GET["filter_by_state"])):
        {
            $airports = getSortByFirstState($airports);
            $airports = getSortByFirstLetter($airports);
            return $airports;
        }
        case (isset($_GET["filter_by_first_letter"]) and isset($_GET["sorting_by"])):
        {
            $airports = getSortByFirstLetter($airports);
            $airports = isParamSort($airports, $_GET["sorting_by"]);
            return $airports;
        }
        case (isset($_GET["filter_by_state"]) and isset($_GET["sorting_by"])):
        {
            $airports = getSortByFirstState($airports);
            $airports = isParamSort($airports, $_GET["sorting_by"]);
            return $airports;
        }
        case (isset($_GET["filter_by_first_letter"])):
        {
            $airports = getSortByFirstLetter($airports);
            return $airports;
        }
        case (isset($_GET["filter_by_state"])):
        {
            $airports = getSortByFirstState($airports);
            return $airports;
        }
        case (isset($_GET["sorting_by"])):
        {
            $airports = isParamSort($airports, $_GET["sorting_by"]);
            return $airports;
        }
    } return $airports;
}

/**
 * @return string
 */

function checkParam () : string
{
    $link = '';
    if (isset($_GET["page"])) {
        $link = "?page=" . $_GET["page"];
        if (isset($_GET["filter_by_first_letter"])) {
            $link .= "&filter_by_first_letter=" . $_GET["filter_by_first_letter"];
            if (isset($_GET["filter_by_state"])) {
                $link .= "&filter_by_state=" . $_GET["filter_by_state"];
                if (isset($_GET["sorting_by"])) {
                    $link .= "&sorting_by=" . $_GET["sorting_by"];
                }
            } else if (isset($_GET["sorting_by"])) {
                $link .= "&sorting_by=" . $_GET["sorting_by"];
                if (isset($_GET["filter_by_state"])) {
                    $link .= "&filter_by_state=" . $_GET["filter_by_state"];
                }
            }
        } else if (isset($_GET["filter_by_state"])) {
            $link .= "&filter_by_state=" . $_GET["filter_by_state"];
            if (isset($_GET["filter_by_first_letter"])) {
                $link .= "&filter_by_first_letter=" . $_GET["filter_by_first_letter"];
                if (isset($_GET["sorting_by"])) {
                    $link .= "&sorting_by=" . $_GET["sorting_by"];
                }
            } else if (isset($_GET["sorting_by"])) {
                $link .= "&sorting_by=" . $_GET["sorting_by"];
                if (isset($_GET["filter_by_first_letter"])) {
                    $link .= "&filter_by_first_letter=" . $_GET["filter_by_first_letter"];
                }
            }
        } else if (isset($_GET["sorting_by"])) {
            $link .= "&sorting_by=" . $_GET["sorting_by"];
            if (isset($_GET["filter_by_state"])) {
                $link .= "&filter_by_state=" . $_GET["filter_by_state"];
                if (isset($_GET["filter_by_first_letter"])) {
                    $link .= "&filter_by_first_letter=" . $_GET["filter_by_first_letter"];
                }
            } else if (isset($_GET["filter_by_first_letter"])) {
                $link .= "&filter_by_first_letter=" . $_GET["filter_by_first_letter"];
                if (isset($_GET["filter_by_state"])) {
                    $link .= "&filter_by_state=" . $_GET["filter_by_state"];
                }
            }
        }
    }

    return $link;
}

/**
 * @return string
 */

function resetAllFilters (): string
{
    return "?page=1";
}

/**
 * @param array $airports,
 * @return array
 */

function pagination (array $airports): array
{
    if (paginationNumbers($airports) > 1) {
    $offset = limit() * ($_GET['page'] - 1);
    $outputByState = array_slice($airports, $offset, limit());
    return $outputByState;
    }
    return $airports;
}

/**
 * @param array $airports,
 * @return int
 */

function paginationNumbers (array $airports): int
{
    return intval(count($airports) / limit());
}

/**
 * @return int
 */

function limit (): int
{
    $limit = LIMIT_ALL;
    if (isset($_GET["filter_by_first_letter"]) or isset($_GET["filter_by_state"])) {
        $limit = LIMIT;
    }
    return $limit;
}

/**
 * @return string
 */

function linkForPagination (): string
{
    $link = '';
    if (isset($_GET["filter_by_first_letter"])) {
        $link .= "&filter_by_first_letter=" . $_GET["filter_by_first_letter"];
        if (isset($_GET["filter_by_state"])) {
            $link .= "&filter_by_state=" . $_GET["filter_by_state"];
        }
    } else if (isset($_GET["filter_by_state"])) {
        $link .= "&filter_by_state=" . $_GET["filter_by_state"];
        if (isset($_GET["filter_by_first_letter"])) {
            $link .= "&filter_by_first_letter=" . $_GET["filter_by_first_letter"];
        }
    }
    return $link;
}