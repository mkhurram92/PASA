<?php

namespace App\DataTables;

use App\Models\MembershipStatus;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MembershipStatusDataTable extends DataTable
{
    private $can_view, $can_edit;
    function __construct()
    {
        $this->can_view = Auth::user()->can("membership-status-list");
        $this->can_edit = Auth::user()->can("membership-status-edit");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('membership-status-table');
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
            Column::make('Name'),
            Column::make('Created Date'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'MembershipStatus_' . date('YmdHis');
    }
}
