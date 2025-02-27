<?php

namespace App\Nova;

use App\Nova\View;
use App\Nova\Shape;
use Laravel\Nova\Panel;
use App\Models\UnitType as TypeUnit;
use App\Nova\PaymentPlan;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Tag;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\FormData;
use App\Nova\Actions\ChangeStatus;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\ChangeUnitView;
use Laravel\Nova\Fields\BelongsToMany;
use App\Nova\Actions\AssignPaymentPlan;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;

class Unit extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Unit::class;

    public function title(){
        return $this->name;
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Unidad');
    }

    public static function label()
    {
        return __('Unidades');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable()->hideFromDetail()->hideFromIndex(),

            Text::make(__('Unidad'), 'name')->rules('required', 'max:50', 'regex:/^[A-Za-z0-9\s]+$/')->sortable()->placeholder('Nombre o número de la unidad')->showOnPreview(),

            //BelongsTo::make('Torre', 'tower', Tower::class)->withoutTrashed()->rules('required')->filterable()->showCreateRelationButton(),

            BelongsTo::make(__('Sección'), 'section', Section::class)->withoutTrashed()->rules('required')->filterable(),

            Number::make(__('Piso'), 'floor')->rules('required')->min(0)->max(35)->sortable(),

            Number::make(__('Precio'), 'price')->rules('required')->min(0)->step(0.001)->sortable()->showOnPreview()
            ->displayUsing(
                function($value){
                    return '$'.number_format($value,2).' '.$this->currency;
                }
            ),

            Select::make(__('Moneda'), 'currency')->options([
                'USD' => 'USD',
                'MXN' => 'MXN',
            ])->rules('required')->default('MXN')->onlyOnForms(),

            Select::make(__('Estatus'), 'status')->options([
                'Disponible' => __('Disponible'),
                'Apartada' => __('Apartada'),
                'Vendida' => __('Vendida'),
            ])->rules('required')->default('Disponible')->onlyOnForms()->filterable()->displayUsingLabels(),

            Badge::make(__('Estatus'), 'status')->map([
                'Vendida' => 'danger',
                'Disponible' => 'success',
                'Apartada' => 'warning',
            ])->labels([
                'Disponible' => __('Disponible'),
                'Apartada' => __('Apartada'),
                'Vendida' => __('Vendida'),
            ])->sortable()->showOnPreview(),

            URL::make(__('Link de Youtube'), 'youtube_link')->rules('nullable')->hideFromIndex()->help(__('Pega el link de Youtube de la vista de la unidad'))
            ->displayUsing(
                function($value){
                    return $this->value;
                }
            ),

            Tag::make(__('Planes de pago'), 'paymentPlans', PaymentPlan::class)->hideFromIndex(),

            Images::make(__('Galería'), 'unitgallery')->hideFromIndex()/*->rules('required')*/->enableExistingMedia()->showStatistics()
            ->singleImageRules('dimensions:max_width=2000, max:2048')
            ->setFileName(function($originalFilename, $extension, $model){

                // Eliminar caracteres especiales y acentos
                $limpio = preg_replace('/[^A-Za-z0-9\-]/', '', strtr(utf8_decode($originalFilename), utf8_decode('áéíóúüñÁÉÍÓÚÜÑ'), 'aeiouunAEIOUUN'));

                // Reemplazar espacios por guiones
                $limpio = str_replace(' ', '-', $limpio);

                // Convertir a minúsculas
                $limpio = strtolower($limpio);
                
                return $limpio . '.' . $extension;

            }),

            Select::make('Orientación', 'orientation')->options([
                'Norte'  => 'Norte',
                'NorOriente' => 'NorOriente',
                'NorPoniente' => 'NorPoniente',
                'Oriente'  => 'Oriente',
                'SurOriente' => 'SurOriente',
                'Sur'  => 'Sur',
                'SurPoniente' => 'SurPoniente',
                'Poniente'  => 'Poniente',
            ]),

            Panel::make(__('Medidas'), $this->sizesFields()),

            HasOne::make(__('Polígono'), 'shape', Shape::class),
     ];
    }


    /**
     * Get the sizes fields for the resource.
     *
     * @return array
     */
    protected function sizesFields()
    {
        return [
            BelongsTo::make(__('Tipo de Unidad'), 'unitType', UnitType::class)->withoutTrashed()->rules('required')->filterable()->showOnPreview(),

            Number::make('Interior', 'interior_const')->hideFromIndex()->placeholder('Metros cuadrados del interior')->min(0)->max(99999)->rules('required')->step(0.01)
            ->displayUsing(
                function($value){
                    return $value.' m²';
                }
            )->dependsOn(
                ['unitType'],
                function (Number $field, NovaRequest $request, FormData $formData) {

                    if($formData->unitType != null){
                        $unit_type = TypeUnit::findOrFail($formData->unitType);
                        $field->setValue($unit_type->interior_const);
                    }

                }
            ),

            Number::make(__('Terraza'), 'exterior_const')->hideFromIndex()->placeholder('Metros cuadrados de la terraza')->min(0)->max(99999)->rules('required')->step(0.01)
            ->displayUsing(
                function($value){
                    return $value.' m²';
                }
            )->dependsOn(
                ['unitType'],
                function (Number $field, NovaRequest $request, FormData $formData) {

                    if($formData->unitType != null){
                        $unit_type = TypeUnit::findOrFail($formData->unitType);
                        $field->setValue($unit_type->exterior_const);
                    }

                }
            ),


            Number::make(__('Const. Total'), 'const_total')->sortable()->placeholder('Metros cuadrados totales')->min(0)->max(99999)->rules('required')->step(0.01)
            ->displayUsing(
                function($value){
                    return $value.' m²';
                }
            ),
        ];
    }

    

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            new AssignPaymentPlan,
            new ChangeStatus,
        ];
    }
}
