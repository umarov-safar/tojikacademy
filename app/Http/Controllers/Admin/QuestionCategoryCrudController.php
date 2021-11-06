<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\QuestionCategoryDto;
use App\Http\Requests\QuestionCategoryRequest;
use App\Services\QuestionCategoryService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class QuestionCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QuestionCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

     private  $questionCategoryService;


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\QuestionCategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/question-category');
        CRUD::setEntityNameStrings('question category', 'question categories');

        // setting service
        $this->questionCategoryService = new QuestionCategoryService();
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
        CRUD::setValidation(QuestionCategoryRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Номи категория',
            'attributes' => [
                'placeholder' => 'Номи категория ...'
            ]
        ]);
        $this->crud->addField([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Дар бораи категория',
            'attributes' => [
                'placeholder' => 'Дар бораи категория ...'
            ]
        ]);
        $this->crud->addField([
            'name' => 'image',
            'type' => 'browse',
            'label' => 'Номи категория',
            'attributes' => [
                'placeholder' => 'Номи категория ...'
            ]
        ]);
        $this->crud->addField([
            'name' => 'slug',
            'label' => 'Slug барои категория',
            'hint' => 'Агар slug пуркарда нашавад аз ном сохта мешавад',
            'attributes' => [
                'placeholder' => 'Slug барои категория ...'
            ]
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

    /***
     * @return array|\Illuminate\Http\Response|void
     *
     * create question category
     */
    public function store()
    {
        //setting validation rules
        $this->crud->setRequest($this->crud->validateRequest());
        $request = $this->crud->getRequest();

        //setting data to dto class
        $dto = new QuestionCategoryDto(
            $request->name,
            $request->description,
            $request->image,
            $request->slug,
        );

        //sending data for storing
        $questionCategory = $this->questionCategoryService->store($dto);

        if(!$questionCategory) {

            Alert::error("Категория сохта нашуд!")->flash();

        } else {

            Alert::success("Категория бо муваффақона сохта шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($questionCategory->getKey());
        }

    }

    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request = $this->crud->getRequest();

        //setting data to dto class
        $dto = new QuestionCategoryDto(
            $request->name,
            $request->description,
            $request->image,
            $request->slug,
        );

        // sending data for updating
        $questionCategory = $this->questionCategoryService->update($dto, $request->id);

        if(!$questionCategory) {

            Alert::error("Категория тағир дода нашуд!")->flash();

        } else {

            Alert::success("Категория бо муваффақона тағир дода шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($questionCategory->getKey());
        }

    }

}
