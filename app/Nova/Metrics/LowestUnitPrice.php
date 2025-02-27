<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use App\Models\Unit;

class LowestUnitPrice extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->min($request, Unit::where('status', 'Disponible'), 'price')->format([
            'thousandSeparated' => true,
            'mantissa' => 2,
        ])->prefix('$');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            'ALL' => __('Todo el tiempo'),
            30 => '30 ' . __('Días'),
            60 => '60 ' . __('Días'),
            365 => '365 ' . __('Días'),
            'MTD' => __('Mes a la fecha'),
            'QTD' => __('4 meses a la fecha'),
            'YTD' => __('Año a la fecha'),
        ];
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the displayable name of the metric
     *
     * @return string
     */
    public function name()
    {
        return __('Precio mas bajo Disponible(Sin descuento)');
    }

    
}
