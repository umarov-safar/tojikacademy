<?php

namespace App\Dtos;

class UserDto {

    protected string $name;

    protected string $username;

    protected ?string $email;

    protected string $password;

    protected ?array $image_sizes;

    protected ?string $avatar;

    /**
     * @param string $name
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string|null $avatar
     * @param string|null $image_sizes
     */
    public function __construct(
        string $name,
        string $username,
        string $password,
        ?string $email = NULL,
        ?string $avatar = NULL,
        ?array $image_sizes = NULL
    )
    {
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->image_sizes = $image_sizes;
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
    public function getUsername(): string
    {
        return $this->username;
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
     * @return string|null
     */
    public function getImageSizes(): ?array
    {
        return $this->image_sizes;
    }

    /**
     * @return string
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

}
