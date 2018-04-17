<?php

namespace App\Entities;

/**
 * Interface LanguageContract
 * @property string $code
 * @property string $title
 */

interface LanguageContract
{

    /**
     *  Genre and title getter
     * @param $name
     * @return string|null
     */
    public function __get($name);

    /**
     *  Create language instance
     * @param string $code
     * @param string $title
     * @return LanguageContract
     */
    public static function make(string $code, string $title) : LanguageContract;

    /**
     *  Code getter
     * @return string
     */
    public function getCode() : string;

    /**
     *  Title getter
     * @return string
     */
    public function getTitle() : string;
}