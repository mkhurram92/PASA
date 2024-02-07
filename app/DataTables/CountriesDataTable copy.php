<?php

namespace App\DataTables;

use App\Models\Countries;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CountriesDataTable extends DataTable
{
    private $can_view, $can_edit;
    function __construct()
    {
        $this->can_view = Auth::user()->can("countries-list");
        $this->can_edit = Auth::user()->can("countries-edit");
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
            ->editColumn("name", function ($country) {
                return ucwords($country?->name ?? "N/A");
            })
            ->editColumn("code", function ($country) {
                return strtoupper($country?->code ?? "N/A");
            })
            ->editColumn("status", function ($country) {
                // Assuming "status" is a boolean attribute of your Country model
                return $country->status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($country) {
                $html = "<div class='d-flex'>";
                if ($this->can_view) {
                    $html .= '<a href="javascript:void(0)"
                            data-href="' . route('countries.show', ['country' => $country->id]) . '"
                            class="btn btn-default view-record">View</a>';
                }
                if ($this->can_edit) {
                    $html .= '<a href="javascript:void(0)"
                            data-href="' . route('countries.edit', ['country' => $country->id]) . '"
                            class="btn btn-info edit-record">Edit</a>';
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
     * @param \App\Models\Countries $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Countries $model): QueryBuilder
    {
        return $model->newQuery()->orderBy("id", "DESC");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('country-table')
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
            Column::make('#')
                ->width(50),
            Column::make('Country'),
            Column::make('Code'),
            Column::make('Status')
                ->addClass('text-center')
                ->value(function ($record) {
                    if ($record->status === 1) {
                        return 'active';
                    } else {
                        return 'inactive';
                    }
                }),
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
        return 'Countries_' . date('YmdHis');
    }
}
