<?php

namespace App\Support\Traits\Eloquent;

use Illuminate\Support\Str;

trait Uuids
{
    /**
     * Boot the uuids trait for a model.
     *
     * @return void
     */
    public static function bootUuids()
    {
        static::creating(function ($model) {
            $model->{$model->getUuidColumn()} = Str::uuid();
        });
    }

    /**
     * Get the name of the "uuid" column.
     *
     * @return string
     */
    public function getUuidColumn()
    {
        return defined('static::UUID') ? static::UUID : 'uuid';
    }
}