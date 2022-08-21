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

function getUniqueFirstLetters(array $airports)
{
    foreach ($airports as $value) {
        $unique[] = substr($value['name'], 0, 1) . " ";
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
