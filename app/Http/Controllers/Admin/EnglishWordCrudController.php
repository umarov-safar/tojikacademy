<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\EnglishWordDto;
use App\Http\Requests\EnglishWordRequest;
use App\Models\EnglishWord;
use App\Models\WordCategory;
use App\Services\EnglishWordService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class EnglishWordCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EnglishWordCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected EnglishWordService $englishWordService;


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\EnglishWord::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/english-word');
        CRUD::setEntityNameStrings('english word', 'english words');

        $this->englishWordService = new EnglishWordService();
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

        $this->crud->addField([
            'label'             => 'Words',
            'type'              => 'select2_multiple',
            'name'              => 'words', // the method that defines the relationship in your Model
            'entity'            => 'words', // the method that defines the relationship in your Model
            'attribute'         => 'word', // foreign key attribute that is shown to user
            'model'             => EnglishWord::class,
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
        CRUD::setValidation(EnglishWordRequest::class);

        CRUD::setFromDb(); // fields

        $this->crud->addField([
            'label'             => 'Words',
            'type'              => 'select2_multiple',
            'name'              => 'words', // the method that defines the relationship in your Model
            'entity'            => 'words', // the method that defines the relationship in your Model
            'attribute'         => 'word', // foreign key attribute that is shown to user
            'model'             => EnglishWord::class,
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


        $dto = new EnglishWordDto(
            $request->word,
            $request->translate,
            $request->categories,
            $request->words
        );

        $word = $this->englishWordService->store($dto);

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

        $dto = new EnglishWordDto(
            $request->word,
            $request->translate,
            $request->categories,
            $request->words,
        );

        $word = $this->englishWordService->update($dto, $request->id);

        if(!$word) {

            Alert::error("Луғат тағир дода нашуд!")->flash();

        } else {

            Alert::success("Луғат тағир дода шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($word->getKey());
        }
    }
}
