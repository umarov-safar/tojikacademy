<?php

namespace App\Dtos;

class RussianWordDto {


    /**
     * @var string $russain
     */
    protected string $russian;

    /**
     * @var string $tj
     */
    protected string $tj;


    /**
     * @var array $categories
     */
    protected array $categories;


    /**
     * @var array $words
     *
     */
    protected array $incorrect_answer;



    public function __construct(
        string $russain,
        string $tj,
        array $categories,
        array $incorrect_answer
    )
    {
        $this->russian = $russain;
        $this->tj = $tj;
        $this->categories = $categories;
        $this->incorrect_answer = $incorrect_answer;
    }


    /**
     * @return string
     */
    public function getRussian(): string
    {
        return $this->russian;
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
        return $this->incorrect_answer;
    }


}
