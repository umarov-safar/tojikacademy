<?php

namespace App\Dtos;

class RegisterDto {

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $lastName
     */
    protected $lastName;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var string $password
     */
    protected $password;

    /**
     * @var string|null $avatar
     */
    protected $avatar;



    public function __construct(
        string $name,
        string  $lastName,
        string $email,
        string $password,
        ?string $avatar
    )
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->avatar = $avatar;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }




}
