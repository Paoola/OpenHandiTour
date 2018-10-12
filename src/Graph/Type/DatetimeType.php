<?php

namespace App\Graph\Type;

class DatetimeType extends DateType
{
    /**
     * @param \DateTime $value
     *
     * @return string
     */
    public function serialize($value)
    {
        return $value->format('c');
    }

    public static function getAliases()
    {
        return ['Datetime'];
    }
}
