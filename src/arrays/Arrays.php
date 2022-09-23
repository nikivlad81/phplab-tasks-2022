<?php

namespace arrays;

class Arrays implements ArraysInterface
{

    public function repeatArrayValues(array $input): array
    {
        $result = [];

        foreach ($input as $value) {
            for ($i = 0; $i < $value; $i++) {
                $result[] = $value;
            }
        }

        return $result;
    }

    public function getUniqueValue(array $input): int
    {
        foreach (array_count_values($input) as $key => $value) {
            if ($value == 1) $result[] = $key;
        }
        return (empty($input) or empty($result)) ? 0 : min($result);
    }

    public function groupByTag(array $input): array
    {
        $result = [];
        foreach ($input as $value) {
            foreach ($value['tags'] as $tag) {
                $result[$tag][] = $value['name'];
                sort($result[$tag]);
            }
        }
        ksort($result);
        return $result;
    }
}
