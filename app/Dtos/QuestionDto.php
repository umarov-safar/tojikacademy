<?php

namespace App\Dtos;

class QuestionDto {

    /**
     * @var  string $title
    */
    public $title;

    /**
     * @var string|null $body
     */
    public $body;

    /**
     * @var string|null $image
    */
    public $image;

    /**
     * @var int $user_id
    */
    public $user_id;

    /**
     * @var int $question_category_id
    */
    public $question_category_id;



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


    public function getTitle() : string
    {
        return $this->title;
    }

    public function getBody() : ?string
    {
       return $this->body;
    }

    public function getImage() : ?string
    {
        return $this->image;
    }

    public function getUserId() : int
    {
        return $this->user_id;
    }

    public function getQuestionCategoryId() : int
    {
        return $this->question_category_id;
    }
}
