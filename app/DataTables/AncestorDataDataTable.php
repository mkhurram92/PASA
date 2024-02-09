<?php

namespace App\DataTables;

use App\Models\AncestorData;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AncestorDataDataTable extends DataTable
{
    private $can_view, $can_edit;
    function __construct()
    {
        $this->can_view = Auth::user()->can("ancestor-list");
        $this->can_edit = Auth::user()->can("ancestor-edit");
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('ancestor-data-table');
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('#'), // Use 'id' as the field for the first column
            Column::make('ancestor_surname')->title('Surname'),
            Column::make('given_name')->title('Given Name'),
            Column::make('gender.name')->title('Gender'),
            Column::make('ships.name_of_ship')->title('Arrival Ship'),
            Column::make('departure_country')->title('Country of Origin'),
            Column::make('occupation_relation.name')->title('Occupation')
        ];
    }
    
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Ancestors' . date('YmdHis');
    }
}
