<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class HPCardiologyTemplate extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\HPCardiologyTemplate>
     */
    public static $model = \App\Models\HPCardiologyTemplate::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $group = 'OPD Cardiology';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            ID::make()->sortable()->onlyOnDetail(),
            BelongsTo::make('Patient','patient',Patient::class)
                ->searchable(),
            Trix::make('Past Medical History','past_medical_history')->rules('required'),
            Select::make('CSS Class','css_class')
                ->options([
                    'I' => 'I',
                    'II' => 'II',
                    'III' => 'III',
                    'IV' => 'IV',
                    'NA' => 'NA',
                ])->rules('required'),
            Trix::make('General Examination','general_examination'),
            Trix::make('CVC','cvc'),
            Trix::make('Chest','chest'),
            Trix::make('Abdomen','abdomen'),
            Trix::make('Extremities','extremities'),
            Trix::make('Neuro','neuro'),
            Trix::make('Investigation','investigation'),
            Trix::make('Diagnosis','diagnosis')->rules('required'),
            Trix::make('Management Plan','management_plan')->rules('required'),
            Date::make('Procedure Date','procedure_date'),
            Select::make('Follow Up Visit','followup_visit')
                ->options([
                    '1 week' => '1 week',
                    '2 week' => '2 week',
                    '1 Months' => '1 Months',
                    '6 Months' => '6 Months',
                    '1 Year' => '1 Year',
                ])->rules('required'),
            Boolean::make('Patient Educated ?','patient_education')
                ->trueValue(true)
                ->falseValue(false)
                ->rules('required'),


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
        return [];
    }
}
