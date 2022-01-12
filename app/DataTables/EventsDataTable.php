<?php

namespace App\DataTables;

use App\Models\Event;
use Yajra\DataTables\Services\DataTable;

class EventsDataTable extends DataTable
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

        ->addColumn('show', 'backend.events.buttons.show')
        ->addColumn('edit', 'backend.events.buttons.edit')
        ->addColumn('delete', 'backend.events.buttons.delete')
        ->rawColumns(['checkbox', 'show', 'edit', 'delete', 'active']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Event $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = Event::query()->with('country', 'user')->select('events.*');

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
         ->parameters($this->getCustomBuilderParameters([1, 2, 3, 4, 5, 6, 7], [], GetLanguage() == 'ar'));

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
                 'name'       => 'events.title_en',
                 'data'       => 'title_en',
                 'title'      => trans('main.eventTitle').' en',
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '200px',
             ],
             [
                 'name'       => 'events.title_ar',
                 'data'       => 'title_ar',
                 'title'      => trans('main.eventTitle').' ar',
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '200px',
             ],
             [
                 'name'       => 'country.name',
                 'data'       => 'country.name',
                 'title'      => trans('main.country'),
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
                 'name' => 'events.location',
                 'data'    => 'location',
                 'title'   => trans('main.location'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'          => '200px',
             ],
             [
                 'name'       => 'events.start_date',
                 'data'       => 'start_date',
                 'title'      => trans('main.start_date'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '300px',
             ],
             [
                 'name'       => 'events.end_date',
                 'data'       => 'end_date',
                 'title'      => trans('main.end_date'),
                 'searchable' => true,
                 'orderable'  => true,
                 'width'      => '300px',
             ],
             [
                 'name' => 'events.active',
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
        return 'Events_'.date('YmdHis');
    }
}
