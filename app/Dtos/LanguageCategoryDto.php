<?php

namespace App\Dtos;

class LanguageCategoryDto {

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $slug
     */
    public $slug;

    /**
     * @var int|null $parent
     */
    public $parent_id;



    public function __construct(
        string $name,
        string $slug,
        ?int $parent_id
    )
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->parent_id = $parent_id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return int|null
     */
    public function getParent(): ?int
    {
        return $this->parent_id;
    }


}
