<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Dtos\WordCategoryDto;
use App\Http\Requests\WordCategoryRequest;
use App\Services\WordCategoryService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WordCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WordCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\App\Http\Controllers\Operations\ReorderOperation;


    protected WordCategoryService $wordCategoryService;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\WordCategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/word-category');
        CRUD::setEntityNameStrings('word category', 'word categories');

        $this->wordCategoryService = new WordCategoryService();

        $this->setupReorderOperation();
    }


    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'name');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 1);
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
        CRUD::removeColumns(['parent_id', 'lft', 'rgt', 'depth']);

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
        CRUD::setValidation(WordCategoryRequest::class);

        CRUD::setFromDb(); // fields

        CRUD::removeFields(['parent_id', 'lft', 'rgt', 'depth']);


        CRUD::field('description')->type('textarea');

        CRUD::field('image')->type('browse');
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

        $dto = new WordCategoryDto(
            $request->name,
            $request->description,
            $request->image,
            $request->slug
        );


        $wordCategory = $this->wordCategoryService->store($dto);

        if(!$wordCategory) {

            Alert::error("Категория сохта нашуд!")->flash();

        } else {

            Alert::success("Категория бо муваффақона сохта шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($wordCategory->getKey());
        }

    }




    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request = $this->crud->getRequest();

        $dto = new WordCategoryDto(
            $request->name,
            $request->description,
            $request->image,
            $request->slug
        );


        $wordCategory = $this->wordCategoryService->update($dto, $request->id);

        if(!$wordCategory) {

            Alert::error("Категория  тағир дода нашуд!")->flash();

        } else {

            Alert::success("Категория тағир дода шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($wordCategory->getKey());
        }

    }




}
