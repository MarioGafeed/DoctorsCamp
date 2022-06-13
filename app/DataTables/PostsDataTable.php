<?php

namespace App\DataTables;

use App\Models\Post;
use Yajra\DataTables\Services\DataTable;

class PostsDataTable extends DataTable
{
    use BuilderParameters;

    public function dataTable($query)
    {
        return datatables($query)
        ->addColumn('checkbox', '<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')

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

        ->addColumn('show', 'backend.posts.buttons.show')
        ->addColumn('edit', 'backend.posts.buttons.edit')
        ->addColumn('delete', 'backend.posts.buttons.delete')
        ->rawColumns(['checkbox', 'show', 'edit', 'delete', 'active']);
    }

    public function query()
    {
        $query = Post::query()->with('category', 'user')->select('posts.*');

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
                 'name'       => 'posts.title_en',
                 'data'       => 'title_en',
                 'title'      => trans('main.title').' en',
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '200px',
             ],
             [
                 'name'       => 'posts.title_ar',
                 'data'       => 'title_ar',
                 'title'      => trans('main.title').' ar',
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '200px',
             ],
             [
                 'name'       => 'category.title_en',
                 'data'       => 'category.title_en',
                 'title'      => trans('main.category').' (EN)',
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '200px',
             ],
             [
                 'name'       => 'category.title_ar',
                 'data'       => 'category.title_ar',
                 'title'      => trans('main.category').' (AR)',
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '200px',
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
                 'name'       => 'posts.type',
                 'data'       => 'type',
                 'title'      => trans('main.type'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '200px',
             ],
             [
                 'name' => 'posts.active',
                 'data'    => 'active',
                 'title'   => trans('main.status'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '200px',
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
        return 'Posts_'.date('YmdHis');
    }
}
