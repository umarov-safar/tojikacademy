<?php

namespace App\Dtos;

class AnswerDto {

    /***
     * @var string $body
     */
    public  $body;

    /***
     * @var  string|null $image
     */
    public $image;

    /***
     * @var int $user_id
     */
    public $user_id;

    /***
     * @var int|null $question_id
     */
    public $question_id;

    /***
     * @var int|null $parent_id
     */
    public $parent_id;

    public function __construct(
        string $body,
        ?string $image,
        int $user_id,
        ?int $question_id,
        ?int $parent_id
    )
    {
        $this->body = $body;
        $this->image = $image;
        $this->user_id = $user_id;
        $this->question_id = $question_id;
        $this->parent_id = $parent_id;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return int
     */
    public function getQuestionId(): ?int
    {
        return $this->question_id;
    }

    /**
     * @return int
     */
    public function getParentId(): ?int
    {
        return $this->parent_id;
    }




}
