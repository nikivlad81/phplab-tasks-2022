<?php

namespace arrays;

class Arrays implements ArraysInterface {

    const NAME = 'name';
    const TAGS = 'tags';

    public function repeatArrayValues(array $input): array
    {
        $result = [];

        foreach ($input as $value) {
            for ($i=0; $i < $value; $i++) {
                $result[] = $value;
            }
        }

        return $result;
    }

    public function getUniqueValue(array $input): int
    {
        $result = array();
        if($input) {
            $arrayC = array_count_values($input);

            while ($number = current($arrayC)) {
                if ($number == 1) {
                    $result[] = key($arrayC);
                }
                next($arrayC);
            }
            if ($result) {
                return min($result);
            } else return 0;
        } else return 0;
    }

    public function groupByTag(array $input): array
    {
        $arrayTag = [];

        foreach(array_column($input, self::TAGS) as $tags) {
            $arrayTag = array_merge($arrayTag, $tags);
        }

        $arrayTag = array_unique($arrayTag);
        sort($arrayTag);

        $groupedList = [];

        foreach($arrayTag as $name)
        {
            foreach($input as $key){
                if (in_array($name, $key[self::TAGS])){
                    $groupedList[$name][] = $key[self::NAME];
                    sort($groupedList[$name]);
                }
            }
        }
        return $groupedList;
    }
}