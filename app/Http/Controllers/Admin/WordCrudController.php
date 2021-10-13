<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\WordDto;
use App\Http\Requests\WordRequest;
use App\Services\WordService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class WordCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WordCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * @var WordService
     */
    protected $wordService;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Word::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/word');
        CRUD::setEntityNameStrings('word', 'words');

        $this->wordService = new WordService();
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
        CRUD::setValidation(WordRequest::class);

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

    /**
     * Storing word by dto
     * @return array|\Illuminate\Http\Response|void
     */
    public function store()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request = $this->crud->getRequest();

        $dto = new WordDto(
            $request->word,
            $request->translate1,
            $request->translate2,
            $request->category
        );

        $word = $this->wordService->store($dto);

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

        $dto = new WordDto(
            $request->word,
            $request->translate1,
            $request->translate2,
            $request->category
        );

        $word = $this->wordService->update($dto, $request->id);

        if(!$word) {

            Alert::error("Луғат тағир дода нашуд!")->flash();

        } else {

            Alert::success("Луғат тағир дода шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($word->getKey());
        }
    }

}
