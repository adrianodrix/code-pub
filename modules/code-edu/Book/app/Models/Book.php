<?php

namespace CodeEdu\Book\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeEdu\User\Models\User;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Book extends Model implements Transformable, TableInterface
{
    use TransformableTrait,
        FormAccessible,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'author_id',
        'dedication',
        'description',
        'website',
        'percent_complete',
        'published'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return [
            'Código', 'Título', 'Autor', 'Preço'
        ];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case 'Código': return $this->id;
            case 'Título': return $this->title;
            case 'Autor': return $this->author->name;
            case 'Preço': return $this->price;
        }
    }

    /**
     * Get Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id')->withTrashed();
    }

    /**
     * Get Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTrashed();
    }

    /**
     * Get Categories IDs
     *
     * @return mixed
     */
    public function formCategoriesAttribute()
    {
        return $this->categories->pluck('id')->all();
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
