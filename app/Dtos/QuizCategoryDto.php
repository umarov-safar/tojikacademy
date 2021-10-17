<?php

namespace App\Dtos;

class QuizCategoryDto {

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $slug
     */
    protected $slug;

    /**
     * @var int|null $parent
     */
    protected $parent_id;



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
