<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use App\Models\Message;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Metrics\Table;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Http\Requests\NovaRequest;

class LatestMessages extends Table
{
    /**
     * Calculate the value of the metric.
     *
     * @return array<int, \Laravel\Nova\Metrics\MetricTableRow>
     */
    public function calculate(NovaRequest $request): array
    {
        $latestMsgs = Message::latest('updated_at')->limit(5)->get();
        
        $metricRows = [];

        foreach ($latestMsgs as $msg) {


            $subtitle = $msg->content;

            $metricRows[] = MetricTableRow::make()
                ->icon('envelope')
                ->iconClass( 'text-green-500' )
                ->title($msg->name)
                ->subtitle($subtitle)
                ->actions(function () use ($msg) {
                    return [
                        MenuItem::externalLink('Ver', '/nova/resources/messages/'.$msg->id ),
                    ];
                });
        }

        return $metricRows;
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     */
    public function cacheFor(): DateTimeInterface|null
    {
        // return now()->addMinutes(5);

        return null;
    }

    /**
     * Get the displayable name of the metric
     *
     * @return string
     */
    public function name()
    {
        return __('Últimos mensajes recibidos');
    }
}
