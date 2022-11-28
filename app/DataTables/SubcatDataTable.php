<?php

namespace App\DataTables;

use App\Models\Subcat;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubcatDataTable extends DataTable
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
        ->editColumn('action', function($row){
          return view('backend.includes.action',['row'=>$row])->render();

        })
        ->editColumn('cat_id', function($row){
            return $row->cat->name;

          })
        ->rawColumns(['created_at','updated_at','action','id','cat_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Subcat $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subcat $model): QueryBuilder
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
                    ->setTableId('subcat-table')
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
            Column::make('name')->addClass('text-center')->title('القسم الفرعي'),
            Column::make('cat_id')->addClass('text-center')->title('القسم الرئيسي'),
            Column::make('created_at')->addClass('text-center')->title('تاريخ الانشاء'),
            Column::make('updated_at')->addClass('text-center')->title('تاريخ التعديل'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')->title('العملية'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Subcat_' . date('YmdHis');
    }
}
