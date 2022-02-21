<?php

namespace App\DataTables;

use App\Models\Post;
use App\Models\Comment;
use Yajra\DataTables\Services\DataTable;

class CommentsDataTable extends DataTable
{
    use BuilderParameters;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
        ->addColumn('checkbox', '<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
        ->addColumn('is_approved', function ($model) {
            if ($model->is_approved == 'true') {
                return '
                        <span style="padding: 1px 6px;" class="label lable-sm label-success">'.trans('main.yes').'</span>
                            ';
            } else {
                return '
                        <span style="padding: 1px 6px;" class="label lable-sm label-danger">'.trans('main.no').'</span>
                    ';
            }
        })
        ->addColumn('show', 'backend.comments.buttons.show')
        ->addColumn('toggle', 'backend.comments.buttons.toggle')
        ->addColumn('delete', 'backend.comments.buttons.delete')
        ->rawColumns(['checkbox', 'show', 'toggle', 'delete', 'is_approved']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Comment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = Comment::query()->with('user', 'commentable')->select('comments.*');

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $html = $this->builder()
         ->columns($this->getColumns())
         ->ajax('')
         ->parameters($this->getCustomBuilderParameters([1, 2], [], GetLanguage() == 'ar'));

        return $html;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
             [
                 'name' => 'checkbox',
                 'data' => 'checkbox',
                 'title' => '<input type="checkbox" class="select-all" onclick="select_all()">',
                 'orderable'      => false,
                 'searchable'     => false,
                 'exportable'     => false,
                 'printable'      => false,
                 'width'          => '10px',
                 'aaSorting'      => 'none',
             ],
             [
                 'name'       => 'comments.comment',
                 'data'       => 'comment',
                 'title'      => trans('main.comment'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '400px',
             ],
             [
                 'name'       => 'user.name',
                 'data'       => 'user.name',
                 'title'      => trans('main.user'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '200px',
             ],
             [
                 'name'       => 'commentable.title_ar',
                 'data'       => 'commentable.title_ar',
                 'title'      => trans('main.resource'). " ar",
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '200px',
             ],
             [
                 'name'       => 'commentable.title_en',
                 'data'       => 'commentable.title_en',
                 'title'      => trans('main.resource')." en",
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '200px',
             ],
             [
                 'name'       => 'comments.is_approved',
                 'data'       => 'is_approved',
                 'title'      => trans('main.active'),
                 'searchable' => false,
                 'orderable'  => true,
                 'width'      => '100px',
             ],
             [
                 'name' => 'toggle',
                 'data' => 'toggle',
                 'title' => trans('main.toggle'),
                 'exportable' => false,
                 'printable'  => false,
                 'searchable' => false,
                 'orderable'  => false,
             ],
             [
                 'name' => 'show',
                 'data' => 'show',
                 'title' => trans('main.show'),
                 'exportable' => false,
                 'printable'  => false,
                 'searchable' => false,
                 'orderable'  => false,
             ],
             [
                 'name' => 'delete',
                 'data' => 'delete',
                 'title' => trans('main.delete'),
                 'exportable' => false,
                 'printable'  => false,
                 'searchable' => false,
                 'orderable'  => false,
             ],

         ];
    }

    protected function filename()
    {
        return 'Posts_'.date('YmdHis');
    }
}
