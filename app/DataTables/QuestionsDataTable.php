<?php

namespace App\DataTables;

use App\Models\Question;
use Yajra\DataTables\Services\DataTable;

class QuestionsDataTable extends DataTable
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
        ->addColumn('lesson.title', function ($model) {
            return $model->lesson ? $model->lesson->title : 'N/A';
        })
        ->addColumn('show', 'backend.questions.buttons.show')
        ->addColumn('edit', 'backend.questions.buttons.edit')
        ->addColumn('delete', 'backend.questions.buttons.delete')
        ->rawColumns(['checkbox', 'show', 'edit', 'delete']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Question $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = Question::query()->with('lesson')->select('questions.*');

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
         ->parameters($this->getCustomBuilderParameters([1, 2, 3], [], GetLanguage() == 'ar'));

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
                 'name' => 'questions.title',
                 'data'    => 'title',
                 'title'   => trans('main.question'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '100px',
             ],

             [
                 'name' => 'questions.q_order',
                 'data'    => 'q_order',
                 'title'   => trans('main.q_order'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '100px',
             ],
             [
                 'name' => 'questions.desc',
                 'data'    => 'desc',
                 'title'   => trans('main.desc'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '100px',
             ],

             [
                 'name' => 'lesson.title',
                 'data'    => 'lesson.title',
                 'title'   => trans('main.lesson'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '100px',
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
        return 'questions_'.date('YmdHis');
    }
}
