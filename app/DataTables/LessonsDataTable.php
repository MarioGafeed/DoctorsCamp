<?php

namespace App\DataTables;

use App\Models\Lesson;
use Yajra\DataTables\Services\DataTable;

class LessonsDataTable extends DataTable
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
        ->addColumn('show', 'backend.lessons.buttons.show')
        ->addColumn('edit', 'backend.lessons.buttons.edit')
        ->addColumn('delete', 'backend.lessons.buttons.delete')
        ->rawColumns(['checkbox','show','edit', 'delete'])
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Lesson $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = Lesson::query()->with('course')->select('lessons.*');
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $html =  $this->builder()
         ->columns($this->getColumns())
         ->ajax('')
         ->parameters($this->getCustomBuilderParameters([1,2,3], [], GetLanguage() == 'ar'));

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
                 'aaSorting'      => 'none'
             ],
             [
                 'name' => "lessons.title",
                 'data'    => 'title',
                 'title'   => trans('main.title'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '200px',
             ],
             [
                 'name' => "lessons.myorder",
                 'data'    => 'myorder',
                 'title'   => trans('main.myorder'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '100px',
             ],
             [
                 'name' => "course.name",
                 'data'    => 'course.name',
                 'title'   => trans('main.course'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '300px',
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
                 'name' => 'edit',
                 'data' => 'edit',
                 'title' => trans('main.edit'),
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
        return 'Lessons_' . date('YmdHis');
    }
}
