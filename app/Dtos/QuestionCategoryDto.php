<?php

namespace App\Dtos;

class QuestionCategoryDto {

    /***
     * @var string $name
     */
    protected $name;


    /***
     * @var string $slug
     */
    protected $slug;



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
