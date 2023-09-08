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
            MrnSearchField::make('SKM MR #'),
            Text::make('First Name', 'first_name')
                ->sortable()
                ->rules('nullable', 'max:191'),
            Text::make('Last Name', 'last_name')
                ->sortable()
                ->rules('nullable', 'max:191'),
            Text::make('Gender', 'gender')
                ->sortable(),
            Text::make('DOB', 'dob')
                ->sortable(),
            Text::make('CNIC', 'cnic')
                ->sortable(),
            Text::make('Passport', 'passport')
                ->sortable()->hide(),
            Text::make('Religion', 'religion')
                ->sortable()->hide(),
            Text::make('Marital Status', 'marital_status')
                ->sortable()->hide(),
            Text::make('Blood Group', 'blood_group')
                ->sortable()->hide(),
            BelongsTo::make('Country' , 'country' , Country::class)->hide(),
            BelongsTo::make('City' , 'city' , City::class)->hide(),
            BelongsTo::make('Province' , 'province' , Province::class)->hide(),
            Text::make('Address', 'address')
                ->sortable()->hide(),
            Text::make('Phone Number', 'phone_no')
                ->sortable(),
            Text::make('Email', 'email')
                ->sortable()->hide(),
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
