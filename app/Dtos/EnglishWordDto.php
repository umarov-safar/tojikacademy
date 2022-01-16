<?php

namespace App\Dtos;

class EnglishWordDto {

    /**
     * @var string $english
     */
    protected string $english;

    /**
     * @var string $tj
     */
    protected string $tj;


    /**
     * @var array $categories
     */
    protected array $categories;


    /**
     * @var array $incorrect_answers
     *
     */
    protected array $incorrect_answers;



    public function __construct(
        string $english,
        string $tj,
        array $categories,
        array $incorrect_answers
    )
    {
        $this->english = $english;
        $this->tj = $tj;
        $this->categories = $categories;
        $this->incorrect_answers = $incorrect_answers;
    }

    /**
     * @return string
     */
    public function getEnglish(): string
    {
        return $this->english;
    }

    /**
     * @return string
     */
    public function getTj(): string
    {
        return $this->tj;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @return array
     */
    public function getIncorrectAnswers(): array
    {
        return $this->incorrect_answers;
    }





}
