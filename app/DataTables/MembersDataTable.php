<?php

namespace App\DataTables;

use App\Models\Member;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class MembersDataTable extends DataTable
{
    private $can_view, $can_edit;
    function __construct()
    {
        $this->can_view = Auth::user()->can("members-list");
    }
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(100),
            Column::make('given_name')->title('Given Name'),
            Column::make('family_name')->title('Family Name'),
            Column::make('email')->title('Email Address'),
            Column::make('member_type_id')->title('Member Type'),
            Column::make('approved_at')->title('Approval Date'),
            Column::make('member_status_id')->title('Membership Status'),
        ];
    }
}
