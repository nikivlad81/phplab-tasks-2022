<?php

namespace basics;


class BasicsValidator implements BasicsValidatorInterface
{

    public function isMinutesException(int $minute): void
    {
        if ($minute < 0 || $minute > 60) {
            throw new \InvalidArgumentException("Error! The numbers must be between 0 and 60.");
        }
    }

    public function isYearException(int $year): void
    {
        if ($year < 1900) {
            throw new \InvalidArgumentException("Error! It must be 1901 or more.");
        }
    }

    public function isValidStringException(string $input): void
    {
        if (strlen($input) !== 6 || strlen($input) > 6 || strlen(preg_replace('/\D/', '', $input)) !== 6) {
            throw new \InvalidArgumentException();
        }
    }
}