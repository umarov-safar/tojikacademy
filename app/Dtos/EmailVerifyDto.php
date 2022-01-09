<?php

namespace App\Dtos;

class EmailVerifyDto {

    /**
     * Id of user
     * @var int $user_id
     */
    protected int $user_id;


    /**
     * @var string $token
     */
    protected string $token;


    public function __construct(int $user_id, string $token)
    {
        $this->user_id = $user_id;
        $this->token = $token;
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
    public function getToken(): string
    {
        return $this->token;
    }


}
