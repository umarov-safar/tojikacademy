<?php

namespace App\Dtos;

class QuestionDto {

    /**
     * @var  string $title
    */
    protected string $title;

    /**
     * @var string|null $body
     */
    protected ?string $body;

    /**
     * @var string $slug
     */
    protected string $slug;

    /**
     * @var int $user_id
    */
    protected int $user_id;

    /**
     * @var int $question_category_id
    */
    protected int $question_category_id;



    public function __construct(
        string $title,
        ?string $body,
        string $slug,
        int $user_id,
        int $question_category_id
    )
    {
        $this->title = $title;
        $this->body = $body;
        $this->slug = $slug;
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
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
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
