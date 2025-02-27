<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use App\Models\Unit;

class UnitsPerStatus extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Unit::class, 'status')
        ->colors([
            'Disponible' => '#559368',
            'Apartada' => '#D48207',
            'Vendida' => '#B50505',
        ])->label(fn ($value) => match ($value) {
            'Disponible' => __('Disponible'),
            'Apartada' => __('Apartada'),
            'Vendida' => __('Vendida'),        
        });
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
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'units-per-status';
    }

    /**
     * Get the displayable name of the metric
     *
     * @return string
     */
    public function name()
    {
        return __('Estado de las Unidades');
    }


}
