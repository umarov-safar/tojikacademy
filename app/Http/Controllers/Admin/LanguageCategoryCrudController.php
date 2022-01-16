<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\LanguageCategoryDto;
use App\Http\Requests\LanguageCategoryRequest;
use App\Services\LanguageCategoryService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class LanguageCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LanguageCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    protected $langCategoryService;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\LanguageCategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/language-category');
        CRUD::setEntityNameStrings('language category', 'language categories');

        $this->langCategoryService = new LanguageCategoryService();

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

        CRUD::removeColumn('parent_id');

        CRUD::addColumn('parent');

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(LanguageCategoryRequest::class);

        CRUD::setFromDb(); // fields

        CRUD::removeField('parent_id');

        CRUD::addField([
            'label' => 'Parent',
            'type' => 'select',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
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

        $dto = new LanguageCategoryDto(
            $request->name,
            $request->slug,
            $request->parent_id
        );


        $langCategoryService = $this->langCategoryService->store($dto);

        if(!$langCategoryService) {

            Alert::error("Категория  сохта нашуд!")->flash();

        } else {

            Alert::success("Категория бо муваффақона сохта шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($langCategoryService->getKey());
        }

    }


    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request = $this->crud->getRequest();

        $dto = new LanguageCategoryDto(
            $request->name,
            $request->slug,
            $request->parent_id
        );


        $langCategoryService = $this->langCategoryService->update($dto, $request->id);

        if(!$langCategoryService) {

            Alert::error("Категория  тағир дода нашуд!")->flash();

        } else {

            Alert::success("Категория тағир дода шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($langCategoryService->getKey());
        }

    }


}
