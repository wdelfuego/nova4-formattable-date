This library reintroduces custom DateTime formatting to DateTime fields in Nova 4 resources and comes with a couple of custom filters to circumvent the issues described in [this discussion](https://github.com/laravel/nova-issues/discussions/3929).

## Installation
Add the dependency to your project's `composer.json`:
```sh
composer require wdelfuego/nova4-formattable-date
```
  
## Usage
### Formatting
In your Nova resource's `fields` method, add a `DateTime` field as usual but add a call to `withDateFormat` to set the format you want to show on Index and Resource views:

```
    Fields\DateTime::make(__('Created at'), 'created_at')
        ->withDateFormat('d-M-Y, H:i'),
```

This field will automatically be hidden from Nova's forms, so add another `DateTime` field without `withDateFormat` for the same attribute so your end users can edit the field on forms:

```
    Fields\DateTime::make(__('Created at'), 'created_at')
        ->onlyOnForms(),
```

The field with the custom date format can be made `sortable` as usual, but the `filterable` option doesn't work in combination with the custom date format, so if you want to allow end users to filter the Index view based on the formatted `DateTime` column, see the next section for adding the custom filters that come with this package.


### Filtering 

This package comes with 5 different filters:
- `DateFilter` only shows items whose date match the filter value
- `DateFilterAfter` only shows items whose date is later than the filter value
- `DateFilterAfterOrOn` only shows items whose date is later than or on the same date as the filter value
- `DateFilterBefore` only shows items whose date is earlier than the filter value
- `DateFilterBeforeOrOn` only shows items whose date is earlier than or on the same date as the filter value

You can add a combination of these filters to the Nova resource to allow end users to define a date range.

To add the filters to your Nova resource, first add `use` statements for the filters you need to the resource file:
```
use Wdelfuego\Nova4\FormattableDate\Filters\DateFilter;
use Wdelfuego\Nova4\FormattableDate\Filters\DateFilterAfter;
use Wdelfuego\Nova4\FormattableDate\Filters\DateFilterAfterOrOn;
use Wdelfuego\Nova4\FormattableDate\Filters\DateFilterBefore;
use Wdelfuego\Nova4\FormattableDate\Filters\DateFilterBeforeOrOn;
```

Then use in your resource's `filters` method as follows:
```
    public function filters(NovaRequest $request)
    {
        return [
            new DateFilterAfter(__('After'), 'created_at'),
            new DateFilterBefore(__('Before'), 'created_at'),
        ];
    }
```

This example effectively creates a date range filter, you can also filter for specific dates only (using a single `DateFilter`) or force open-ended range filtering by adding just one of the other four filters.