<?php namespace CodeEdu\Book\Repositories\Eloquent;

use CodeEdu\Book\Models\Chapter;
use CodeEdu\Book\Repositories\Contracts\ChapterRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class BookRepositoryEloquent
 * @package namespace CodePub\Repositories\Eloquent;
 */
class ChapterRepositoryEloquent extends BaseRepository implements ChapterRepository
{

    protected $fieldSearchable = [
        'name' => 'like',
        'content' => 'like',
        'order' => '=',
    ];


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chapter::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
