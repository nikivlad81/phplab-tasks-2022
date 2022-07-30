<?php

namespace strings;

class Strings implements StringsInterface
{
    public function snakeCaseToCamelCase(string $input): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }

    public function mirrorMultibyteString(string $input): string
    {
        $array = explode(" ", $input);

        foreach($array as $value) {
            $string = strrev(mb_convert_encoding($value, 'UTF-16BE', 'UTF-8'));
            $new_array[] = mb_convert_encoding($string, 'UTF-8', 'UTF-16LE').' ';
        }
        return trim(implode($new_array));
    }


    public function getBrandName(string $noun): string
    {
        if (mb_substr($noun, 0, 1) !== mb_substr($noun, -1, 1)) {
            return "The " . ucfirst($noun);
        } else {
            return ucfirst($noun) . mb_substr($noun, 1);
        }
    }
}