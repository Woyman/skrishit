<?php


namespace App\Utils\Objects;


class Response
{
    private $message;
    private $data;

    public function __construct($message = '', $data = [])
    {
        $this->message = $message;
        $this->data = $data;
    }

    public function toArray()
    {
        return [
            'message' => $this->message,
            'data' => $this->data,
        ];
    }

}
