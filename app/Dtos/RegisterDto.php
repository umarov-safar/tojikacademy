<?php

namespace App\Dtos;

class RegisterDto {

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string|null $lastName
     * Last name not in use until 28.03.2022
     */
    protected ?string $lastName;

    /**
     * @var string
     */
    protected string $username; // username is for login to system

    /**
     * @var string|null $email
     */
    protected ?string $email;

    /**
     * @var string $password
     */
    protected string $password;

    /**
     * @var string|null $avatar
     */
    protected $avatar;

    /**
     * @var array
     */
    protected array $image_sizes;


    public function __construct(
        string $name,
        string $username,
        ?string $email,
        string $password,
    )
    {
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
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
    public function getUsername(): string
    {
        return $this->username;
    }


    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
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
     * @return array|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @return array
     */
    public function getImageSizes(): array
    {
        return $this->image_sizes;
    }

}
