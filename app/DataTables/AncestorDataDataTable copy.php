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
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn("created_at", function ($ancestorData) {
                return date("d, F, Y h:i A", strtotime($ancestorData->created_at));
            })
            ->editColumn("mode_of_travel_native_bith", function ($ancestorData) {
                return $ancestorData?->mode_of_travel?->ship?->name_of_ship . "-" . $ancestorData?->mode_of_travel?->year;
            })
            ->editColumn("date_of_birth", function ($ancestorData) {
                return $ancestorData?->date_of_birth ?? "N/A";
            })
            ->editColumn("gender", function ($ancestorData) {
                return ucwords($ancestorData?->Gender?->name ?? "N/A");
            })
            ->editColumn("ancestor_surname", function ($ancestorData) {
                return ucwords($ancestorData?->ancestor_surname ?? "N/A");
            })
            ->addColumn("source_of_arrival", function ($ancestorData) {
                return $ancestorData?->sourceOfArrival?->name ?? "N/A";
            })
            ->editColumn("from", function ($ancestorData) {
                return $ancestorData?->county?->name;
            })
            ->editColumn("occupation", function ($ancestorData) {
                return $ancestorData?->occupation_relation?->name ?? "N/A";
            })
            ->addColumn('action', function ($ancestor) {
                $html = "<div class='d-flex'>";
                if ($this->can_view) {
                    $html .= '<a href="' . route('ancestor-data.show', ['ancestor_datum' => $ancestor?->id]) . '"
                           class="btn btn-default btn_visible view-record" style="margin-right: 5px;">View Ancestor</a>';
                }
                if ($this->can_edit) {
                    $html .= '<a href="' . route('ancestor-data.edit', ['ancestor_datum' => $ancestor?->id]) . '"
                        class="btn btn-primary edit-record" style="margin-right: 5px;">Edit Ancestor</a>';
                }
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(["action"])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AncestorData $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AncestorData $model): QueryBuilder
    {
        return $model->newQuery()->latest()->with(['mode_of_travel', 'mode_of_travel.ship', 'sourceOfArrival', 'Gender'])->when(!empty(request()->date), function ($q) {
            $dates = explode("-", request()->date);
            $carbonDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[0]));
            $startDate = $carbonDate->format('Y-m-d');

            $carbonDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[1]));
            $endDate = $carbonDate->format('Y-m-d');

            $q->whereDate('created_at', ">=", $startDate);
            $q->whereDate('created_at', "<=", $endDate);
        });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('ancestor-data-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('#'),
            Column::make('Family Name'),
            // Column::make('MAIDEN SURNAME'),
            Column::make('Given name'),
            Column::make('gender'),
            // Column::make('Source of arrival'),
            // Column::make('Mode of travel'),
            Column::make('Birth Date'),
            // Column::make('from'),
            Column::make('Occupation'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
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
