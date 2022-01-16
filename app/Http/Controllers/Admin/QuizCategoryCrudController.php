<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\QuizCategoryDto;
use App\Http\Requests\QuizCategoryRequest;
use App\Services\QuizCategoryService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class QuizCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QuizCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * @var QuizCategoryService $quizCategoryService
     */
    protected $quizCategoryService;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\QuizCategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/quiz-category');
        CRUD::setEntityNameStrings('quiz category', 'quiz categories');

        $this->quizCategoryService = new QuizCategoryService();
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
        CRUD::setValidation(QuizCategoryRequest::class);

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

        $dto = new QuizCategoryDto(
            $request->name,
            $request->slug,
            $request->parent_id
        );


        $quizCategoryService = $this->quizCategoryService->store($dto);

        if(!$quizCategoryService) {

            Alert::error("Категория  сохта нашуд!")->flash();

        } else {

            Alert::success("Категория бо муваффақона сохта шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($quizCategoryService->getKey());
        }

    }


    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request = $this->crud->getRequest();

        $dto = new QuizCategoryDto(
            $request->name,
            $request->slug,
            $request->parent_id
        );


        $quizCategoryService = $this->quizCategoryService->update($dto, $request->id);

        if(!$quizCategoryService) {

            Alert::error("Категория  тағир дода нашуд!")->flash();

        } else {

            Alert::success("Категория тағир дода шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($quizCategoryService->getKey());
        }

    }

}
