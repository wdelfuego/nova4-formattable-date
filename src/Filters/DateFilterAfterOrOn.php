<?php

namespace Wdelfuego\Nova4\FormattableDate\Filters;

class DateFilterAfterOrOn extends DateFilter
{
    public function __construct(string $name, string $column)
    {
        parent::__construct($name, $column);
        $this->afterOrOn();
    }
}
