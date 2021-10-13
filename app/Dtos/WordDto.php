<?php

namespace App\Dtos;

class WordDto {

    /**
     * @var string $word
     */
    protected $word;

    /**
     * @var string $translate1
     */
    protected $translate1;

    /**
     * @var string|null $translate2
     */
    protected $translate2;

    /**
     * @var int $category_id
     */
    protected $category_id;




    public function __construct(
        string $word,
        string $translate1,
        ?string $translate2,
        int $category_id
    )
    {
        $this->word = $word;
        $this->translate1 = $translate1;
        $this->translate2 = $translate2;
        $this->category_id = $category_id;

    }


    /**
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * @return string
     */
    public function getTranslate1(): string
    {
        return $this->translate1;
    }

    /**
     * @return string|null
     */
    public function getTranslate2(): ?string
    {
        return $this->translate2;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }


}
