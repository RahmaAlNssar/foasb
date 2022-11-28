<?php

namespace App\DataTables;

use App\Models\Message;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class MessageDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->editColumn('created_at',function($row){
            return $row->created_at->diffForHumans();
        })
        ->editColumn('id',function($row){

            return view('backend.includes.checkbox',['row'=>$row->id])->render();
        })
        ->editColumn('updated_at',function($row){
            return $row->updated_at->diffForHumans();
        })
        ->editColumn('user_id', function($row){
           $name = DB::table('users')
            ->join('messages', 'users.id', '=', 'messages.user_id')

            ->select('users.*')
            ->where('users.id',$row->user_id)
            ->first();
            return $name->name;
           })
        // ->editColumn('action', function($row){
        //   return view('backend.includes.action',['row'=>$row])->render();

        // })

        ->rawColumns(['created_at','updated_at','id','user_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Message $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Message $model): QueryBuilder
    {
        return $model->orderBy('id','desc')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('message-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->setTableAttribute('class','example table-hover table-responsive-md data-table table table-bordered data-table')
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('<input class="form-check-input" type="checkbox" value="" id="select_all" onClick="toggle(this)">')->exportable(false)->printable(false)->orderable(false)->searchable(false)->width(15)->addClass('text-center'),
            Column::make('user_id')->addClass('text-center')->title('صاحب الطلب'),
            Column::make('phone')->addClass('text-center')->title('رقم التلفون'),
            Column::make('message')->addClass('text-center')->title('الرساله'),
            Column::make('created_at')->addClass('text-center')->title('تاريخ الانشاء'),
            Column::make('updated_at')->addClass('text-center')->title('تاريخ التعديل'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Message_' . date('YmdHis');
    }
}
