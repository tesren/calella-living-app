<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Select;
use App\Models\PaymentPlan;
use App\Models\PaymentPlan_Unit;

class AssignPaymentPlan extends Action
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
        foreach($models as $unit){
            
            $relation = new PaymentPlan_Unit();

            $relation->unit_id = $unit->id;
            $relation->payment_plan_id = $fields->paymentPlan;

            foreach($unit->paymentPlans as $plan){
                if($plan->id == $fields->paymentPlan){
                    return Action::danger('La Unidad '.$unit->name.' ya tiene ese plan de pago');
                }
            }

            $relation->save();
            
        }

        return Action::message(__('Planes de Pagos Asignados'));
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
            Select::make(__('Plan de pago'), 'paymentPlan')->options(
                function(){
                    $plans = PaymentPlan::all();
                    $arrayPlans = [];

                    foreach($plans as $plan){
                        $arrayPlans[$plan->id] = $plan->name ;
                    }

                    return $arrayPlans;
                }
            ),
        ];
    }

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Asignar plan de pagos');
    }
}
