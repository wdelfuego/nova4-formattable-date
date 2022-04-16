<?php

namespace Wdelfuego\Nova4\FormattableDate\Filters;

class DateFilterBeforeOrOn extends DateFilter
{
    public function __construct(string $name, string $column)
    {
        parent::__construct($name, $column);
        $this->beforeOrOn();
    }
}
