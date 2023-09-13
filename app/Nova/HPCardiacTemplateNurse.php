<?php

namespace App\Nova;

use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Pictemplate\MrnSearchField\MrnSearchField;
use App\Nova\Patient;

class HPCardiacTemplateNurse extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\HPCardiacTemplateNurse::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static $group = 'OPD Cardiac Surgery';

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
            BooleanGroup::make('Risk Factor','risk_factor')->options([
                'DM' => 'DM',
                'HTN' => 'HTN',
                'CVA' => 'CVA',
                'Smoking' => 'Smoking',
                'PAD' => 'PAD',
                'Dyslipidemia' => 'Dyslipidemia',
            ]),
            Text::make('Elevated S.Creatinine','elevated_creatinine'),
            Select::make('CSS Class','css_class')
                ->options([
                  'I' => 'I',
                  'II' => 'II',
                  'III' => 'III',
                  'IV' => 'IV',
                ])->rules('required'),
            Text::make('NYHA Class','nyha_class')->rules('required'),
            Date::make('MI Date','mi_date'),
            Date::make('PCI Date','pci_date'),
            Date::make('Previous CABG Date','previous_cabg_date'),
            Date::make('Previous Valve Date','previous_valve_date'),
            Trix::make('Past Medical History','past_medical_history_others'),
            Trix::make('General Examination','general_examination')->rules('required'),
            Text::make('CVS','cvs'),
            Text::make('Chest','chest'),
            Text::make('Extremities','extremities'),
            Trix::make('Systemic Examination','systemic_examination_others'),
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
            Text::make('Cardiac Cath Findings','cardiac_cath_findings'),
            Text::make('Carotid Duplex Left','carotid_duplex_left'),
            Text::make('Carotid Duplex Right','carotid_duplex_right'),
            Text::make('Diagnosis','diagnosis')->rules('required'),
            Text::make('Management_Plan','management_plan')->rules('required'),
            Date::make('Tentative Date Procedure','tentative_date_procedure'),
            Text::make('Followup Visit','followup_visit')->rules('required'),
            Boolean::make('Patient Education','patient_education')
                ->trueValue(true)
                ->falseValue(false)
                ->rules('required'),
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

    public static function label()
    {
        return 'H&P Initial Cardiac Surgery';
    }
}