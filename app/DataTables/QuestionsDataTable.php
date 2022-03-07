<?php

namespace App\DataTables;

use App\Models\Question;
use Yajra\DataTables\Services\DataTable;

class QuestionsDataTable extends DataTable
{
    use BuilderParameters;

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

    public function query()
    {
        $query = Question::query()->with('lesson')->select('questions.*');

        return $this->applyScopes($query);
    }

    public function html()
    {
        $html = $this->builder()
         ->columns($this->getColumns())
         ->ajax('')
         ->parameters($this->getCustomBuilderParameters([1, 2, 3], [], GetLanguage() == 'ar'));

        return $html;
    }

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
                 'name' => 'lesson.title',
                 'data'    => 'lesson.title',
                 'title'   => trans('main.lesson'),
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
                 'width'          => '25px',
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
                 'name' => 'questions.op1',
                 'data'    => 'op1',
                 'title'   => trans('main.op1'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '25px',
             ],
             [
                 'name' => 'questions.op2',
                 'data'    => 'op2',
                 'title'   => trans('main.op2'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '25px',
             ],
             [
                 'name' => 'questions.op3',
                 'data'    => 'op3',
                 'title'   => trans('main.op3'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '25px',
             ],
             [
                 'name' => 'questions.op4',
                 'data'    => 'op4',
                 'title'   => trans('main.op4'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '25px',
             ],
             [
                 'name' => 'questions.right_ans',
                 'data'    => 'right_ans',
                 'title'   => trans('main.right_ans'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '25px',
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
