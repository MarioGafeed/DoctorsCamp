<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
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

       ->addColumn('categories.summary_en', function($model){
                          return json_decode($model->summary)->en;
                 })
       ->addColumn('categories.summary_ar', function($model){
                          return json_decode($model->summary)->ar ?? trans('main.n_a');
                 })
      ->addColumn('categories.desc_en', function($model){
                          return json_decode($model->desc)->en;
                 })
      ->addColumn('categories.desc_ar', function($model){
                          return json_decode($model->desc)->ar ?? trans('main.n_a');
                 })
       ->addColumn('show', 'backend.categories.buttons.show')
       ->addColumn('edit', 'backend.categories.buttons.edit')
       ->addColumn('delete', 'backend.categories.buttons.delete')
       ->rawColumns(['checkbox','show','edit', 'delete'])
       ;
     }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pcategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = category::query()->select('categories.*');
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
        ->parameters($this->getCustomBuilderParameters([1,2,3,4,5], [], GetLanguage() == 'ar'));
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
                'name'       => "categories.title_en",
                'data'       => 'title_en',
                'title'      => trans('main.title')." (en)",
                'searchable' => true,
                'orderable'  => true,
                'width'      => '200px',
            ],
            [
                'name'       => "categories.title_ar",
                'data'       => 'title_ar',
                'title'      => trans('main.title')." (ar)",
                'searchable' => true,
                'orderable'  => true,
                'width'      => '200px',
            ],
            [
                'name'       => "categories.keyword",
                'data'       => 'keyword',
                'title'      => trans('main.keyword'),
                'searchable' => true,
                'orderable'  => true,
                'width'      => '200px',
            ],
            [
                'name'       => "categories.summary",
                'data'       => 'categories.summary_en',
                'title'      => trans('main.summary')." (en)",
                'searchable' => true,
                'orderable'  => true,
                'width'      => '200px',
            ],
            [
                'name'       => "categories.desc",
                'data'       => 'categories.desc_en',
                'title'      => trans('main.desc')." (en)",
                'searchable' => true,
                'orderable'  => true,
                'width'      => '200px',
            ],
            [
                'name'       => "categories.summary",
                'data'       => 'categories.summary_ar',
                'title'      => trans('main.summary')." (ar)",
                'searchable' => true,
                'orderable'  => true,
                'width'      => '200px',
            ],
            [
                'name'       => "categories.desc",
                'data'       => 'categories.desc_ar',
                'title'      => trans('main.desc')." (ar)",
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
        return 'categories_' . date('YmdHis');
    }
}
