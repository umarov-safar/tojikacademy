<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\EnglishDto;
use App\Http\Requests\EnglishRequest;
use App\Services\EnglishService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class EnglishCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EnglishCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * @var EnglishService
     */
    protected $englishService;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\English::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/english');
        CRUD::setEntityNameStrings('english', 'englishes');

        $this->englishService = new EnglishService();

        dd(auth());
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
        CRUD::removeColumn('category_id');

        CRUD::addColumn('category');
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
        CRUD::setValidation(EnglishRequest::class);

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

        $dto = new EnglishDto(
            $request->sentence,
            $request->translate1,
            $request->translate2,
            $request->category
        );


        $english = $this->englishService->store($dto);

        if(!$english) {

            Alert::error("Ибора сохта нашуд бо кадом мушкилие!")->flash();

        } else {

            Alert::success("Ибора сохта шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($english->getKey());
        }
    }

    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request =  $this->crud->getRequest();

        $dto = new EnglishDto(
            $request->sentence,
            $request->translate1,
            $request->translate2,
            $request->category
        );


        $english = $this->englishService->update($dto, $request->id);

        if(!$english) {

            Alert::error("Ибора тағир дода нашуд бо кадом мушкилие!")->flash();

        } else {

            Alert::success("Ибора тағир дода шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($english->getKey());
        }


    }

}
