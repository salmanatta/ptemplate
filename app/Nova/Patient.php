<?php

namespace App\Nova;

use Illuminate\Validation\Rules;
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

class Patient extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\Patient::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'skm_mr_no';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'skm_mr_no' ,'first_name'
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
            MrnSearchField::make('SKM MR No')->showOnUpdating(function (){
                return false;
            }),
            Text::make('First Name', 'first_name')
                ->sortable()
                ->rules('nullable', 'max:191')
                ->showOnUpdating(function (){
                    return true;
                }),
            Text::make('Last Name', 'last_name')
                ->sortable()
                ->rules('nullable', 'max:191')
                ->showOnUpdating(function (){
                    return true;
                }),
            Text::make('Gender', 'gender')
                ->sortable()
                ->showOnUpdating(function (){
                    return true;
                }),
            Text::make('DOB', 'dob')
                ->sortable()
                ->showOnUpdating(function (){
                    return true;
                }),
            Text::make('CNIC', 'cnic')
                ->sortable()
                ->showOnUpdating(function (){
                    return true;
                }),
//            Text::make('Passport', 'passport')
//                ->sortable()->hide(),
//            Text::make('Religion', 'religion')
//                ->sortable()->hide(),
//            Text::make('Marital Status', 'marital_status')
//                ->sortable()->hide(),
//            Text::make('Blood Group', 'blood_group')
//                ->sortable()->hide(),
//            BelongsTo::make('Country' , 'country' , Country::class)->hide()->nullable(),
//            BelongsTo::make('City' , 'city' , City::class)->hide()->nullable(),
//            BelongsTo::make('Province' , 'province' , Province::class)->hide()->nullable(),
            Text::make('Address', 'address')
                ->sortable()->showOnUpdating(function (){
                    return true;
                }),
            Text::make('Phone Number', 'phone_no')
                ->sortable()->showOnUpdating(function (){
                    return true;
                }),
            Text::make('Email', 'email')
                ->sortable()->showOnUpdating(function (){
                    return true;
                }),
            HasMany::make('Initial H&P Cardiac Surgery','hpcardiac' , HPCardiacTemplate::class)
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
