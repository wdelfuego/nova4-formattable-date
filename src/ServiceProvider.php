<?php

namespace Wdelfuego\Nova4\FormattableDate;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laravel\Nova\Fields;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Fields\Field::macro('withDateFormat', function (string $format) {
            return Fields\Text::make($this->name, $this->attribute)
                ->exceptOnForms()
                ->displayUsing(fn ($d) => $d->format($format));
        });
    }
}
