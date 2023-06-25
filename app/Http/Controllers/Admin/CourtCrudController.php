<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourtRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourtCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourtCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Court::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/court');
        CRUD::setEntityNameStrings('court', 'courts');
        
        $user = backpack_user();
        
        if ($user->hasRole('Super Admin') || $user->hasRole('Direction Admin') || $user->hasRole('Agence Admin')) {
            return;
        }
    
        // Deny access if none of the above conditions are met
        CRUD::denyAccess(['create', 'update', 'delete','list','show']);

        
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
        $this->autoSetupShowOperation();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('type')->label('Type De Cour');
        CRUD::column('adresse');
        CRUD::column('telephone');
        CRUD::column('email');

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
        CRUD::setValidation(CourtRequest::class);

        CRUD::addfield([
            'name'  => 'type',
            'label' => 'Type De Cour',
            'type'  => 'enum'
        ]);
        CRUD::field('adresse');
        CRUD::field('telephone');
        CRUD::field('email');

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
