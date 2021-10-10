<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\QuestionDto;
use App\Http\Requests\QuestionRequest;
use App\Services\QuestionService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class QuestionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QuestionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * @var QuestionService
     */
    private $serviceQuestion;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Question::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/question');
        CRUD::setEntityNameStrings('question', 'questions');

        //service class for storing and updating data
        $this->serviceQuestion = new QuestionService();
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


        CRUD::removeColumn('question_category_id');
        CRUD::removeColumn('user_id');
        CRUD::removeColumn('image');
        CRUD::removeColumn('body');

        CRUD::addColumn('user');
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
        CRUD::setValidation(QuestionRequest::class);

        CRUD::addFields(self::createFields());

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
     * store question
     * @return array|\Illuminate\Http\Response|void
     *
     */

    public function store()
    {
       $this->crud->setRequest($this->crud->validateRequest());
       $request =  $this->crud->getRequest();

       $dto = new QuestionDto(
           $request->title,
           $request->body,
           $request->image,
           $request->user_id,
           $request->category
       );

       $question =  $this->serviceQuestion->store($dto);

       if(!$question) {

           Alert::error("Савол сохта нашуд бо  кадом мушкилие!")->flash();

       } else {

           Alert::success("Савол бо муваффақона сохта шуд!")->flash();

           $this->crud->setSaveAction();

           return $this->crud->performSaveAction($question->getKey());
       }


    }

    /***
     * updating question
     * @return array|\Illuminate\Http\Response|void
     *
     */

    public function update()
    {


        $this->crud->setRequest($this->crud->validateRequest());
        $request =  $this->crud->getRequest();

        $dto = new QuestionDto(
            $request->title,
            $request->body,
            $request->image,
            $request->user_id,
            $request->category
        );

        $question =  $this->serviceQuestion->update($dto, $request->id);

        if(!$question) {

            Alert::error("Савол тағир дода нашуд бо  кадом мушкилие!")->flash();

        } else {

            Alert::success("Савол тағир дода шуд!")->flash();

            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($question->getKey());
        }


    }


    /**
     * Custom fields for create operation
     *
     * @return array
     */

    protected function createFields() : array
    {
        return  [
            [
                'name' => 'title',
                'type' => 'text',
                'placeholder' => 'Саволро дар инҷо нависед...',
                'label' => 'Савол',
                'attributes' => [
                    'placeholder' => 'Саволро дар инҷо нависед...',
                ],

            ],
            [
                'name' => 'body',
                'type' => 'textarea',
                'label' => 'Шарҳи савол',
                'attributes' => [
                    'placeholder' => 'Шарҳи саволро дар инҷо нависед...',
                ],

            ],
            [
                'name' => 'image',
                'type' => 'browse',
                'label' => 'Акс барои савол',
                'attributes' => [
                    'placeholder' => 'Акс барои савол'
                ]
            ],
            //relationships
            [
                'name' => 'category',
                'type' => 'relationship',
                'label' => 'Категорияи савол',
                'placeholder'  => 'Категория саволро интихоб кунед ...',

            ],
            [
                'type' => 'select2_from_ajax',
                'name' => 'user_id',
                'label' => 'Саволгузор',
                'attribute' => 'name',
                'entity'   => 'user',
                'data_source' => url('/api/user/search'),
                'placeholder'  => 'Саволдиҳандаро интихоб кунед ...',
                'minimum_input_length' => 1,
            ]
        ];
    }

}
