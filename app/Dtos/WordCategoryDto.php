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

    /**
     * @var string $image
     */
    protected ?string $image;

    /**
     * @var string $slug
     */
    protected string $slug;

    public function __construct(
        string $name,
        ?string $description,
        ?string $image,
        string $slug
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->slug = $slug;
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

    /**
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}
