<?php

namespace CodeEdu\Book\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeEdu\Book\Models\Book;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements Transformable, TableInterface
{
    use TransformableTrait,
        SoftDeletes,
        Sluggable,
        SluggableScopeHelpers;

    protected $fillable = ['name'];

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
            'Código', 'Nome', 'Livros'
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
            case 'Nome': return $this->name;
            case 'Livros': return $this->books()->count();
        }
    }

    /**
     * Get Books
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    /**
     * Get name is trashed
     *
     * @return mixed|string
     */
    public function getNameTrashedAttribute(){
        return $this->trashed() ? "{$this->name} (Inativa)" : $this->name ;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
