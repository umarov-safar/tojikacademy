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
     * @var array|null $avatar
     */
    protected $avatar;

    /**
     * @var array
     */
    protected array $image_sizes;


    public function __construct(
        string $name,
        string  $lastName,
        string $email,
        string $password,
        ?string $avatar,
        array $image_sizes
    )
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->avatar = $avatar;
        $this->image_sizes = $image_sizes;
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
