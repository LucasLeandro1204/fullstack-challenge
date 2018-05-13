<?php

namespace App\Core;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Query
{
    /**
     * The query related model.
     *
     * @var Model
     */
    protected $model;

    /**
     * The default values if not present in request validated data.
     *
     * @var array
     */
    protected $defaults = [];

    /**
     * The validation rules.
     * We will use the key as method, so pay attention.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Get a builder instance.
     */
    public function query(): self
    {
        $this->model = $this->model->newQuery();

        return $this;
    }

    /**
     * Order by method proxy.
     */
    protected function orderBy(array $config): self
    {
        $this->model->orderBy($config[0], $config[1]);

        return $this;
    }

    /**
     * Create a new query instance from request.
     */
    public function from(Request $request): self
    {
        $instance = $this->query();

        $data = array_merge($this->defaults, $request->validate($this->rules));


        foreach ($data as $key => $value) {
            $instance->{camel_case($key)}($value);
        }

        return $instance;
    }

    /**
     * Handle dynamic method calls into the model.
     */
    public function __call(string $method, array $parameters)
    {
        return call_user_func_array([$this->model, $method], $parameters);
    }
}
