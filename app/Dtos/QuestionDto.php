<?php

namespace App\Dtos;

class QuestionDto {

    /**
     * @var  string $title
    */
    protected $title;

    /**
     * @var string|null $body
     */
    protected $body;

    /**
     * @var string|null $image
    */
    protected $image;

    /**
     * @var int $user_id
    */
    protected $user_id;

    /**
     * @var int $question_category_id
    */
    protected $question_category_id;



    public function __construct(
        string $title,
        ?string $body,
        ?string $image,
        int $user_id,
        int $question_category_id
    )
    {
        $this->title = $title;
        $this->body = $body;
        $this->image = $image;
        $this->user_id = $user_id;
        $this->question_category_id = $question_category_id;

    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
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
    public function getQuestionCategoryId(): int
    {
        return $this->question_category_id;
    }


}
