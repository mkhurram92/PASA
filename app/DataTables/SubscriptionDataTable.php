<?php

namespace App\DataTables;

use App\Models\City;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubscriptionDataTable extends DataTable
{
    private $can_view, $can_edit;
    function __construct()
    {
        $this->can_view = Auth::user()->can("payment-list");
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
            ->editColumn("id", function ($row) {
                return sprintf("%04d", $row->id);
            })
            ->addColumn("user", function ($row) {
                $name = "N/A";
                if (!empty($row->meta_description)) {
                    $name = $row->meta_description['name'];
                }
                return $name;
            })
            ->editColumn("amount", function ($row) {
                return "$" . $row->amount;
            })
            ->editColumn("start_date", function ($row) {
                return $row->start_date ?? "N/A";
            })
            ->editColumn("end_date", function ($row) {
                return $row->end_date ?? "N/A";
            })
            ->editColumn("status", function ($row) {
                $status = $row->status;
                switch ($status) {
                    case "PENDING":
                        $alert = "info";
                        break;
                    case "CANCELLED":
                        $alert = "warning";
                        break;
                    case "SUCCESS":
                        $alert = "success";
                        break;
                    case "PROCESSING":
                        $alert = "info";
                        break;
                    default:
                        $alert = "danger";
                        break;
                }
                $html = "<span class='alert alert-" . $alert . " p-1'>" . $status . "</span>";
                return $html;
            })
            ->rawColumns(['status'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\City $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subscription $model): QueryBuilder
    {
        $user = User::with(['roles'])->find(auth()->id());
        $userRoles = $user->roles;
        $isAdmin = false;
        foreach ($userRoles as $role) {
            if ($role?->name == "Admin") {
                $isAdmin = true;
                break;
            }
        }
        return $model->newQuery()->latest()->when(!$isAdmin, function ($q) {
            $q->where("created_by", auth()->id());
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
            ->setTableId('payments-table')
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
            Column::make('#')->width(50),
            Column::make('User'),
            Column::make('Start Date'),
            Column::make('End Date'),
            Column::make('Member type'),
            Column::make('Amount'),
            Column::make('Status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Subscriptions' . date('YmdHis');
    }
}
