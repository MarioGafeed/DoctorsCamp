<?php

namespace App\DataTables;

use App\Models\Faq;
use Yajra\DataTables\Services\DataTable;

class FaqsDataTable extends DataTable
{
    use BuilderParameters;

    public function dataTable($query)
    {
        return datatables($query)
       ->addColumn('checkbox', '<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')

       ->addColumn('show', 'backend.faqs.buttons.show')
       ->addColumn('edit', 'backend.faqs.buttons.edit')
       ->addColumn('delete', 'backend.faqs.buttons.delete')
       ->rawColumns(['checkbox', 'show', 'edit', 'delete']);
    }

    public function query()
    {
        $query = Faq::query()->select('faqs.*');

        return $this->applyScopes($query);
    }

    public function html()
    {
        $html = $this->builder()
        ->columns($this->getColumns())
        ->ajax('')
        ->parameters($this->getCustomBuilderParameters([1, 2, 3, 4, 5], [], GetLanguage() == 'ar'));

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
                'name'       => 'faqs.question',
                'data'       => 'question',
                'title'      => trans('main.question'),
                'searchable' => true,
                'orderable'  => true,
                'width'      => '200px',
            ],
            [
                'name'       => 'faqs.answer',
                'data'       => 'answer',
                'title'      => trans('main.answer'),
                'searchable' => true,
                'orderable'  => true,
                'width'      => '200px',
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
        return 'faqs_'.date('YmdHis');
    }
}
