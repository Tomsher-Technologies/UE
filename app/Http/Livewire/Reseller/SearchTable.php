<?php

namespace App\Http\Livewire\Reseller;

use App\Models\Orders\Search;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\Rule;

final class SearchTable extends PowerGridComponent
{
    use ActionButton;

    //Messages informing success/error data is updated.
    public bool $showUpdateMessages = true;

    public string $sortField = 'created_at';
    
    public string $sortDirection = 'desc';

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): void
    {
        $this->showPerPage()
            ->showSearchInput(); 
        // ->showExportOption('download', ['excel', 'csv']);
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return  \Illuminate\Database\Eloquent\Builder<\App\Models\Orders\Search>|null
     */
    public function datasource(): ?Builder
    {
        return Search::query()
            ->where('user_id', Auth::user()->id)
            ->join('countries as from_country', 'searches.from_country', '=', 'from_country.id')
            ->join('countries as to_country', 'searches.to_country', '=', 'to_country.id')
            ->select('searches.*', 'from_country.name as from_country_name', 'to_country.name as to_country_name');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'toCountry' => [
                'name'
            ],
            'fromCountry' => [
                'name'
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('shipment_type')
            ->addColumn('package_type')
            ->addColumn('from_country_name')
            // ->addColumn('from_address_formatted', function (Search $model) {
            //     return $model->fromCountry->name;
            // })
            ->addColumn('to_country_name')
            // ->addColumn('to_address_formatted', function (Search $model) {
            //     return $model->toCountry->name;
            // })
            ->addColumn('number_of_pieces')
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', function (Search $model) {
                return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::add()
                ->title('SHIPMENT TYPE')
                ->field('shipment_type')
                ->bodyAttribute('text-capitalize')
                ->makeInputSelect(collect(
                    [
                        ['shipment_type' => 'export',  'label' => 'Export'],
                        ['shipment_type' => 'import',  'label' => 'Import'],
                        ['shipment_type' => 'tansit',  'label' => 'Tansit'],
                    ]
                ), 'label', 'shipment_type')
                ->sortable(),

            Column::add()
                ->title('PACKAGE TYPE')
                ->field('package_type')
                ->bodyAttribute('text-capitalize')
                ->makeInputSelect(collect(
                    [
                        ['package_type' => 'letter',  'label' => 'Letter / Envelope'],
                        ['package_type' => 'doc',  'label' => 'Document'],
                        ['package_type' => 'package',  'label' => 'Package / Non-Doc'],
                    ]
                ), 'label', 'package_type')
                ->sortable(),

            Column::add()
                ->title('FROM COUNTRY')
                ->field('from_country_name')
                ->makeInputText('from_country.name')
                ->sortable(),

            // Column::add()
            //     ->title('FROM COUNTRY')
            //     ->field('from_address_formatted')
            //     ->searchable()
            //     ->makeInputText('from_country.name')
            //     ->sortable(),

            Column::add()
                ->title('TO COUNTRY')
                ->field('to_country_name')
                ->searchable()
                ->makeInputText('to_country.name')
                ->sortable(),

            // Column::add()
            //     ->title('TO COUNTRY')
            //     ->field('to_address_formatted')
            //     ->searchable()
            //     ->makeInputText('to_address')
            //     ->sortable(),

            Column::add()
                ->title('NUMBER OF PIECES')
                ->field('number_of_pieces')
                ->searchable()
                ->makeInputText('searches.number_of_pieces')
                ->sortable(),

            Column::add()
                ->title('Created at')
                ->field('created_at')
                ->hidden(),

            Column::add()
                ->title('Created at')
                ->field('created_at_formatted')
                ->makeInputDatePicker('searches.created_at')
                ->searchable()
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Search Action Buttons.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Button>
     */


    public function actions(): array
    {
        return [
            Button::add('edit')
                ->caption('View Packages')
                ->class('btn btn-sm btn-primary')
                ->emit('postAdded', ['key' => 'id']),
            //    Button::add('destroy')
            //        ->caption('Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('search.destroy', ['search' => 'id'])
            //        ->method('delete')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Search Action Rules.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Rules\RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [
           
           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($search) => $search->id === 1)
                ->hide(),
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable the method below to use editOnClick() or toggleable() methods.
    | Data must be validated and treated (see "Update Data" in PowerGrid doc).
    |
    */

    /**
     * PowerGrid Search Update.
     *
     * @param array<string,string> $data
     */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = Search::query()
                ->update([
                    $data['field'] => $data['value'],
                ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status = 'error', string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field'   => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field'   => __('Error updating custom field.'),
            ]
        ];

        $message = ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);

        return (is_string($message)) ? $message : 'Error!';
    }
    */
}
