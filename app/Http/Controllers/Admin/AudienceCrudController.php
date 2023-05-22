<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AudienceRequest;
use App\Models\PartieAdverse;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AudienceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AudienceCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Audience::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/audience');
        CRUD::setEntityNameStrings('audience', 'audiences');
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
        CRUD::column('date');
        CRUD::addColumn([
            'name'      =>  'dossier_justice_id',
            'label'     =>  'Dossier Concerné',
            'type'      =>  'select',
            'attribute' =>  'code_affaire',
            'entity'    =>  'dossierJustice',
         ]);
         CRUD::addColumn([
            'name'      =>  'typecourt',
            'label'     =>  'Type Cour',
            'type'      =>  'enum',
        ]);
        CRUD::column('resultat');

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
        CRUD::setValidation(AudienceRequest::class);

        CRUD::field('date')->label('Date Audience');
        CRUD::field('heur')->label('Heur Audience');
        CRUD::addField([
            'name'      =>  'dossier_justice_id',
            'label'     =>  'Dossier Concerné',
            'type'      =>  'select',
            'attribute' =>  'code_affaire',
            'entity'    =>  'dossierJustice',
         ]);
        CRUD::addField([
            'name'      =>  'typecourt',
            'label'     =>  'Type Cour',
            'type'      =>  'enum',
        ]);
        CRUD::addField([
            'name'      =>  'court_id',
            'key'       =>  'adress',
            'label'     =>  'Adresse de Cour',
            'type'      =>  'select',
            'attribute' =>  'adresse',
            'entity'    =>  'court'
        ]);
        CRUD::addField([
            'name'      =>  'resultat',
            'label'     =>  'Resultat',
            'type'      =>  'enum',
        ]);

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