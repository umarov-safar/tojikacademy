<?php

namespace App\Dtos;

class WordCategoryDto {

    /**
     * @var string $name
     */
    protected string $name;


    /**
     * @var string $description
     */
    protected ?string $description;


    public function __construct(string $name,  ?string $description)
    {
        $this->name = $name;
        $this->description = $description;      
    }


    /**
     * @return string
     */
    public function getName() : string 
    {
        return $this->name;
    }

    /**
     * @return string
    */
    public function getDescription() : ?string
    {
        return $this->description;
    }
}