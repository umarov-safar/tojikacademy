<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\RussianDto;
use App\Http\Requests\RussianRequest;
use App\Services\RussianService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class RussianCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RussianCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * @var RussianService
     */
    protected $russianService;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Russian::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/russian');
        CRUD::setEntityNameStrings('russian', 'russians');

        $this->russianService = new RussianService();
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
        CRUD::setValidation(RussianRequest::class);

        CRUD::setFromDb(); // fields

        CRUD::removeField('category_id');

        CRUD::addField('category');
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

    public function store()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request =  $this->crud->getRequest();

        //removing spaces
        $sentenceTj = preg_replace('/\s+/', ' ', $request->sentence);
        $translate1 = preg_replace('/\s+/', ' ', $request->translate1);
        $translate2 = preg_replace('/\s+/', ' ', $request->translate1);
        $translate3 = preg_replace('/\s+/', ' ', $request->translate1);

        $dto = new RussianDto(
            $sentenceTj,
            $translate1,
            $translate2,
            $translate3,
            $request->category
        );

        $russian = $this->russianService->store($dto);

        if(!$russian) {

            Alert::error("Ибора сохта нашуд бо кадом мушкилие!")->flash();

        } else {

            Alert::success("Ибора сохта шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($russian->getKey());
        }
    }

    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request =  $this->crud->getRequest();

        //removing spaces
        $sentenceTj = preg_replace('/\s+/', ' ', $request->sentence);
        $translate1 = preg_replace('/\s+/', ' ', $request->translate1);
        $translate2 = preg_replace('/\s+/', ' ', $request->translate1);
        $translate3 = preg_replace('/\s+/', ' ', $request->translate1);

        $dto = new RussianDto(
            $sentenceTj,
            $translate1,
            $translate2,
            $translate3,
            $request->category
        );


        $russian = $this->russianService->update($dto, $request->id);

        if(!$russian) {

            Alert::error("Ибора тағир дода нашуд бо кадом мушкилие!")->flash();

        } else {

            Alert::success("Ибора тағир дода шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($russian->getKey());
        }


    }
}
