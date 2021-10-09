<?php

namespace App\Dtos;

class QuestionCategoryDto {

    /***
     * @var string $name
     */
    public $name;


    /***
     * @var string $slug
     */
    public $slug;



    public function __construct(string $name, string $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
    }



    /***
     * @return string
     */

    public function getName() : string
    {
        return  $this->name;
    }

    /**
     * @return string
     */
    public function getSlug() : string
    {
        return $this->slug;
    }

}
