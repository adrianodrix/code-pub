<?php
namespace CodePub\Repositories\Traits;


trait RepositoryRestoreTrait
{
    /**
     * Restore register trashed
     *
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        //$this->applyScope();
        //$temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);
        $model = $this->find($id);
        //$this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        $model->restore();

        return $model;
    }
}