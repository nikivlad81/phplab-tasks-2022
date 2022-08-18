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
        return implode(' ', array_reverse(explode(' ', implode(array_reverse(mb_str_split($input))))));
    }

    public function getBrandName(string $noun): string
    {
        return (mb_substr($noun, 0, 1) !== mb_substr($noun, -1, 1)) ?  "The " . ucfirst($noun) : ucfirst($noun) . mb_substr($noun, 1);
    }
}