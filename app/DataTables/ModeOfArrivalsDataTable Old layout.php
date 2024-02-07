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
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn("voyage", function ($row) {
                return $row?->ship?->name_of_ship . ' - ' . $row?->year ?? "N/A";
            })
            ->editColumn("notes", function ($row) {
                return $row?->notes ?? "N/A";
            })
            ->editColumn("country", function ($row) {
                return $row?->country?->name ?? "N/A";
            })
            ->editColumn("county", function ($row) {
                return $row?->county?->name ?? "N/A";
            })
            ->editColumn("city", function ($row) {
                return $row?->city?->name ?? "N/A";
            })
            ->addColumn("date_of_arrival", function ($row) {
                return $row?->date_of_arrival ?? "N/A";
            })
            ->addColumn("departure_from", function ($row) {
                return $row?->counties?->name ?? "N/A";
            })
            ->addColumn("arrived_at", function ($row) {
                return $row?->port?->name ?? "N/A";
            })
            ->addColumn('action', function ($row) {
                $html = "<div class='d-flex'>";
                if ($this->can_view) {
                    $html .= '<a href="' . route('mode-of-arrivals.show', ["mode_of_arrival" => $row?->id]) . '"
                           class="btn btn-default btn_visible view-record" style="margin-right: 5px;">View Journey</a>';
                }
                if ($this->can_edit) {
                    $html .= '<a href="' . route('mode-of-arrivals.edit', ['mode_of_arrival' => $row?->id]) . '"
                        class="btn btn-primary edit-record" style="margin-right: 5px;">Edit Journey</a>';
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
     * @param \App\Models\ModeOfArrivals $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ModeOfArrivals $model): QueryBuilder
    {
        return $model->newQuery()->orderBy("id","DESC")->with(['country','county','city', 'port', 'ship'])->when(!empty(request()->date), function ($q) {
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
            ->setTableId('modeofarrivals-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
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
            Column::make('Ship Name'),
            Column::make('Departure date'),
            Column::make('Country'),
            Column::make('County'),
            Column::make('City'),
            Column::make('Arrival Date in SA'),
            Column::make('Place of Arrival in SA'),
            // Column::make('Ship Commander'),
            // Column::make('Notes'),
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
        return 'ModeOfArrivals_' . date('YmdHis');
    }
}
