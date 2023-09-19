<?php

namespace App\Nova;

use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
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
            Select::make('Reason for Visit','reason_for_visit')
                ->options([
                    'Follow Up' => 'Follow Up',
                    'Initial' => 'Initial',
                ])->rules('required'),
            Trix::make('Presenting Complaints','presenting_complaints'),
            Trix::make('History of Present Complaints','history_present_complain'),
            BooleanGroup::make('Allergies','allergies')->options([
                'Food' => 'Food',
                'Drugs' => 'Drugs',
            ]),
            Trix::make('Current Medications','current_medication')->rules('required'),
            Select::make('Martial Status','martial_status')
                ->options([
                    'Single' => 'Single',
                    'Married' => 'Married',
                    'Widowed' => 'Widowed',
                    'Divorced' => 'Divorced',
                    'Separated' => 'Separated',
                ])->rules('required'),
            Number::make('No of Children','no_of_children'),
            Select::make('Employed','employed')
                ->options([
                    'Yes' => 'Yes',
                    'No' => 'No',
                ])->rules('required'),
            Select::make('Psychological Issues','psychological_issues')
                ->options([
                    'Yes' => 'Yes',
                    'No' => 'No',
                ])->rules('required'),
            Select::make('Addictions','addictions')
                ->options([
                    'Smoking' => 'Smoking',
                    'Tobacco' => 'Tobacco',
                    'Others' => 'Others',
                ]),
            Select::make('Religion','religion')
                ->options([
                    'Islam' => 'Islam',
                    'Christianity' => 'Christianity',
                    'Hinduism' => 'Hinduism',
                    'Others' => 'Others',
                ])->rules('required'),
            Boolean::make('Privacy','privacy')
                ->trueValue(true)
                ->falseValue(false)
                ->rules('required'),
            Boolean::make('Food','food')
                ->trueValue(true)
                ->falseValue(false)
                ->rules('required'),
            Boolean::make('Male Refusal','male_refusal')
                ->trueValue(true)
                ->falseValue(false)
                ->rules('required'),
            Text::make('others'),
            BooleanGroup::make('Nutrition Assessment','nutrition_assessment')->options([
                'History of weight loss / gian in past two months' => 'Weight loss/Gain History',
                'History of hospitalization in past two months' => 'Hospitalization History',
                'Loss of Appetite' => 'Loss of Appetite',
            ]),
            Number::make('Nutrition Assessment Score','nutrition_assessment_score')->rules('required'),
            Boolean::make('Informed to duty doctor for dietitian referral if score is >= 3?','dietitian_referral_required')
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
        return 'H&P Initial Cardiac Surgery - Nursing';
    }
}
