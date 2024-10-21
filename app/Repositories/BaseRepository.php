<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;


abstract class BaseRepository
{
    private Application $app;
    protected $model;
    protected ?Model $modelInstance;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    public function makeModel()
    {
        $this->modelInstance = $this->app->make($this->model());
    }

    public function create($attributes)
    {
        $this->makeModel();

        return $this->modelInstance->create($attributes);
    }

    abstract function model(): string;
}
