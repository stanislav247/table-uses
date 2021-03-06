<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TableUsesRequest;
use App\Models\Tables;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;

/**
 * Class TableUsesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TableUsesCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\TableUses::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tableuses');
        CRUD::setEntityNameStrings('tableuses', 'table_uses');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $from_date = request()->get('from_date', null);
        CRUD::setValidation(TableUsesRequest::class);

        CRUD::setFromDb(); // fields
        CRUD::field('from_date')->type('datetime_picker');
        CRUD::field('to_date')->type('datetime_picker');

        if (!empty($from_date)) {
            $to_date = Carbon::parse($from_date)->addHour()->toDateTimeString();
            CRUD::field('from_date')->value($from_date);
            CRUD::field('to_date')->value($to_date);
        }

        CRUD::field('table_id')
            ->type('select')
            ->entity('Tables')
            ->model('App\Models\Tables')
            ->attribute('name');


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
