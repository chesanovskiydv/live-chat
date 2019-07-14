<?php

namespace App\Concerns\Actions;

use Illuminate\Database\Eloquent\Model;

trait HasModel
{
    /** @var Model */
    protected $model;

    /**
     * HasModel constructor.
     *
     * @param Model $model
     * @param array $attributes
     */
    public function __construct(Model $model, array $attributes = [])
    {
        $this->setModel($model);

        parent::__construct($attributes);
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }
}