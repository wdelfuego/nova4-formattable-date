<?php

namespace Wdelfuego\Nova4\FormattableDate\Filters;

use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter as BaseFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class DateFilter extends BaseFilter
{
    const MODES = [
        'on' => '=',
        'after' => '>',
        'afterOrOn' => '>=',
        'before' => '<',
        'beforeOrOn' => '<=',
    ];
    
    protected $column;
    protected $operator;
    
    public $name;
    
    public function __construct(string $name, string $column)
    {
        $this->name = $name;
        $this->column = $column;
        $this->on();
    }
    
    public function apply(NovaRequest $request, $query, $value)
    {
        return $query->whereDate($this->column, $this->operator, Carbon::parse($value));
    }
    
    public function default()
    {
        return null;
    }
    
    public function mode(string $mode) 
    {
        if(!array_key_exists($mode, self::MODES))
        {
            throw new \InvalidArgumentException("Invalid filter mode: " .$mode .", must be one of: " .implode(', ', array_keys(self::MODES)));
        }
        
        $this->operator = self::MODES[$mode];
        return $this;
    }
    
    public function on()            {   return $this->mode('on'); }
    public function after()         {   return $this->mode('after'); }
    public function afterOrOn()     {   return $this->mode('afterOrOn'); }
    public function before()        {   return $this->mode('before'); }
    public function beforeOrOn()    {   return $this->mode('beforeOrOn'); }
    
}
