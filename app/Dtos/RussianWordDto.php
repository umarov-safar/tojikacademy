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
     * @var array $incorrect_answers
     *
     */
    protected array $incorrect_answers;

    /**
     * @var boolean $is_masculine;
     */
    protected bool $is_masculine;

    /**
     * @var boolean $is_feminine
     */
    protected bool $is_feminine;

    /**
     * @var boolean $is_neutral
     */
    protected bool $is_neutral;

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

    /**
     * @param string $russain
     * @param string $tj
     * @param array $categories
     * @param array $incorrect_answers
     */
    public function __construct(
        string $russain,
        string $tj,
        array $categories,
        array $incorrect_answers,
        bool $is_masculine,
        bool $is_feminine,
        bool $is_neutral,
        bool $is_noun,
        bool $is_verb,
        bool $is_adjective,
    )
    {
        $this->russian = $russain;
        $this->tj = $tj;
        $this->categories = $categories;
        $this->incorrect_answers = $incorrect_answers;
        $this->is_masculine = $is_masculine;
        $this->is_feminine = $is_feminine;
        $this->is_neutral = $is_neutral;
        $this->is_noun = $is_noun;
        $this->is_verb = $is_verb;
        $this->is_adjective = $is_adjective;
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
        return $this->incorrect_answers;
    }

    /**
     * @return bool
     */
    public function isMasculine(): bool
    {
        return $this->is_masculine;
    }

    /**
     * @return bool
     */
    public function isFeminine(): bool
    {
        return $this->is_feminine;
    }

    /**
     * @return bool
     */
    public function isNeutral(): bool
    {
        return $this->is_neutral;
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
