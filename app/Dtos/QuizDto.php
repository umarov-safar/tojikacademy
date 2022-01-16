<?php

namespace App\Dtos;

class QuizDto {

    /**
     * @var string $quiz
     */
    protected $quiz;

    /**
     * @var string $answer
     */
    protected $answers;

    /**
     * @var int|null $more_answer
     */
    protected $more_answer;

    /**
     * @var int $category_id
     */
    protected $category_id;



    public function __construct(
        string $quiz,
        string $answers,
        ?int $more_answer,
        int $category_id
    )
    {
        $this->quiz = $quiz;
        $this->answers = $answers;
        $this->more_answer = $more_answer;
        $this->category_id = $category_id;
    }


    /**
     * @return string
     */
    public function getQuiz(): string
    {
        return $this->quiz;
    }

    /**
     * @return string
     */
    public function getAnswers(): string
    {
        return $this->answers;
    }

    /**
     * @return int|null
     */
    public function getMoreAnswer(): ?int
    {
        return $this->more_answer;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }





}
