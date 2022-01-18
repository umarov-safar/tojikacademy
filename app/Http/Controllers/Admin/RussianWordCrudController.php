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

        CRUD::removeColumn('incorrect_answers');

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

        $this->crud->addFields([
            [
                'name' => 'russian',
                'type' => 'text',
                'label' => 'Луғати руси',
            ],
            [
                'name' => 'tj',
                'type' => 'text',
                'label' => 'Луғати тоҷики',
            ],
            [
                'label'             => 'Категория луғатҳо',
                'type'              => 'select2_multiple',
                'name'              => 'categories', // the method that defines the relationship in your Model
                'entity'            => 'categories', // the method that defines the relationship in your Model
                'attribute'         => 'name', // foreign key attribute that is shown to user
                'model'             => WordCategory::class,
                'options' => (function($query) {
                    return $query->whereNotIn('slug', WordCategory::SPECIALS_SLUGS)->get();
                }),
                'pivot'             => true, // on create&update, do you need to add/delete pivot table entries?
            ],
            [
                'name' => 'incorrect_answers',
                'label' => 'Ҷавобҳои нодурст!',
                'type' => 'repeatable',
                'fields' => [
                    [
                        'name' => 'incorrect_word_1',
                        'label' => 'Чавоби нодуруст',
                        'type' => 'text',
                        'wrapper' => [
                            'class' => 'form-group col-md-6'
                        ],
                    ],
                    [
                        'name' => 'incorrect_word_2',
                        'label' => 'Чавоби нодуруст',
                        'type' => 'text',
                        'wrapper' => [
                            'class' => 'form-group col-md-6'
                        ],
                    ]
                ],
                // optional
                'min_rows' => 1, // minimum rows allowed, when reached the "delete" buttons will be hidden
                'max_rows' => 1,
            ],
            [
                'name' => 'is_masculine',
                'type' => 'checkbox',
                'label' => 'Мужской род',
                'wrapper' => [
                    'class' => 'form-group col-md-2'
                ],
            ],
            [
                'name' => 'is_feminine',
                'type' => 'checkbox',
                'label' => 'Женский род',
                'wrapper' => [
                    'class' => 'form-group col-md-2'
                ],
            ],
            [
                'name' => 'is_neutral',
                'type' => 'checkbox',
                'label' => 'Средный род',
                'wrapper' => [
                    'class' => 'form-group col-md-2'
                ],
            ],
            [
                'name' => 'is_noun',
                'type' => 'checkbox',
                'label' => 'Исм',
                'wrapper' => [
                    'class' => 'form-group col-md-2'
                ],
            ],
            [
                'name' => 'is_verb',
                'type' => 'checkbox',
                'label' => 'Феъл',
                'wrapper' => [
                    'class' => 'form-group col-md-2'
                ],
            ],
            [
                'name' => 'is_adjective',
                'type' => 'checkbox',
                'label' => 'Сифат',
                'wrapper' => [
                    'class' => 'form-group col-md-2'
                ],
            ],
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
            ucfirst($request->russian),
            $request->tj,
            $request->categories,
            $request->incorrect_answers,
            $request->is_masculine,
            $request->is_feminine,
            $request->is_neutral,
            $request->is_noun,
            $request->is_verb,
            $request->is_adjective,
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
            ucfirst($request->russian),
            $request->tj,
            $request->categories,
            $request->incorrect_answers,
            $request->is_masculine,
            $request->is_feminine,
            $request->is_neutral,
            $request->is_noun,
            $request->is_verb,
            $request->is_adjective,
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
