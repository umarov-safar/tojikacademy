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

    /**
     * @var boolean $is_noun;
     */
    protected bool $is_noun;

    /**
     * @var boolean $is_verb;
     */
    protected bool $is_verb;

    /**
     * @var boolean $is_adjective;
     */
    protected bool $is_adjective;




    public function __construct(
        string $english,
        string $tj,
        array $categories,
        array $incorrect_answers,
        bool $is_noun,
        bool $is_verb,
        bool $is_adjective,
    )
    {
        $this->english = $english;
        $this->tj = $tj;
        $this->categories = $categories;
        $this->incorrect_answers = $incorrect_answers;
        $this->is_noun = $is_noun;
        $this->is_verb = $is_verb;
        $this->is_adjective = $is_adjective;
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

    /**
     * @return bool
     */
    public function isNoun(): bool
    {
        return $this->is_noun;
    }

    /**
     * @return bool
     */
    public function isVerb(): bool
    {
        return $this->is_verb;
    }

    /**
     * @return bool
     */
    public function isAdjective(): bool
    {
        return $this->is_adjective;
    }



}
