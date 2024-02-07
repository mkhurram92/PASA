<?php

namespace App\DataTables;

use App\Models\ModeOfArrivals;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ModeOfArrivalsDataTable extends DataTable
{
    private $can_view, $can_edit;
    function __construct()
    {
        $this->can_view = Auth::user()->can("mode-of-arrival-list");
        $this->can_edit = Auth::user()->can("mode-of-arrival-edit");
    }
    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('ID'),
            Column::make('Ship Name'),
            Column::make('Year'),
            Column::make('Departure Place'),
            Column::make('Departure Date'),
            Column::make('Arrival Date in SA'),
            Column::make('Arrival Place in SA')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ModeOfArrivals_' . date('YmdHis');
    }
}
