<?php

namespace App\Repositories;

use App\Entities\LanguageContract;
use Illuminate\Support\Collection;

interface LanguageRepositoryContract
{

    /**
     *  Find language by ISO code
     * @param string $code
     * @return LanguageContract
     * @throws \InvalidArgumentException
     */
    public function find(string $code) : LanguageContract;

    /**
     *  Get random language
     * @return LanguageContract
     */
    public function random() : LanguageContract;

    /**
     *  Collection of Languages
     * @return Collection
     */
    public function all() : Collection;

    /**
     *  Check if ISO code is valid
     * @param string $code
     * @return bool
     */
    public function isValid(string $code) : bool;
}