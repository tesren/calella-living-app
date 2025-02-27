<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class ChangeUserLang extends Action
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
        //
        foreach($models as $user){

            $user->lang = $fields->lang;
            $user->save();
        }

        return Action::message(__('Lenguaje cambiado exitosamente'));
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
            Select::make(__('Lenguaje'), 'lang')->options([
                'es' => __('Español'),
                'en' => __('Inglés'),
            ])->displayUsingLabels()->rules('required'),
        ];
    }

    /**
     * Get the displayable name of the action.
     *
     * @return string
    */
    public function name()
    {
        return __('Cambiar idioma del usuario');
    }
}
