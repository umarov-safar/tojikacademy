<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\RussianWordDto;
use App\Http\Requests\RussianWordRequest;
use App\Models\RussianWord;
use App\Models\WordCategory;
use App\Services\RussianWordService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class RussianWordCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RussianWordCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    protected RussianWordService $russianWordService;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\RussianWord::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/russian-word');
        CRUD::setEntityNameStrings('russian word', 'russian words');

        $this->russianWordService = new RussianWordService();
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
        CRUD::setValidation(RussianWordRequest::class);

        CRUD::setFromDb(); // fields

        $this->crud->addField([
            'label'             => 'Words',
            'type'              => 'select2_multiple',
            'name'              => 'words', // the method that defines the relationship in your Model
            'entity'            => 'words', // the method that defines the relationship in your Model
            'attribute'         => 'word', // foreign key attribute that is shown to user
            'model'             => RussianWord::class,
            'pivot'             => true, // on create&update, do you need to add/delete pivot table entries?
        ]);

        $this->crud->addField([
            'label'             => 'Categories',
            'type'              => 'select2_multiple',
            'name'              => 'categories', // the method that defines the relationship in your Model
            'entity'            => 'categories', // the method that defines the relationship in your Model
            'attribute'         => 'name', // foreign key attribute that is shown to user
            'model'             => WordCategory::class,
            'pivot'             => true, // on create&update, do you need to add/delete pivot table entries?
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

    public function store()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request = $this->crud->getRequest();


        $dto = new RussianWordDto(
            $request->word,
            $request->translate,
            $request->categories,
            $request->words
        );

        $word = $this->russianWordService->store($dto);

        if(!$word) {

            Alert::error("Луғат сохта нашуд!")->flash();

        } else {

            Alert::success("Луғат бо муваффақона сохта шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($word->getKey());
        }
    }


    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request = $this->crud->getRequest();

        $dto = new RussianWordDto(
            $request->word,
            $request->translate,
            $request->categories,
            $request->words,
        );

        $word = $this->russianWordService->update($dto, $request->id);

        if(!$word) {

            Alert::error("Луғат тағир дода нашуд!")->flash();

        } else {

            Alert::success("Луғат тағир дода шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($word->getKey());
        }
    }

}