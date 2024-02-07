<?php

namespace App\DataTables;

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

class UsersDataTable extends DataTable
{
    private $can_view, $can_edit;
    function __construct()
    {
        $this->can_view = Auth::user()->can("user-list");
        $this->can_edit = Auth::user()->can("user-edit");
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
            ->editColumn("created_at", function ($user) {
                return date("d, F, Y h:i A", strtotime($user->created_at));
            })
            ->addColumn('action', function ($user) {
                $html = "<div class='d-flex'>";
                if ($this->can_view) {
                    $html .= '<a href="javascript:void(0)"
                            data-href="' . route('user.show', ['user' => $user->id]) . '"
                            class="btn btn-default view-record">View</a>';
                }
                if ($this->can_edit) {
                    $html .= '<a href="javascript:void(0)"
                            data-href="' . route('user.edit', ['user' => $user->id]) . '"
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
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->latest()->when(!empty(request()->date), function ($q) {
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
            ->setTableId('users-table')
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
            Column::make('Name'),
            Column::make('Email'),
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
        return 'Users_' . date('YmdHis');
    }
}
