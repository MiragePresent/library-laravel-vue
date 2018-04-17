<?php

namespace App\Entities;

class Language implements LanguageContract
{
    /**
     *  ISO code
     * @var string $code
     */
    protected $code;

    /**
     *  Full title
     * @var string
     */
    protected $title;

    public function __construct(string $code, string $title)
    {
        $this->code = $code;
        $this->title = $title;
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        } else {
            return null;
        }
    }

    /**
     *  Create language instance
     * @param string $code
     * @param string $title
     * @return LanguageContract
     */
    public static function make(string $code, string $title) : LanguageContract
    {
        return new static($code, $title);
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}