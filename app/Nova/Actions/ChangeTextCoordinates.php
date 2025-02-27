<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class ChangeTextCoordinates extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        //cambiamos las coordenadas de cada polígono seleccionado
        foreach($models as $polygon){

            if( isset($fields->text_x) ){
                $polygon->text_x = $fields->text_x;
            }

            if( isset($fields->text_y) ){
                $polygon->text_y = $fields->text_y;
            }

            if($fields->text_y == null and $fields->text_x == null){
                return Action::danger('No ingresaste ningun valor');
            }else{
                $polygon->save();
            }
            

        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Number::make('Text X', 'text_x')->min(0)->help('Valor de la coordenada del texto en X'),
            Number::make('Text Y', 'text_y')->min(0)->help('Valor de la coordenada del texto en Y'),
        ];
    }
}
