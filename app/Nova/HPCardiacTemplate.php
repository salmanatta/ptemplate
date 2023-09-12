<?php

namespace App\Nova;

use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Pictemplate\MrnSearchField\MrnSearchField;
use App\Nova\Patient;

class HPCardiacTemplate extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\HPCardiacTemplate::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name'
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
            Boolean::make('DM','dm')
                ->trueValue(true)
                ->falseValue(false),
            Boolean::make('HTN','htn')
                ->trueValue(true)
                ->falseValue(false),
            Boolean::make('CVA','cva')
                ->trueValue(true)
                ->falseValue(false),
            Boolean::make('Smoking','smoking')
                ->trueValue(true)
                ->falseValue(false),
            Boolean::make('PAD','pad')
                ->trueValue(true)
                ->falseValue(false),
            Boolean::make('Dyslipidemia','dyslipidemia')
                ->trueValue(true)
                ->falseValue(false),
            Text::make('Elevated S.Creatinine','elevated_creatinine'),
            Text::make('CSS Class','css_class'),
            Text::make('NYHA Class','nyha_class'),
            Date::make('MI Date','mi_date'),
            Date::make('PCI Date','pci_date'),
            Date::make('Previous CABG Date','previous_cabg_date'),
            Date::make('Previous Valve Date','previous_valve_date'),
            Textarea::make('Past Medical History','past_medical_history_others')->rows(3),
            Textarea::make('General Examination','general_examination')->rows(3),
            Text::make('CVS','cvs'),
            Text::make('Chest','chest'),
            Text::make('Extremities','extremities'),
            Textarea::make('Systemic Examination','systemic_examination_others')->rows(3),
            Text::make('INR','inr'),
            Text::make('HbA1C','hba1c'),
            Text::make('TAG','tag'),
            Text::make('HDL','hdl'),
            Text::make('LDL','ldl'),
            Text::make('Cholestrol','cholestrol'),
            Text::make('Chest X-Ray','chest_xray'),
            Text::make('ECG','ecg'),
            Date::make('ECHO Date','echo_date'),
            Text::make('LVEF','lvef'),
            Date::make('Cardiac Cath Date','cardiac_cath_date'),
            Text::make('Cardiac Cath Findings','cardiac_cath_findings')




        ];
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
