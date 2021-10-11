<?php

namespace App\Dtos;

class EnglishDto {

    /**
     * @var string $sentence
     */
    public $sentence;

    /**
     * @var  string $translate1
     */
    public $translate1;

    /**
     * @var string|null
     */
    public $translate2;

    /**
     * @var int $category_id
     */
    public $category_id;



    public function __construct(
        string $sentence,
        string $translate1,
        ?string $translate2,
        int $category_id
    )
    {
        $this->sentence = $sentence;
        $this->translate1 = $translate1;
        $this->translate2 = $translate2;
        $this->category_id = $category_id;
    }


    /**
     * @return string
     */
    public function getSentence(): string
    {
        return $this->sentence;
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
