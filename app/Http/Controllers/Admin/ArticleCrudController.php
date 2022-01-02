<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Spatie\Permission\Models\Role;

/**
 * Class ArticleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArticleCrudController extends \Backpack\NewsCRUD\app\Http\Controllers\Admin\ArticleCrudController
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
     * @throws \Exception
     */
    public function setup()
    {
        parent::setup();
        CRUD::setModel(\App\Models\Article::class);


        $this->crud->operation(['create', 'update'], function() {
            $this->crud->setValidation(ArticleRequest::class);

            $this->crud->addField([
                'name' => 'description',
            ])->afterField('title');

            $this->crud->addFields([
                ['name' => 'meta_title'],
                ['name' => 'meta_description', 'type' => 'textarea'],
                ['name' => 'meta_keywords'],
            ]);
        });

        $this->crud->operation(['list'], function() {
            $this->crud->addColumn('id')->beforeColumn('title');
        });

    }


}
