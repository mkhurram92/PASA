<?php

namespace App\DataTables;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubscriptionPlanDataTable extends DataTable
{
    private $can_view, $can_edit;

    function __construct()
    {
        $this->can_view = Auth::user()->can("subscription-plans-list");
        $this->can_edit = Auth::user()->can("subscription-plans-edit");
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
            ->addColumn('action', function ($subscription_plan) {
                $html = "<div class='d-flex'>";
                if ($this->can_view) {
                    $html .= '<a href="javascript:void(0)"
                            data-href="' . route('subscription-plans.show', ['subscription_plan' => $subscription_plan->id]) . '"
                            class="btn btn-default view-record">View</a>';
                }
                if ($this->can_edit) {
                    $html .= '<a href="javascript:void(0)"
                            data-href="' . route('subscription-plans.edit', ['subscription_plan' => $subscription_plan->id]) . '"
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
     * @param \App\Models\SubscriptionPlan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubscriptionPlan $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('subscription-plans-table')
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
            Column::make('name'),
            Column::make('description'),
            Column::make('email_price'),
            Column::make('post_price'),
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
        return 'subscription-plans' . date('YmdHis');
    }
}
