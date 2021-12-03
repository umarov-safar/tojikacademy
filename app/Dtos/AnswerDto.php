<?php

namespace App\Dtos;

class AnswerDto {

    /***
     * @var string $body
     */
    protected string $body;

    /***
     * @var int $user_id
     */
    protected int $user_id;

    /***
     * @var string $answerable_id
     */
    protected string $answerable_type;

    /***
     * @var int|null $answerable_id
     */
    protected ?int $answerable_id;

    /**
     * @var int|null
     */
    protected ?int $parent_id;

    /**
     * @param string $body
     * @param int $user_id
     * @param string $answerable_type
     * @param int $answerable_id
     */

    public function __construct(
        string $body,
        int $user_id,
        string $answerable_type,
        int $answerable_id,
        ?int $parent_id
    )
    {
        $this->body = $body;
        $this->user_id = $user_id;
        $this->answerable_type = $answerable_type;
        $this->answerable_id = $answerable_id;
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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function getAnswerableType(): string
    {
        return $this->answerable_type;
    }

    /**
     * @return int
     */
    public function getAnswerableId(): int
    {
        return $this->answerable_id;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parent_id;
    }



}
