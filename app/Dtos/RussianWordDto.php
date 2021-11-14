<?php

namespace App\Dtos;

class RussianWordDto {


    /**
     * @var string $word
     */
    protected string $word;

    /**
     * @var string $translate
     */
    protected string $translate;

    /**
     * @var int $language_id
     */
    protected int $language_id;

    /**
     * @var array $categories
     */
    protected array $categories;


    /**
     * @var array $words
     *
     */
    protected array $words;



    public function __construct(
        string $word,
        string $translate,
        array $categories,
        array $words
    )
    {
        $this->word = $word;
        $this->translate = $translate;
        $this->categories = $categories;
        $this->words = $words;
    }


    /**
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * @return array
     */
    public function getWords(): array
    {
        return $this->words;
    }
    /**
     * @return string
     */
    public function getTranslate(): string
    {
        return $this->translate;
    }


    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }


}
