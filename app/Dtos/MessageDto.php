<?php

namespace App\Dtos;

class MessageDto {

    /**
     * @var string $name;
     */
    protected string $name;

    /**
     * @var string $contact
     */
    protected string $contact;


    /**
     * @var string $message
     */
    protected string $message;


    /**
     * @param string $name
     * @param string $contact
     * @param string $message
     */
    public function __construct(
        string $name,
        string $contact,
        string $message
    )
    {
        $this->name = $name;
        $this->contact = $contact;
        $this->message = $message;
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
    public function getContact(): string
    {
        return $this->contact;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }



}
