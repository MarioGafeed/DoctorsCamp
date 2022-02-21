<?php

namespace App\DataTables;

use App\Models\Course;
use Yajra\DataTables\Services\DataTable;

class CoursesDataTable extends DataTable
{
    use BuilderParameters;

    public function dataTable($query)
    {
        return datatables($query)
       ->addColumn('checkbox', '<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
       ->addColumn('show', 'backend.courses.buttons.show')
       ->addColumn('edit', 'backend.courses.buttons.edit')
       ->addColumn('delete', 'backend.courses.buttons.delete')
       ->addColumn('active', function ($model) {
           if ($model->active == '1') {
               return '
                   <span style="padding: 1px 6px;" class="label lable-sm label-success">'.trans('main.yes').'</span>
               ';
           } else {
               return '
                   <span style="padding: 1px 6px;" class="label lable-sm label-danger">'.trans('main.no').'</span>
               ';
           }
       })
       ->rawColumns(['checkbox', 'show', 'edit', 'delete', 'active']);
    }

    public function query()
    {
        $query = Course::query()->select('courses.*')->with('category');

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
                 'name' => 'courses.name',
                 'data'    => 'name',
                 'title'   => trans('main.name'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '250px',
             ],
             [
                 'name' => 'category.title_en',
                 'data'    => 'category.title_en',
                 'title'   => trans('main.category').' (en)',
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '300px',
             ],
             [
                 'name' => 'category.title_ar',
                 'data'    => 'category.title_ar',
                 'title'   => trans('main.category').' (ar)',
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '300px',
             ],
             [
                 'name' => 'courses.price',
                 'data'    => 'price',
                 'title'   => trans('main.price'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '50px',
             ],
             [
                 'name' => 'courses.active',
                 'data'    => 'active',
                 'title'   => trans('main.active'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '50px',
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
        return 'categories_'.date('YmdHis');
    }
}
