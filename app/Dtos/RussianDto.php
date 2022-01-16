<?php

namespace App\Dtos;

class RussianDto {

    /**
     * @var string $sentence
     */
    protected $sentence;

    /**
     * @var string $translate1
     */
    protected $translate1;

    /**
     * @var string|null $translate2
     */
    protected $translate2;

    /**
     * @var string|null $translate3
     */
    protected $translate3;

    /**
     * @var int $category_id
     */
    protected $category_id;





    public function __construct(
        string $sentence,
        string $translate1,
        ?string $translate2,
        ?string $translate3,
        int $category_id
    )
    {
        $this->sentence = $sentence;
        $this->translate1 = $translate1;
        $this->translate2 = $translate2;
        $this->translate3 = $translate3;
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
     * @return string|null
     */
    public function getTranslate3(): ?string
    {
        return $this->translate3;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }




}

