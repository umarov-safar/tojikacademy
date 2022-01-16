<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AnswerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AnswerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Answer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/answer');
        CRUD::setEntityNameStrings('answer', 'answers');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn('id');
        CRUD::addColumn('answer');
        CRUD::removeColumn('question_id');
        CRUD::removeColumn('user_id');


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
        CRUD::setValidation(AnswerRequest::class);

        CRUD::addFields(self::createFields());


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
     * @return array
     * The fields for create operation
     */

    public function createFields() : array
    {
        return [
            [
                'name' => 'answer',
                'type' => 'summernote',
                'label' => 'Ҷавоб',
                'attributes' => [
                    'placeholder' => 'Ҷавоб дар инҷо'
                ],
                'options' => [
                    'height' => 220,
                ],
            ],
            [
                'name' => 'question',
                'type' => 'select2',
                'label' => 'Ҷавоб ба саволи',
                'attribute' => 'title',
                'placeholder'  => 'Ҷавоб диҳандаро интихоб кунед ...',
                'minimum_input_length' => 1,
            ],
            [
                'name' => 'parent',
                'type' => 'select2',
                'label' => 'Савол ба савол',
                'attribute' => 'id',
                'placeholder'  => 'Ҷавоб диҳандаро интихоб кунед ...',
                'minimum_input_length' => 1,
            ],

            [
                'type' => 'select2_from_ajax',
                'name' => 'user',
                'label' => 'Ҷавоб диҳанди',
                'attribute' => 'name',
                'entity'   => 'user',
                'data_source' => url('/api/answer/search'),
                'placeholder'  => 'Ҷавоб бар ҷавоб ...',
                'minimum_input_length' => 1,
            ],
        ];
    }

}
