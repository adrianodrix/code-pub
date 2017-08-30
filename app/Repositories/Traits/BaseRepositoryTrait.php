<?php
namespace CodePub\Repositories\Traits;

trait BaseRepositoryTrait
{
    /**
     * Retrieve data array for populate field select
     *
     * @param string $column
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function lists($column, $key = null)
    {
        $this->applyCriteria();
        return $this->model->pluck($column, $key);
    }
}