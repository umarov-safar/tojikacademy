<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\QuizCategoryDto;
use App\Dtos\QuizDto;
use App\Http\Requests\QuizRequest;
use App\Services\QuizCategoryService;
use App\Services\QuizService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class QuizCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QuizCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    /**
     * @var QuizService
     */
    protected $quizService;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Quiz::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/quiz');
        CRUD::setEntityNameStrings('quiz', 'quizzes');


        $this->quizService = new QuizService();
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
        CRUD::setValidation(QuizRequest::class);

        CRUD::setFromDb(); // fields

        CRUD::removeField('category_id');

        CRUD::removeField('answers');

        CRUD::addField(
            [
                'name' => 'answers',
                'type' => 'repeatable',
                'label' => 'Ҷавобҳо',
                'fields' =>
                [
                    [
                        'name' => 'answer',
                        'type' => 'text',
                        'label' => 'Ҷавобро нависед'
                    ],
                    [
                        'name' => 'is_true',
                        'type' => 'boolean',
                        'label' => 'Ҷавоб дуруст аст'
                    ]
                ],
                'new_item_label' => 'Ҷавоб дигар',
                'init_rows' => 1,
                'min_rows' => 1,
                'max_rows' => 6
            ]
        )->beforeField('more_answer');


        CRUD::field('category')->beforeField('more_answer');
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
        $this->crud->setValidation($this->crud->validateRequest());
        $request = $this->crud->getRequest();

        $dto = new QuizDto(
            $request->quiz,
            $request->answers,
            $request->more_answer,
            $request->category
        );

        $quiz = $this->quizService->store($dto);

        if(!$quiz) {

            Alert::error("Тест сохта нашуд!")->flash();

        } else {

            Alert::success("Тест бо муваффақона сохта шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($quiz->getKey());
        }

    }


    public function update()
    {
        $this->crud->setValidation($this->crud->validateRequest());
        $request = $this->crud->getRequest();

        $dto = new QuizDto(
            $request->quiz,
            $request->answers,
            $request->more_answer,
            $request->category
        );

        $quiz = $this->quizService->update($dto, $request->id);

        if(!$quiz) {

            Alert::error("Тест тағир дода нашуд!")->flash();

        } else {

            Alert::success("Тест тағир  дода шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($quiz->getKey());
        }
    }


}
