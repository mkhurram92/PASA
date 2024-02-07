<?php

namespace App\DataTables;

use App\Models\Ship;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShipDataTable extends DataTable
{
    private $can_view, $can_edit;
    function __construct()
    {
        $this->can_view = Auth::user()->can("ships-list");
        $this->can_edit = Auth::user()->can("ships-edit");
    }
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    //   public function dataTable(QueryBuilder $query): EloquentDataTable
    //    {
    //        return (new EloquentDataTable($query))
    //            ->addColumn("rig", function ($row) {
    //                return $row?->rigRelation?->name ?? "N/A";
    //            })
    //            ->addColumn('action', function ($ship) {
    //                $html = "<div class='d-flex'>";
    //                if ($this->can_view) {
    //                    $html .= '<a href="javascript:void(0)"
    //                            data-href="' . route('ship.show', ['ship' => $ship->id]) . '"
    //                            class="btn btn-default view-record">View</a>';
    //                }
    //                if ($this->can_edit) {
    //                    $html .= '<a href="javascript:void(0)"
    //                            data-href="' . route('ship.edit', ['ship' => $ship->id]) . '"
    //                            class="btn btn-info edit-record">Edit</a>';
    //                }
    //                $html .= '</div>';
    //                return $html;
    //            })
    //            ->rawColumns(["action"])
    //            ->setRowId('id');
    //   }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Ship $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    //    public function query(Ship $model): QueryBuilder
    //    {
    //        return $model->newQuery()->with(['rigRelation'])->latest()->when(!empty(request()->date), function ($q) {
    //            $dates = explode("-", request()->date);
    //            $carbonDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[0]));
    //            $startDate = $carbonDate->format('Y-m-d');
    //            $carbonDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[1]));
    //            $endDate = $carbonDate->format('Y-m-d');
    //
    //            $q->whereDate('created_at', ">=", $startDate);
    //            $q->whereDate('created_at', "<=", $endDate);
    //        });
    //    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('ship-table');
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('name_of_ship')->title('Ship Name'),
            Column::make('tonnage')->title('Tonnage'),
            Column::make('rigRelation.name')->title('Rig'),
        ];
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Ships' . date('YmdHis');
    }
}
