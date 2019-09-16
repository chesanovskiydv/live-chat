<?php

namespace App\Support\Traits\Eloquent;

use Illuminate\Support\Str;

trait ApiKeys
{
    /**
     * Initialize the api keys trait for an instance.
     *
     * @return void
     */
    public function initializeApiKeys()
    {
        $this->{$this->getApiKeyColumn()} = Str::uuid();
    }

    /**
     * Get the name of the api_key column.
     *
     * @return string
     */
    public function getApiKeyColumn()
    {
        return defined('static::API_KEY') ? static::API_KEY : 'api_key';
    }
}
