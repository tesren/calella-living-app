<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use App\Models\Unit;

class SoldUnits extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Unit::where('status', 'Vendida'));
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            7 => '7 ' . __('Días'),
            30 => '30 ' . __('Días'),
            60 => '60 ' . __('Días'),
            90 => '3 ' . __('Meses'),
            182 => '6 ' . __('Meses'),
            365 => '1 ' . __('Año'),
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
        return __('Unidades Vendidas');
    }
}
