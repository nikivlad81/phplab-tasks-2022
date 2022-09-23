<?php

namespace basics;

class Basics implements BasicsInterface
{
    private BasicsValidator $validator;

    public function __construct(BasicsValidator $validator)
    {
        $this->validator = $validator;
    }

    public function getMinuteQuarter(int $minute): string
    {
        $this->validator->isMinutesException($minute);

        switch ($minute) {
            case ($minute > 45 && $minute < 60):
            case 0:
                return 'fourth';
            case ($minute > 0 && $minute < 16):
                return 'first';
            case ($minute > 15 && $minute < 31):
                return 'second';
            case ($minute > 30 && $minute < 46):
                return 'third';
        }
    }

    public function isLeapYear(int $year): bool
    {
        $this->validator->isYearException($year);

        return ((!($year % 4) && ($year % 100)) || !($year % 400));
    }

    public function isSumEqual(string $input): bool
    {
        $this->validator->isValidStringException($input);

        $split = str_split($input, 3);

        return array_sum(str_split($split[0])) === array_sum(str_split($split[1]));
    }
}
