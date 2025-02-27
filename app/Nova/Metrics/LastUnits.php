<?php

namespace App\Nova\Metrics;

use App\Models\Unit;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Metrics\Table;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Http\Requests\NovaRequest;

class LastUnits extends Table
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $latestUnits = Unit::latest('updated_at')->limit(5)->get();
        
        $metricRows = [];

        foreach ($latestUnits as $listing) {

            $classArray = [
                'Disponible' => 'text-green-500',
                'Apartada' => 'text-yellow-500',
                'Vendida' => 'text-red-500',
            ];

            $subtitle = $listing->unitType->bedrooms.__(' REC '). $listing->unitType->bathrooms.' BA $'.number_format($listing->price).' '.$listing->currency.__(' | Actualizada el día: ').$listing->updated_at;

            $metricRows[] = MetricTableRow::make()
                ->icon('home')
                ->iconClass( $classArray[$listing->status] )
                ->title(__('Unidad') .' '. $listing->name)
                ->subtitle($subtitle)
                ->actions(function () use ($listing) {
                    return [
                        MenuItem::externalLink('Ver', '/nova/resources/units/'.$listing->id ),
                    ];
                });
        }

        return $metricRows;
    }

    /**
     * Get the displayable name of the metric
     *
     * @return string
     */
    public function name()
    {
        return __('Últimas unidades actualizadas');
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
}
